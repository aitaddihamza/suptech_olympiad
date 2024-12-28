@extends('layouts.app')
@section('title', 'organisator ')
@section('content')
    <section class=" pt-8 flex flex-col max-w-7xl mx-auto mt-[10rem]  p-4 shadow-lg">
        <div class="flex flex-1 items-center justify-center">
            <div class=" w-full text-center">
                <form action="{{ route('admin.store_organisator') }}"
                    method="POST" class="text-center">
                    @csrf
                    @method("POST")
                    <h1 class="font-bold tracking-wider text-xl xl:text-3xl mb-8 w-full text-gray-600 ">L'organisator #2</h1>
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <input type="text"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="nom" value="" placeholder="Nom" />
                            @error('nom')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="py-2 text-left flex-1">
                            <input type="text"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="prenom" value="" placeholder="Prénom" />
                            @error('prenom')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  md:flex-row items-center gap-2">
                        <div class="py-2 text-left flex-1">
                            <input type="email"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="email" value="" placeholder="Email" />
                            @error('email')
                                <p class="text-red-600"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="py-2 text-left flex-1 flex md:flex-row items-center gap-2">
                            <input type="password"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="password" placeholder="Mot de passe " />
                            <input type="password"
                                class="border-2 border-gray-200 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                name="password_confirmation" placeholder="confirmation de mot de passe " />
                        </div>
                        @error('password')
                            <p class="text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="py-2 px-6 py-4 whitespace-nowrap flex items-center justify-center">
                        <a href="#edit"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Modifier</a>
                        <form action="#delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Supprimer</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
