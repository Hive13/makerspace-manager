<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\User;

class TransactionController extends Controller
{

    protected $user;

    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
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


        $depositType = TransactionType::where('name', 'stripe_deposit')->first();

        $stripeResponse = $this->user->charge(($request->input('amount')*100), [
            'source' => $request->input('stripeToken'),
            'receipt_email' => $this->user->email,
        ]);

        $trans = new Transaction();
        $trans->amount = $request->input('amount');
        $trans->user_id = $this->user->id;
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

    /**
     * This function is for when a user donates money to another user via their profile.
     *
     * @param Request $request
     */
    public function processGift(Request $request) {

        $giftTransactionType = TransactionType::where(['name'=>'user_gift'])->get()->first();

        $recievingUser = User::find($request->input('user_id'));

        $sendingTransaction = new Transaction([
            'user_id' => $this->user->id,
            'transaction_type_id' => $giftTransactionType->id,
            'amount' => -$request->input('amount'),
            'description' => "You sent money to ".$recievingUser->name,
        ]);

        $recievingTransaction = new Transaction([
            'user_id' => $request->input('user_id'),
            'transaction_type_id' => $giftTransactionType->id,
            'amount' => $request->input('amount'),
            'description' => "You recieved a gift from ".$this->user->name,
        ]);

        if($sendingTransaction->save()) {
            $recievingTransaction->save();
            Flash::success('You have sent '.$recievingTransaction->present()->amount.' to '.$recievingTransaction->user->name);
        } else {
            Flash::error('There was an error, please contact support.');
        }

        return redirect ('/');

    }
}
