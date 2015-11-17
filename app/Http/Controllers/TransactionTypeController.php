<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TransactionTypeController extends Controller
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
        $types = TransactionType::All();
        $permissions = Permission::All();
        return view('transtype.index')->withTypes($types)->withPermissions($permissions);
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
        $transactionType = TransactionType::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        return $this->edit($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type)
    {

        $permissions = Permission::All();

        return view('transtype.edit')->withType($type)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type)
    {
        if ($type->locked) {
            Flash::error('Sorry, this is not editable.');
            return redirect()->back();
        }

        $type->update($request->all());
        Flash::success('You have updated the ' . $type->name . ' transaction type');
        return redirect(url('transtype/' . $type->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($transType)
    {
        if ($transType->locked) {
            Flash::error('Sorry, this permission is essential to this application.');
        } else {
            $transType->delete();
            Flash::success('You deleted ' . $transType->name);
        }

        return redirect()->back();
    }
}
