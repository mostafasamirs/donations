<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'show-user',
            'add-user',
            'edit-user',
            'delete-user',

            'show-category',
            'add-category',
            'edit-category',
            'delete-category',

            'show-kiosk',
            'add-kiosk',
            'edit-kiosk',
            'delete-kiosk',

            'show-donator',
            'add-donator',
            'edit-donator',
            'delete-donator',

            'show-deposit',
            'add-deposit',
            'edit-deposit',
            'delete-deposit',


            'show-donation',
            'add-donation',
            'edit-donation',
            'delete-donation',

            'show-shift',
            'add-shift',
            'edit-shift',
            'delete-shift',

            'show-role',
            'add-role',
            'edit-role',
            'delete-role',

            // 'show-dashboard',

          ];
          foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
        }
    }
