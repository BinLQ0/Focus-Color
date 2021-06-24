<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setup Roles

        Role::create(
            ['name' => 'Administrator'],
            ['name' => 'Warehouse Staff'],
            ['name' => 'Support']
        );

        $administrator = Role::where('name', 'Administrator')->first();

        // Setup Permission
        $permissions = array(
            ['name' => 'admin module'],
            ['name' => 'warehouse module'],
            ['name' => 'manufacture module'],
        );

        foreach ($permissions as $permission) {
            Permission::create($permission);

            $administrator->givePermissionTo($permission);
        }

        User::firstOrCreate([
            'username' => 'admin'
        ])->assignRole($administrator);
    }
}
