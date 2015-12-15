<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
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


        $lava = new Lavacharts; // See note below for Laravel

        $temperatures = $lava->DataTable();

        $temperatures->addDateColumn('Date')->addNumberColumn('Max Temp')->addNumberColumn('Mean Temp')->addNumberColumn('Min Temp')->addRow(array(
                                                                                                                                                 '2014-10-1',
                                                                                                                                                 67,
                                                                                                                                                 65,
                                                                                                                                                 62
                                                                                                                                             ))->addRow(array(
                                                                                                                                                            '2014-10-2',
                                                                                                                                                            68,
                                                                                                                                                            65,
                                                                                                                                                            61
                                                                                                                                                        ))->addRow(array(
                                                                                                                                                                       '2014-10-3',
                                                                                                                                                                       68,
                                                                                                                                                                       62,
                                                                                                                                                                       55
                                                                                                                                                                   ))->addRow(array(
                                                                                                                                                                                  '2014-10-4',
                                                                                                                                                                                  72,
                                                                                                                                                                                  62,
                                                                                                                                                                                  52
                                                                                                                                                                              ))->addRow(array(
                                                                                                                                                                                             '2014-10-5',
                                                                                                                                                                                             61,
                                                                                                                                                                                             54,
                                                                                                                                                                                             47
                                                                                                                                                                                         ))->addRow(array(
                                                                                                                                                                                                        '2014-10-6',
                                                                                                                                                                                                        70,
                                                                                                                                                                                                        58,
                                                                                                                                                                                                        45
                                                                                                                                                                                                    ))->addRow(array(
                                                                                                                                                                                                                   '2014-10-7',
                                                                                                                                                                                                                   74,
                                                                                                                                                                                                                   70,
                                                                                                                                                                                                                   65
                                                                                                                                                                                                               ))->addRow(array(
                                                                                                                                                                                                                              '2014-10-8',
                                                                                                                                                                                                                              75,
                                                                                                                                                                                                                              69,
                                                                                                                                                                                                                              62
                                                                                                                                                                                                                          ))->addRow(array(
                                                                                                                                                                                                                                         '2014-10-9',
                                                                                                                                                                                                                                         69,
                                                                                                                                                                                                                                         63,
                                                                                                                                                                                                                                         56
                                                                                                                                                                                                                                     ))->addRow(array(
                                                                                                                                                                                                                                                    '2014-10-10',
                                                                                                                                                                                                                                                    64,
                                                                                                                                                                                                                                                    58,
                                                                                                                                                                                                                                                    52
                                                                                                                                                                                                                                                ))->addRow(array(
                                                                                                                                                                                                                                                               '2014-10-11',
                                                                                                                                                                                                                                                               59,
                                                                                                                                                                                                                                                               55,
                                                                                                                                                                                                                                                               50
                                                                                                                                                                                                                                                           ))->addRow(array(
                                                                                                                                                                                                                                                                          '2014-10-12',
                                                                                                                                                                                                                                                                          65,
                                                                                                                                                                                                                                                                          56,
                                                                                                                                                                                                                                                                          46
                                                                                                                                                                                                                                                                      ))->addRow(array(
                                                                                                                                                                                                                                                                                     '2014-10-13',
                                                                                                                                                                                                                                                                                     66,
                                                                                                                                                                                                                                                                                     56,
                                                                                                                                                                                                                                                                                     46
                                                                                                                                                                                                                                                                                 ))->addRow(array(
                                                                                                                                                                                                                                                                                                '2014-10-14',
                                                                                                                                                                                                                                                                                                75,
                                                                                                                                                                                                                                                                                                70,
                                                                                                                                                                                                                                                                                                64
                                                                                                                                                                                                                                                                                            ))->addRow(array(
                                                                                                                                                                                                                                                                                                           '2014-10-15',
                                                                                                                                                                                                                                                                                                           76,
                                                                                                                                                                                                                                                                                                           72,
                                                                                                                                                                                                                                                                                                           68
                                                                                                                                                                                                                                                                                                       ))->addRow(array(
                                                                                                                                                                                                                                                                                                                      '2014-10-16',
                                                                                                                                                                                                                                                                                                                      71,
                                                                                                                                                                                                                                                                                                                      66,
                                                                                                                                                                                                                                                                                                                      60
                                                                                                                                                                                                                                                                                                                  ))->addRow(array(
                                                                                                                                                                                                                                                                                                                                 '2014-10-17',
                                                                                                                                                                                                                                                                                                                                 72,
                                                                                                                                                                                                                                                                                                                                 66,
                                                                                                                                                                                                                                                                                                                                 60
                                                                                                                                                                                                                                                                                                                             ))->addRow(array(
                                                                                                                                                                                                                                                                                                                                            '2014-10-18',
                                                                                                                                                                                                                                                                                                                                            63,
                                                                                                                                                                                                                                                                                                                                            62,
                                                                                                                                                                                                                                                                                                                                            62
                                                                                                                                                                                                                                                                                                                                        ));

        $linechart = $lava->LineChart('Temps')->dataTable($temperatures)->title('Weather in October');


        return view('permissions.show')->withChart($linechart);



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
