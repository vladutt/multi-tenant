<?php
namespace App\Console\Commands;

use App\Models\Customer\Products;
use App\Models\Database;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;

class CreateDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MySQL database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $schemaName = $this->argument('name');
        $server = Auth::user()->server;

        DB::connection($server)->statement("CREATE DATABASE IF NOT EXISTS $schemaName");

        DB::purge($server);
        Config::set('database.connections.'.$server.'.database', $schemaName);
        DB::reconnect($server);

        Schema::connection($server)->create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('project_id');
            $table->string('product_name');
            $table->timestamps();
        });

        Products::onProject($schemaName)->create([
            'project_id' => Project::whereSlug($schemaName)->first()->id,
            'product_name' => 'TEST DONE'
        ]);



    }

}
