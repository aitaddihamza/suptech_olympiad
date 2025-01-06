@extends('layouts.app')
@section('title', 'all games')
@section('content')

    <div class="flex flex-col max-w-7xl mx-auto mt-4 overflow-x-auto">
        <form action="{{ route('admin.game.index') }}" method="GET" class="flex items-center gap-2 mb-8">
            @csrf
            <label for="activity">Filtrer par activité</label>
            <select class="border border-solid p-2 rounded bg-white flex-1" name="activity" id="activity">
                <option value="tous" {{ $activityName == 'tous' ? 'selected' : '' }}>tous</option>
                @foreach (App\Models\Activity::all() as $activity)
                    <option value="{{ $activity->name }}" {{ $activityName == $activity->name ? 'selected' : '' }}>
                        {{ $activity->name }}
                    </option>
                @endforeach
            </select>
            <button class="btn bg-black">Filtrer</button>
        </form>
        @include('shared.flash')
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-medium">Tous les matches </h1>
            <a href="{{ route('admin.game.create') }}"
                class="btn bg-black hover:transform hover:bg-gray-700 flex items-center gap-2 ">
                <span class="text-2xl font-medium">+</span>
                <span>
                    Nouveau game
                </span>
            </a>
        </div>

        <table class="min-w-full divide-y divide-gray-200 mt-8">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player 1</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score 1</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player 2</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score 2</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scheduled
                        Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($games as $game)
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $game->player1->nom }} {{ $game->player1->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $game->score1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $game->player2->nom }} {{ $game->player2->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $game->score2 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($game->activity->name) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($game->schedule_date)->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $game->updated_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                            <a href="{{ route('admin.game.edit', ['game' => $game]) }}"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Modifier</a>
                            <form action="{{ route('admin.game.destroy', ['game' => $game]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center mt-4">
                            Aucun jeu trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">{{ $games->links() }} </div>
    </div>

@endsection
