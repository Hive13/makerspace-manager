<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    protected $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        $depositType = TransactionType::where('name', 'deposit')->first();

        $stripeResponse = $this->guard->user()->charge(10000, [
            'source' => $request->input('stripeToken'),
            'receipt_email' => $this->guard->user()->email,
        ]);

        $trans = new Transaction();
        $trans->amount = 10;
        $trans->user_id = $this->guard->user()->id;
        $trans->transaction_type_id = $depositType->id;
        $trans->stripe_id = $stripeResponse->id;
        $trans->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
