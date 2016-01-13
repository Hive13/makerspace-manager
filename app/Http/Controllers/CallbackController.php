<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Callback;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callbacks = Callback::all();
        return view('callbacks.index')->withCallbacks($callbacks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('callbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $callback = new Callback($request->all());
        if ($callback->save()) {
            return redirect('callback');
        }
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Callback $cb)
    {
        return view('callbacks.show')->withCallback($cb);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Callback $cb)
    {
        return view('callbacks.edit')->withCallback($cb);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Callback $cb)
    {
        foreach ($request->except('_token') as $key => $value) {
            $cb->$key = $value;
        }
        if ($cb->save()) {
            return redirect('callback/' . $cb->id);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Callback $cb)
    {
        if ($cb->delete()) {
            return redirect('callback');
        }
        return redirect()->back();
    }
}
