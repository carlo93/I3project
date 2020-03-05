<?php

namespace App\Http\Controllers;

use App\Api\Fixer;
use App\Exports\TransactionReportExport;
use App\Models\Transaction;
use App\Models\TransactionTypes;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Flash;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        die('index');



        $users = User::get();
        return view('transactions.index', [
            "primaryDataTable" => $primaryDataTable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $transactionTypes = TransactionTypes::all();
        $transactionTypes = $transactionTypes->pluck('name', 'id')->toArray();
        $user = User::where('id', $userId)->get()->first();

        return view('transactions.create')->with(compact('user','transactionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        // Get Form Request
        $balance = null;
        $form = $request->all();
        // Get Models
        $user = User::where('id', $userId)->get()->first();
        $transaction = Transaction::where('user_id', $userId)->get()->last();
// Set Balance
        if(empty($transaction))
        {
            $balance = $user->balance;
        }
        else{
            $balance = $transaction->balance;
        }

        // Get Transaction Amount
        $tranAmount = $form['amount'];

        // Load Fixer Api
        $fixer = new Fixer();
        $resultJson = $fixer->calc_balance($balance, $tranAmount, $form['type_id']);

        if($resultJson)
        {
            $array = json_decode($resultJson);

            // Set Transaction Array and Save
            $tArray = new Transaction();
            $tArray->user_id = $user->id;
            $tArray->transaction_type_id = intval($form['type_id']);
            $tArray->description = $form['description'];
            $tArray->amount = $tranAmount;
            $tArray->balance = $array->balance;
            $tArray->usd_rate = $array->usd_rate;
            $tArray->usd_amount = $array->usd_amount;
            $tArray->usd_balance = $array->usd_balance;

            $tArray->save();

            Flash::success('Transaction saved successfully.');
        }
        else
        {
            Flash::error('Transaction has not been saved.');
        }


        return redirect(route('transaction.slave', [$user->id]));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get()->first();

//        $fixer = new Fixer();
//        $fixer->call();
//        echo "<pre>";
//        print_r($user->transactions);
//        echo "<pre>";
//        exit;
        return view('transactions.index', [
            "user" => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Export the Reports.
     *
     * @return File
     */
    public function export($id)
    {

        return Excel::download(new TransactionReportExport($id), 'exportsheet-'.date("Y-m-d").'.xlsx');
//        return (new TransactionReportExport)->forUser($id)->download('exportsheet-'.date("Y-m-d").'.xlsx');
    }
}
