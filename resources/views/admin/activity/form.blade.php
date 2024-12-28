@extends('layouts.app')
@section('title', 'create une activité')
@section('content')
    <section class=" pt-8 flex flex-col max-w-7xl mx-auto mt-[10rem]  p-4 shadow-lg">
        <div class="flex flex-1 items-center justify-center">
            <div class=" w-full text-center">
                <form
                    action="{{ route($activity->exists ? 'admin.update_activity' : 'admin.store_activity', ['activity' => $activity->id]) }}"
                    method="POST" class="text-center">
                    @csrf
                    @method($activity->exists ? 'PUT' : 'POST')
                    <h1 class="font-bold tracking-wider text-xl xl:text-3xl mb-8 w-full text-gray-600 ">
                        {{ $activity->exists ? 'Modifier l\'activité' . $activity->id : 'Ajouter une nouvelle activité !' }}
                    </h1>
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <label for="name">Nom de l'activité</label>
                            <input type="text"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="name" value="{{ old('name', $activity->name) }}" placeholder="nom" />
                            @error('name')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="py-2 text-left flex-1">
                            <label for="name">Description</label>
                            <input type="text"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="description" value="{{ old('description', $activity->description) }}"
                                placeholder="description" />
                            @error('description')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  md:flex-row items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <label for="organisator">choisir l'organisator de ce activité</label>
                            <select name="organisator"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                <option value="">choisir</option>
                                <option value="">choisir</option>
                                @forelse($organisators as $organisator)
                                    <option @selected(@$activity->user->id == $organisator->id) value="{{ $organisator->id }}">
                                        {{ $organisator->nom }}</option>
                                @empty
                                    <option value="">nothing</option>
                                @endforelse
                            </select>
                            @error('organisator')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  md:flex-row items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <label for="date_debut">Définir la date début de l'activité</label>
                            <input type="date"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="date_debut" value="{{ old('date_debut', $activity->date_debut) }}" />
                            @error('date_debut')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="py-2 text-left flex-1">
                            <label for="date_fin">Définir la date fin de l'activité</label>
                            <input type="date"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="date_fin" value="{{ old('date_fin', $activity->date_fin) }}" />
                            @error('date_fin')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="py-2">
                        <button type="submit"
                            class=" mt-2 flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize   bg-blue-600 rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#FFFFFF">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z"
                                    opacity=".3"></path>
                                <path
                                    d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z">
                                </path>
                            </svg>
                            <span class="pl-2 mx-1">Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
