<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project) {

        Auth::user()->projects()->attach([$project->id]);

        Artisan::call('db:create ' . $project->slug);
    }

}
