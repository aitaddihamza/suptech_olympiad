@extends('home.base')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Classements des Participants</h1>

        <!-- Filtrage -->
        <form method="GET" action="{{ route('home.classements') }}" class="mb-6 flex flex-wrap gap-4">
            <select name="activity" class="border border-gray-300 bg-white rounded-lg p-2">
                @foreach ($activities as $activity)
                    <option value="{{ $activity->name }}" {{ $activity->name === $selectedActivity ? 'selected' : '' }}>
                        {{ ucfirst($activity->name) }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="prenom" placeholder="Prénom" value="{{ request('prenom') }}"
                class="border border-gray-300 rounded-lg p-2" />

            <input type="text" name="nom" placeholder="Nom" value="{{ request('nom') }}"
                class="border border-gray-300 rounded-lg p-2" />

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Filtrer</button>
        </form>

        <!-- Table des classements -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Nom</th>
                        <th class="border border-gray-300 px-4 py-2">Prénom</th>
                        <th class="border border-gray-300 px-4 py-2">Activité</th>
                        <th class="border border-gray-300 px-4 py-2">Score Total</th>
                        <th class="border border-gray-300 px-4 py-2">Victoires</th>
                        <th class="border border-gray-300 px-4 py-2">Défaites</th>
                        <th class="border border-gray-300 px-4 py-2">Égalités</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classements as $index => $participant)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $participant['user']->nom }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $participant['user']->prenom }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-xl text-violet-600  ">
                                @if (isset($participant['activity_name']))
                                    @if (strtolower($participant['activity_name']) === 'ping pong')
                                        <i class="fas fa-table-tennis "></i>
                                    @elseif(strtolower($participant['activity_name']) === 'chess')
                                        <i class="fas fa-chess"></i>
                                    @else
                                        {{ ucfirst($participant['activity_name']) }}
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $participant['total_score'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $participant['wins'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $participant['losses'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                {{ $participant['ties'] > 0 ? $participant['ties'] : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4">Aucun participant trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $classements->links() }}
        </div>
    </div>
@endsection
