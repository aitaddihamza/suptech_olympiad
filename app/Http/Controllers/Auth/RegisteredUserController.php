<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
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

        // Validate the input
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Handle the profile image upload
        $image_path = null;
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('profiles', 'public');
        }

        // Collect selected activities
        $activities = [];
        if ($request->has('chess')) {
            $activities[] = 1; // Assuming 1 is the ID for chess in the activities table
        }
        if ($request->has('pingpong')) {
            $activities[] = 2; // Assuming 2 is the ID for ping pong in the activities table
        }

        // Validate activity start dates
        if (!empty($activities)) {
            $invalidActivities = [];
            foreach ($activities as $activityId) {
                $activity = Activity::find($activityId);
                if ($activity && $activity->date_debut <= now()) {
                    $invalidActivities[] = $activity->name; // Collect invalid activity names
                }
            }
            if (!empty($invalidActivities)) {
                return back()->withErrors([
                    'activities' => "Vous ne pouvez pas vous inscrire à l'activité {$invalidActivities[0]} car il déjà commencée " ,
                ]);
            }
        } else {
            // If no activities are selected, return with an error
            return back()->withErrors(['activities' => 'Vous devez choisir au moins une activité !']);
        }

        // Create the user
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'image_path' => $image_path,
            'password' => Hash::make($request->password),
            'role' => 'participant', // Assign the role as participant
        ]);

        // Attach activities to the user
        $user->activities()->attach($activities);

        // Fire the Registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect the participant to their dashboard
        return redirect()->route('participant.dashboard');

    }
}
