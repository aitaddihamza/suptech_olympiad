<?php

namespace App\Http\Controllers\admin;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }

    # les organisateurs
    public function organisators()
    {
        $organisators = User::query()->where('role', '=', 'organisator')->orderBy('updated_at', 'desc')->paginate(4);
        return view("admin.organisator.index", compact('organisators'));
    }

    public function create_organisator()
    {
        $organisator = new User();
        return view("admin.organisator.form", compact('organisator'));
    }

    public function show_organisator(int $id)
    {
        $organisator = User::findOrFail($id);
        return view("admin.organisator.show", compact('organisator'));
    }
    public function edit_organisator(User $organisator)
    {
        return view("admin.organisator.form", compact('organisator'));
    }
    public function update_organisator(Request $request, User $organisator)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'min:2'],
            'prenom' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(request()->route()->parameter('organisator'))],
            'password' => ['nullable', 'confirmed', 'min:4']
        ]);

        if ($validatedData['password']) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            $validatedData['password'] = $organisator->password;
        }
        $organisator->update($validatedData);
        return to_route('admin.organisators')->with('infos', "Organisator a été bien modifié !");
    }

    public function store_organisator(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'min:2'],
            'prenom' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(request()->route()->parameter('doctor'))],
            'password' => ['nullable', 'confirmed', 'min:4']
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $organisator = new User($validatedData);
        $organisator->role = "organisator";
        $organisator->save();

        return to_route('admin.organisators')->with('success', "organisator a bien été crée !");
    }

    public function destroy_organisator(User $organisator)
    {
        $organisator->delete();
        return to_route('admin.organisators')->with('warning', "organisator a bien été supprimé !");
    }

    # les activitées
    public function activities()
    {
        $activities = Activity::orderBy('updated_at', 'desc')->paginate(4);
        return view("admin.activity.index", compact('activities'));
    }

    public function create_activity()
    {
        $activity = new Activity();
        $organisators = User::query()->where('role', '=', 'organisator')->orderBy('updated_at', 'desc')->paginate(4);
        return view("admin.activity.form", compact(['activity', 'organisators']));
    }
    public function edit_activity(Activity $activity)
    {
        $organisators = User::query()->where('role', '=', 'organisator')->orderBy('updated_at', 'desc')->paginate(4);
        return view("admin.activity.form", compact(['activity', 'organisators']));
    }

    public function store_activity(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['string', 'required', 'min:3'],
            'organisator' => ['required'],
            'description' => ['required', 'string', 'min:5'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date']
        ]);
        $activity = new Activity($validatedData);
        $activity->user_id = $validatedData['organisator'];
        $activity->save();

        return to_route('admin.activities')->with('success', "l'activité a été bien crée !");
    }

    public function update_activity(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'name' => ['string', 'required', 'min:3'],
            'organisator' => ['required'],
            'description' => ['required', 'string', 'min:5'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date']
        ]);
        $activity->user_id = $validatedData['organisator'];
        $activity->update($validatedData);

        return to_route('admin.activities')->with('success', "l'activité a été bien crée !");
    }

    public function destroy_activity(Activity $activity)
    {
        $activity->delete();
        return to_route('admin.activities')->with('warning', "activity a bien été supprimé !");
    }


}
