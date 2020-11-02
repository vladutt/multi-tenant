<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $databases = [
          'db1' => [
              'user' => 'root',
              'password' => 'db_1',
              'ip' => 'db1',
              'port' => 3308
          ],
          'db2' => [
              'user' => 'root',
              'password' => 'db_2',
              'ip' => 'db2',
              'port' => 3309
          ]
        ];

        \App\Models\Database::create($databases['db1']);
        \App\Models\Database::create($databases['db2']);
    }
}
