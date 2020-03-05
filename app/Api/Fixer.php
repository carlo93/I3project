<?php

namespace App\Api;

use App\Models\TransactionTypes;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Facades\Excel;


class Fixer
{
    private $date = null;
    public function model(array $row)
    {
        dd($row);
        return new Clients([
            'first_name' => $row[0],
        ]);
    }

    public function call($object = false)
    {
        // Api Curl Script
        $curl = curl_init();

//        $apiKey = 'b22d182d916f691b5d1bfcec8880fd3a';
        //        http://data.fixer.io/api/convert? access_key = YOUR_ACCESS_KEY & from = USD
//    & to = EUR
//    & amount = 25

//        http://data.fixer.io/api/latest?access_key=b22d182d916f691b5d1bfcec8880fd3a
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.exchangerate-api.com/v4/latest/USD",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type:application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if($object)
        {
            return $response;
        }

        $exchangeRates = json_decode($response)->rates;

        $USDToZARRate = round($exchangeRates->ZAR, 2);

        return $USDToZARRate;
    }

    public function calc_balance($uBalance, $tAmount, $tran_type_id)
    {
        // Set Empty Array
        $array = array();

        // Get USD to ZAR Rate
        $rate = $this->call();
        // Get Transaction Type
        $type = TransactionTypes::where('id', $tran_type_id)->get()->first();
        // Calculate New Balance
        $calculationBalance = ($type->code == 'debit') ? $this->debit($uBalance, $tAmount) : $this->credit($uBalance, $tAmount);

        // Set Values
        $array['balance'] = $calculationBalance;
        $array['usd_rate'] = $rate;
        $array['usd_amount'] = bcdiv($tAmount, $rate,2);
        $array['usd_balance'] = bcdiv($calculationBalance, $rate,2);

        return json_encode($array);
    }

    private function credit($uBalance, $tAmount)
    {
        // Calculate Credit
        return round($uBalance + $tAmount, 2);
    }

    private function debit($uBalance, $tAmount)
    {
        // Calculate Debit
        return round($uBalance - $tAmount, 2);
    }

    public function calc_user_balance($tAmount, $uBalance)
    {
        $array = array();

        $object = $this->call();
        $object = json_decode($object);

        $array['balance'] = $uBalance - $tAmount;
        $array['usd_amount'] = bcdiv($tAmount, $rate);
        $array['usd_balance'] = bcdiv($array['balance'], $rate);


        return json_encode($array);
    }

}
