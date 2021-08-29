<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function profile()
    {
        return Inertia::render('Setting/Profile');
    }
}
