@extends('layouts.app')
@section('title', 'activities')
@section('content')
    <div class="container mx-auto p-4 bg-white rounded-md">
        <h1 class="text-2xl font-bold mb-4">Mes Activités</h1>

        {{-- Activités participées --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Activités participées</h2>
            @if ($participatedActivities->isEmpty())
                <p class="text-gray-600">Vous ne participez à aucune activité.</p>
            @else
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Nom de l'activité</th>
                            <th class="border px-4 py-2">Date début</th>
                            <th class="border px-4 py-2">Date fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participatedActivities as $activity)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $activity->name }}</td>
                                <td class="border px-4 py-2"> {{ $activity->date_debut->format('d M Y') }} </td>
                                <td class="border px-4 py-2"> {{ $activity->date_fin->format('d M Y') }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Activités non participées --}}
        <div>
            <h2 class="text-xl font-semibold mb-2">Activités non participées</h2>
            @if ($nonParticipatedActivities->isEmpty())
                <p class="text-gray-600">Toutes les activités sont participées.</p>
            @else
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Nom de l'activité</th>
                            <th class="border px-4 py-2">Date début</th>
                            <th class="border px-4 py-2">Date fin</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonParticipatedActivities as $activity)
                            <tr class="text-center">
                                <td class="border px-4 py-2">{{ $activity->name }}</td>
                                <td class="border px-4 py-2"> {{ $activity->date_debut->format('d M Y') }} </td>
                                <td class="border px-4 py-2"> {{ $activity->date_fin->format('d M Y') }} </td>
                                <td class="border px-4 py-2"><a href="#" class="btn-primary">participer</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
