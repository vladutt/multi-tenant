<?php

namespace App\Http\Controllers;

use App\Models\Customer\Products;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function create(Request $request) {

        $request->validate([
            'name' => ['required', 'unique:projects', 'max:255'],
        ]);

        $slug = Str::slug($request->name);

        $project = Project::create([
           'name' => $request->name,
           'slug' => $request->name
        ]);


        return response()->json([
            'data' => Products::onProject($project->slug)->get()->toArray(),
            'success' => 'The project was created.'
        ]);

    }

}
