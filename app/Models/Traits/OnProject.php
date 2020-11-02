<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait OnProject {

    public static function onProject($project) {

        $server = Auth::user()->server;

        DB::purge($server);
        Config::set('database.connections.'.$server.'.database', $project);
        DB::reconnect($server);

        return static::on($server);
    }

}
