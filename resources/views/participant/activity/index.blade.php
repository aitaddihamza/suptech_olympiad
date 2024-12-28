@extends('layouts.app')
@section('title', 'activities')
@section('content')
    <div class="flex flex-col max-w-7xl mx-auto mt-6 overflow-x-auto">
        @include('shared.flash')
        <div class="flex items-center justify-between" my-4>
            <h1 class="text-2xl font-medium">Tous les activitiées non participés et disponibles</h1>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-8">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date début
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date fin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">organisator
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($activities as $activity)
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_debut }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_fin }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $activity->user ? $activity->user->nom : "n'est pas défini " }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                            <form action="{{ route('participant.activity.participer', ['id' => $activity->id]) }}"
                                method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Participer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">aucune activité disponible </td>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex flex-col max-w-7xl mx-auto mt-6 overflow-x-auto">
        <div class="flex items-center justify-between" my-4>
            <h1 class="text-2xl font-medium">Tous les activitiées participés</h1>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-8">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date début
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date fin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">organisator
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($activitiesParticipes as $activity)
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_debut }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_fin }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $activity->user ? $activity->user->nom : "n'est pas défini " }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                            <form action="{{ route('participant.activity.annuler', ['activity' => $activity]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">annuler</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">aucune activité disponible </td>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
