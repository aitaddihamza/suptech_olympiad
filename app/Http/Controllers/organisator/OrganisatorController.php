<?php

namespace App\Http\Controllers\organisator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganisatorController extends Controller
{
    public function index()
    {
        return view("organisator.dashboard");
    }
}
