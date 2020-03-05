<?php

use Illuminate\Database\Seeder;
use App\Models\TransactionTypes;

class TransactionTypesTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionTypes::create([
            'name' => 'Debit',
            'code' => 'debit'
        ]);
        TransactionTypes::create([
            'name' => 'Credit',
            'code' => 'credit'
        ]);
    }
}
