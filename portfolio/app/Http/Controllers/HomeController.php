<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\Introduction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $about = About::all();
        $service = Service::all();
        $project = Project::all();
        $introduction = Introduction::all();
    
        return view('layouts.home', compact('about', 'service', 'project','introduction'));
    }
    public function admin(){
        return view('layouts.admin');
    }
}
