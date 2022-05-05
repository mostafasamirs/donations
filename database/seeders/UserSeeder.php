<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'password' => bcrypt('12345678'),
            'lang'=>'ar',
            'address'=>'cairo',
            'type'=>'admin',
            'roles_name'=>["admin"],
          ]);

            $role = Role::create(['name' => 'admin']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);



        //   $role = Role::create(['name' => 'superadmin','guard_name'=>'web', 'name_ar'=>'المدير العام']);
        //     // $role = Role::where('name','=','admin')->first();
        //   $permissions = Permission::where('guard_name','web')->get();
        // //   $permissions = Permission::pluck('id','id')->all();
        //   $role->syncPermissions($permissions);
        //   $user->assignRole([$role->id]);


        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'phone' => '12345678929',
            'password' => bcrypt('12345678'),
            'lang'=>'ar',
            'address'=>'cairo',
            'type'=>'supervisor',
            'roles_name'=>["supervisor"],
        ]);
        $role = Role::create(['name' => 'supervisor']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $user = User::create([
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'phone' => '123456783699',
            'password' => bcrypt('12345678'),
            'lang'=>'ar',
            'address'=>'cairo',
            'type'=>'employee',
            'roles_name'=>["employee"],
        ]);
        $role = Role::create(['name' => 'employee']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


        $faker_ar = Faker::create('ar_SA');
        for ($i = 0; $i < 10; $i++) {
          DB::table('users')->insert([
            'name' => $faker_ar->firstName,
            'email' => $faker_ar->email, //companyEmail //freeEmailDomain
            'password' => bcrypt('12345678'),
            'address' => $faker_ar->address,
            'phone' => $faker_ar->phoneNumber,
            'type' => 'employee',
            'roles_name'=>"employee",
          ]);
        }

    }
}
