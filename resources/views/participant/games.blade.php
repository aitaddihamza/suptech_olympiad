@extends('layouts.app')
@section('title', 'activities')
@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">My Games</h1>

        @if ($games->isEmpty())
            <p class="text-gray-600">No games found.</p>
        @else
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Game</th>
                        <th class="border px-4 py-2">Activity</th>
                        <th class="border px-4 py-2">Schedule</th>
                        <th class="border px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        <tr class="text-center">
                            <td class="border px-4 py-2">Match{{ $game->id }}</td>
                            <td class="border px-4 py-2">{{ $game->activity->name }}</td>
                            <td class="border px-4 py-2">
                                {{ $game->schedule_date->format('d M Y') }} at {{ $game->schedule_date->format('H:i') }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $game->status }} {{-- E.g., 'Upcoming', 'Completed' --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
