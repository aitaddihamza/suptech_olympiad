<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048|dimensions:min_width=100,min_height=200',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $image_path = null;
        if ($request->has('image')) {
            $image_path = $request->file('image')->store('profiles', 'public');
        }
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'image_path' => $image_path,
            'password' => Hash::make($request->password),
            'role' => 'participant'
        ]);

        event(new Registered($user));

        Auth::login($user);

        // redirect the participant to it's (participant.dashboard)
        return redirect(route('participant.dashboard', absolute: false));
    }
}
