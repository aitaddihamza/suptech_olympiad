@extends('layouts.app')
@section('title', 'dashboard')
@section('content')

    <div class="flex flex-col max-w-7xl mx-auto mt-4 overflow-x-auto">
        <form action="" method="GET" class="flex items-center gap-2 my-4">
            @csrf
            <input type="text" class="border border-solid p-2 rounded " name="firstname" placeholder="prénom"
                value="{{ $inputs['firstname'] ?? '' }}">
            <input type="text" class="border border-solid p-2 rounded " name="cin" placeholder="cin"
                value="{{ $inputs['cin'] ?? '' }}">
            <input type="text" class="border border-solid p-2 rounded " name="phone" placeholder="phone"
                value="{{ $inputs['phone'] ?? '' }}">
            <input type="text" class="border border-solid p-2 rounded " name="specialite" placeholder="specialite"
                value="{{ $inputs['specialte'] ?? '' }}">
            <button class="btn bg-black">Rechercher</button>
        </form>
        @include('shared.flash')
        <div class="flex items-center justify-between" my-4>
            <h1 class="text-xl font-medium">Tous les organistors</h1>
            <a href="{{ route('admin.create_organisator') }}"
                class="btn bg-black hover:transform hover:bg-gray-700 flex items-center gap-2 ">
                <span class="text-2xl font-medium">+</span>
                <span>
                    Nouveau Organisator
                </span>
            </a>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-8">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($organisators as $organisator)
                        <tr class="hover:bg-papayawhip">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $organisator->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $organisator->prenom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $organisator->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex items-center justify-center">
                                <a href="{{ route('admin.edit_organisator', ['organisator' => $organisator->id]) }}" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Modifier</a>
                                <form action="{{ route('admin.destroy_organisator', ['organisator' => $organisator]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr class="hover:bg-papayawhip">
                            <td class="px-6 py-4 whitespace-nowrap">aucun organistor</td>
                    @endforelse
            </tbody>
        </table>
    </div>

@endsection

