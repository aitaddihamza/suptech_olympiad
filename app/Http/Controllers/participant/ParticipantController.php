<?php

namespace App\Http\Controllers\participant;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParticipantController extends Controller
{
    public function index()
    {
        return view("participant.dashboard");
    }

}
