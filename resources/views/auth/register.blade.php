<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-[20%] md:mt-8">
        @csrf
        @method('POST')
        <div>
            <x-input-label for="nom" :value="__('nom')" />
            <x-text-input id="name" class="block mt-1 border w-full p-2" type="text" name="nom"
                :value="old('nom')" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input id="name" class="block mt-1 border w-full p-2" type="text" name="prenom"
                :value="old('prenom')" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="" class="my-2" :value="__('Sélectionnez les activitées: ')" />
            <div class="flex gap-8 mt-4">
                <div>
                    <x-input-label for="chess" :value="__('chess')" />
                    <x-text-input id="name" class="w-8 h-8" type="checkbox" name="chess" :value="old('chess')"
                        autofocus autocomplete="chess" />
                </div>
                <div>
                    <x-input-label for="pingpong" :value="__('pingpong')" />
                    <x-text-input id="name" class="w-8 h-8" type="checkbox" name="pingpong" :value="old('pingpong')"
                        autofocus autocomplete="pingpong" />
                </div>
            </div>
            <x-input-error :messages="$errors->get('activities')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 border w-full p-2" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 border w-full p-2" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 border w-full p-2" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
