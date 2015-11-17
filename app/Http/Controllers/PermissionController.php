<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $permissions = Permission::All();

        $users = User::All();

        return view('permissions.index')->withPermissions($permissions)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('admin');
        $permission = Permission::create($request->all());
        return redirect('perm');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($permission)
    {
        return $this->edit($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($permission)
    {

        $users = User::All();
        $permission->load('users');
        $this->authorize('edit-permission', $permission);

        return view('permissions.edit')->withPermission($permission)->withUsers($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $permission)
    {
        $this->authorize('edit-permission', $permission);
        $permission->update($request->all());
        Flash::success('Updated permission');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission)
    {
        $permission->delete();
        return redirect()->back();
    }

    /**
     * Grant a permission to a user
     */
    public function grantPermission(Request $request)
    {

        $user = User::find($request->get('user_id'));

        if ($request->get('permission_id') == 'all') {
            $permissions = Permission::All();
            foreach ($permissions as $permission) {
                if (!$user->permissions->contains($permission->id)) {
                    $user->permissions()->attach($permission);
                    if($request->get('is_master')) {
                        $target = $user->permissions()->find($permission->id);
                        $target->pivot->is_master = true;
                        $target->pivot->save();
                    }
                }
            }
            Flash::success('Gave ' . $user->name . ' all permissions.');
            return redirect()->back();
        }

        $permission = Permission::find($request->get('permission_id'));
        $user->permissions()->attach($permission);
        if($request->get('is_master')) {
            $target = $user->permissions()->find($permission->id);
            $target->pivot->is_master = true;
            $target->pivot->save();
        }
        Flash::success('Gave ' . $user->name . ' permission:' . $permission->name);
        return redirect()->back();
    }

    public function deletePermission(Request $request)
    {
        $user = User::find($request->get('user_id'));
        $permission = Permission::find($request->get('permission_id'));
        if ($user->permissions->contains($permission->id)) {
            $user->permissions()->detach($permission->id);
        }
        return redirect()->back();

    }

    public function grantMaster(Request $request)
    {


        $user = User::find($request->get('user_id'));
        $permission = Permission::find($request->get('permission_id'));

        if ($user->permissions->contains($permission->id)) {
            $target = $user->permissions->find($permission->id);
            $target->pivot->is_master = true;
            $target->pivot->save();
        }

        return redirect()->back();
    }

    public function deleteMaster(Request $request)
    {

    }


}
