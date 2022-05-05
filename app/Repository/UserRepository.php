<?php
namespace App\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;


class UserRepository
{

    public function GetAllUsers(Request $request)
    {
        return User::all();
    }

    public function Create(UserStoreRequest $request)
    {
        if ($request->password) {
            $password  = Hash::make($request->password);
        }
       $users = User::create(array_merge($request->validated(),['password'=> $password]));
       $users->assignRole($request->input('roles_name'));
        // dd($request->kiosk_id);
        return $users;
    }

    public function Show($id)
    {
        return User::findOrFail($id);
    }

    public function Update(UserUpdateRequest $request,User $user)
    {
        // $user = User::find($id);
        if ($request->password) {
            $password  = Hash::make($request->password);
          } else {
            $password  =  $user->password;
          }
          $user->update(array_merge($request->validated(),['password'=> $password]));
          //   $user = User::find($id);
          DB::table('model_has_roles')->where('model_id', $user->id)->delete();
          $user->assignRole($request->input('roles_name'));

          return $user;
    }

    public function Delete(User $user)
    {
        $user->delete();
        return;
    }

}
