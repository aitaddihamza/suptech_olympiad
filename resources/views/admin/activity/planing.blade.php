@extends('layouts.app')

@section('title', 'planing activities')

@section('content')
    <section class="flex flex-col max-w-7xl mx-auto mt-4 bg-white shadow-md p-4 rounded-md">
        <div class="flex flex-1 items-center justify-center">
            <div class="w-full text-center">
                <form action="{{ route('admin.activity.update_planing', ['activity' => $activity]) }}" method="POST"
                    class="text-center">
                    @csrf
                    @method('PUT')

                    <h1 class="font-bold tracking-wider text-2xl xl:text-2xl mb-8 w-full text-gray-600">
                        Planifier l'activité de {{ $activity->name }}
                    </h1>

                    {{-- Initial Scores --}}
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <label for="date_debut" class="block text-sm font-medium text-gray-700">date de début</label>
                            <input type="date" id="date_debut" name="date_debut"
                                value="{{ old('date_debut', $activity->date_debut->format('Y-m-d')) }}"
                                class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                            @error('date_debut')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="py-2 text-left flex-1">
                            <label for="date_fin" class="block text-sm font-medium text-gray-700">date de fin</label>
                            <input type="date" id="date_fin" name="date_fin"
                                value="{{ old('date_fin', $activity->date_fin->format('Y-m-d')) }}"
                                class="border-2 border-gray-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700">
                            @error('date_fin')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="py-2">
                        <button type="submit" class="btn bg-black rounded-sm">
                            <span class="pl-2 mx-1">Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
