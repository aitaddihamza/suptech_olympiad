@extends('layouts.app')

@section('title', 'Formulaire de match')

@section('content')
    <section class="flex flex-col max-w-7xl mx-auto mt-4 bg-white shadow-md p-4 rounded-md">
        <div class="flex flex-1 items-center justify-center">
            <div class="w-full text-center">
                <form
                    action="{{ route($game->exists ? 'admin.game.update' : 'admin.game.store', ['game' => $game->id ?? null]) }}"
                    method="POST" class="text-center">
                    @csrf
                    @method($game->exists ? 'PUT' : 'POST')

                    <h1 class="font-bold tracking-wider text-2xl xl:text-2xl mb-8 w-full text-gray-600">
                        {{ $game->exists ? __('Modifier le match') : __('Créer un Nouveau match') }}
                    </h1>

                    {{-- Sélectionnez une Activité --}}
                    <div class="py-2 text-left flex flex-col items-start">
                        <label for="activity" class="block text-sm font-medium text-gray-700">Activité</label>
                        <select id="activity" name="activity"
                            class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 mt-2">
                            <option value="ping_pong"
                                {{ old('activity', $game->activity) == 'ping_pong' ? 'selected' : '' }}>Ping Pong</option>
                            <option value="chess" {{ old('activity', $game->activity) == 'chess' ? 'selected' : '' }}>
                                Échecs
                            </option>
                        </select>
                        @error('activity')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="flex flex-col md:flex-row md:items-center gap-2">
                            {{-- Sélectionnez le Joueur 1 --}}
                            <div class="py-2 text-left flex-1">
                                <label for="player1" class="block text-sm font-medium text-gray-700">Joueur 1</label>
                                <select id="player1" name="player1_id"
                                    class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                                    @foreach ($players as $player)
                                        <option value="{{ $player->id }}"
                                            {{ old('player1_id', $game->player1_id) == $player->id ? 'selected' : '' }}>
                                            {{ $player->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Sélectionnez le Joueur 2 --}}
                            <div class="py-2 text-left flex-1">
                                <label for="player2" class="block text-sm font-medium text-gray-700">Joueur 2</label>
                                <select id="player2" name="player2_id"
                                    class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                                    @foreach ($players as $player)
                                        <option value="{{ $player->id }}"
                                            {{ old('player2_id', $game->player2_id) == $player->id ? 'selected' : '' }}>
                                            {{ $player->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('error')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Scores Initiaux --}}
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <label for="score1" class="block text-sm font-medium text-gray-700">Score du Joueur 1</label>
                            <input type="number" id="score1" name="score1" value="{{ old('score1', $game->score1) }}"
                                class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                            @error('score1')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="py-2 text-left flex-1">
                            <label for="score2" class="block text-sm font-medium text-gray-700">Score du Joueur 2</label>
                            <input type="number" id="score2" name="score2" value="{{ old('score2', $game->score2) }}"
                                class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                            @error('score2')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Planifié Pour --}}
                    <div class="py-2 text-left">
                        <label for="schedule_date" class="block text-sm font-medium text-gray-700">Planifié Pour</label>
                        <input type="datetime-local" id="schedule_date" name="schedule_date"
                            value="{{ old('schedule_date', $game->schedule_date ? $game->schedule_date->format('Y-m-d\TH:i') : '') }}"
                            class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                        @error('schedule_date')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bouton Soumettre --}}
                    <div class="py-2">
                        <button type="submit" class="btn bg-black rounded-sm">
                            <span
                                class="pl-2 mx-1">{{ $game->exists ? 'Mettre à Jour le match' : 'Créer le match' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
