@extends('home.base')
@section('titlte', 'Matches')
@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Matches</h1>

        <!-- Upcoming Matches Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 p-4 bg-gray-100">Upcoming Matches</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Match
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Players
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Activity
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($upcomingMatches as $match)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Match {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->player1->prenom }} vs {{ $match->player2->prenom }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->schedule_date->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->activity->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Past Matches Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <h2 class="text-2xl font-semibold text-gray-800 p-4 bg-gray-100">Past Matches</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Match
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Players
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Activity
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Final Score
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pastMatches as $match)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Match {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->player1->prenom }} vs {{ $match->player2->prenom }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->schedule_date->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->activity->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $match->score1 }} - {{ $match->score2 }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $upcomingMatches->links() }}
            {{ $pastMatches->links() }}
        </div>
    </div>
@endsection
