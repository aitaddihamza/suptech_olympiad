@extends('layouts.app')
@section('title', 'activities')
@section('content')
    <div class="container mx-auto p-4 bg-white rounded-md">
        @include('shared.flash')
        <h1 class="text-2xl font-bold mb-4">Mes Activités</h1>

        {{-- Activités participées --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Activités participées</h2>
            @if ($participatedActivities->isEmpty())
                <p class="text-gray-600">Vous ne participez à aucune activité.</p>
            @else
                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 whitespace-normal text-sm">Nom de l'activité</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Date début</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Date fin</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participatedActivities as $activity)
                                <tr class="text-center">
                                    <td class="border px-4 py-2">{{ $activity->name }}</td>
                                    <td class="border px-4 py-2"> {{ $activity->date_debut->format('d M Y') }} </td>
                                    <td class="border px-4 py-2"> {{ $activity->date_fin->format('d M Y') }} </td>
                                    @if ($activity->date_debut > now())
                                        <td class="border px-4 py-2">
                                            <form
                                                action="{{ route('participant.activity.cancel', ['activity' => $activity]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bg-red-600" type="submit">annuler</button>
                                            </form>
                                        </td>
                                    @else
                                        <td class="border px-4 py-2">date de participation est dépassé</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Activités non participées --}}
        <div>
            <h2 class="text-xl font-semibold mb-2">Activités non participées</h2>
            @if ($nonParticipatedActivities->isEmpty())
                <p class="text-gray-600">Toutes les activités sont participées.</p>
            @else
                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 whitespace-normal text-sm">Nom de l'activité</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Date début</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Date fin</th>
                                <th class="border px-4 py-2 whitespace-normal text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nonParticipatedActivities as $activity)
                                <tr class="text-center">
                                    <td class="border px-4 py-2">{{ $activity->name }}</td>
                                    <td class="border px-4 py-2"> {{ $activity->date_debut->format('d M Y') }} </td>
                                    <td class="border px-4 py-2"> {{ $activity->date_fin->format('d M Y') }} </td>
                                    @if ($activity->date_debut > now())
                                        <td class="border px-4 py-2">
                                            <form
                                                action="{{ route('participant.activity.participate', ['activity' => $activity]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <button class="btn-primary" type="submit">participer</button>
                                            </form>
                                        </td>
                                    @else
                                        <td class="border px-4 py-2">date de participation est dépassé</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
