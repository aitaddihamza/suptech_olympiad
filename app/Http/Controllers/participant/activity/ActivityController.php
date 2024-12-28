<?php

namespace App\Http\Controllers\participant\activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        // $activities = Activity::query()->where('date_debut', '>', Carbon::now())->get();
        $participantId = Auth::user()->id;

        $sql = Activity::query()->where('date_debut', '>', Carbon::now());
        // activities non participées
        $activities = $sql->whereNotIn('id', function ($query) use ($participantId) {
            $query->select('activity_id')
                  ->from('participant_activity')
                  ->where('user_id', $participantId);
        })->get();


        $activitiesParticipes = Auth::user()->activitiesParticipes;

        return view('participant.activity.index', compact('activities', 'activitiesParticipes'));
    }

    public function participer(int $id)
    {
        $participant = Auth::user();
        $participant->activitiesParticipes()->attach($id);
        return to_route('participant.activities')->with('success', 'la participation a été bien fais');
    }

    public function annuler(Activity $activity)
    {
        $date_debut = Carbon::parse($activity->date_debut);
        $now = Carbon::now();
        if ($now->isAfter($date_debut)) {
            return to_route('participant.activities')->with('warning', 'opération non permise !');
        } else {
            Auth::user()->activitiesParticipes()->detach($activity->id);
            return to_route('participant.activities')->with('success', 'l\'annulation a été bien faite ');
        }
    }

}
