@extends('layouts.app')
@section('title', 'tous les activities')
@section('content')

    <div class="flex flex-col max-w-7xl mx-auto mt-8 overflow-x-auto">
        @include('shared.flash')
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-medium">Tous les activitiées </h1>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date début
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date fin </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($activities as $activity)
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->name }} </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_debut->format('d M Y') }} </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $activity->date_fin->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                            <a href="{{ route('admin.activity.planing', ['activity' => $activity]) }}"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">planifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center mt-4">
                            Aucun activity trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">{{ $activities->links() }} </div>
    </div>

@endsection
