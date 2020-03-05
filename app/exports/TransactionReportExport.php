<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Transaction;


class TransactionReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {

        $currentUserId = request()->route()->parameters()['id'];
        $user = User::where('id', $currentUserId)->get()->first();

        $transactions = $user->transactions;

        foreach($transactions as $row){
            $obj = new \stdClass;

            $obj->full_name = $user->full_name;
            $obj->description = $row->description;
            $obj->tran_type = ($row->transaction_types) ? $row->transaction_types->name : '';
            $obj->amount = $row->amount;
            $obj->user_rates = $row->usd_rate;
            $obj->usd_amount = $row->usd_amount;
            $obj->usd_balance = $row->usd_balance;
            $obj->balance = $row->balance;
            $obj->created_at = date('Y-m-d H:i:s', strtotime($row->created_at));

            $data[] = $obj;
        }

        return new Collection($data);
    }


	public function headings(): array
	{
		return [
			'Full Name',
			'Description',
            'Tran Type',
			'ZAR Amount',
            'USD Rates',
            'USD Amount',
            'USD Balance',
			'Balance',
			'Created At',
		];
	}
}
