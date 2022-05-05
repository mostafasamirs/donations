<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:show-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $roles = Role::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query)  use ($request) {
              return $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('name_ar', 'like', '%'  . $request->search . '%');
            });
          })->Where('name', '!=' ,'admin')->latest()->paginate(10);
          return view('admin.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionadmin = array();
        App::setlocale(Auth::user()->lang);
        $title = __('Roles');
        $permission = Permission::where('guard_name', 'admin')->get();
        foreach ($permission as $key => $value) {
          # code...
          $valuex = explode("-", $value->name);
          if (!in_array($valuex[1], $permissionadmin)) {
            array_push($permissionadmin, $valuex[1]);
          }
        }
        $permissionweb = array();
        $permissionuser = Permission::where('guard_name', 'web')->get();
        foreach ($permissionuser as $key => $value) {
          # code...
          $valuex = explode("-", $value->name);
          if (!in_array($valuex[1], $permissionweb)) {
            array_push($permissionweb, $valuex[1]);
          }
        }
        return view('admin.roles.create', compact('permission', 'permissionadmin', 'permissionuser', 'permissionweb','title'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            // 'permission' => 'required',
            'name_ar' => 'sometimes',
            'permission' => 'required|min:1',
          ]);
          $role = Role::create(['name' => $request->input('name')],['name_ar' => $request->input('name_ar')]);
          $role->syncPermissions($request->input('permission'));
          return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
          ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
          ->all();
        $permissionnames = array();
        $permission = Permission::where('guard_name', $role->guard_name)->get();
        foreach ($permission as $key => $value) {
          # code...
          $valuex = explode("-", $value->name);
          if (!in_array($valuex[1], $permissionnames)) {
            array_push($permissionnames, $valuex[1]);
          }
        }
        return view('admin.roles.show', compact('role', 'rolePermissions', 'permission', 'permissionnames'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissionnames = array();
        $role = Role::find($id);
        $permission = Permission::where('guard_name', $role->guard_name)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
          ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
          ->all();
        foreach ($permission as $key => $value) {
          # code...
          $valuex = explode("-", $value->name);
          if (!in_array($valuex[1], $permissionnames)) {
            array_push($permissionnames, $valuex[1]);
          }
        }
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions', 'permissionnames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required',
        'name_ar' => 'sometimes',
        'permission' => 'required|min:1',
      ],[
        'name.required' => __('Please Insert Data'),
        'name_ar.required' => __('Please Insert Data'),
        'permission.required' => __('Please checkbox permission'),
      ]);
      $role = Role::find($id);
      $role->name = $request->input('name');
      $role->name_ar = $request->input('name_ar');
      $role->save();
      $role->syncPermissions($request->input('permission'));
      return redirect()->route('roles.index')
        ->with('toast_success', __('Updated Successfully.'));
    }
    public function destroy(Role $role)
    {
      App::setlocale(Auth::user()->lang);
      DB::table("roles")->where('id', $role->id)->delete();
      return redirect()->route('roles.index')
        ->with('toast_success', __('Deleted Successfully.'));
    }
}
