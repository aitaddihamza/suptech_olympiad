<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::paginate(10);
        return view('admin.activity.index', compact('activities'));
    }

    public function planing(Activity $activity)
    {
        return view('admin.activity.planing', compact('activity'));
    }

    public function update_planing(Request $request, Activity $activity)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);

        $activity->update($request->all());
        return redirect()->route('admin.activity.index')->with('success', 'Activity planing updated successfully');
    }

}
