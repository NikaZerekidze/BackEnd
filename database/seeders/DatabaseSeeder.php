<?php

namespace Database\Seeders;

use App\Models\Inventoryitem;
use App\Models\Role;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        $Admin = Role::create([
           'name' => 'Admin' ,
            'slug' => 'admin'
        ]);

        $User = Role::create([
            'name' => 'User' ,
            'slug' => 'user'
        ]);

         \App\Models\Company::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Inventoryitem::factory(10)->create();

        Schema::enableForeignKeyConstraints();

    }
}
