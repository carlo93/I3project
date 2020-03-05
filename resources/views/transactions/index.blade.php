@extends('layouts.custom')
@section('title','Transactions')

@section('content')
    <div class="transaction-page">
        <div class="container bg-white">
            <h1 class="mt-3">Transactions <a class="btn btn-primary btn-md pull-right" href="{!! route('transaction.create', [$user->id]) !!}">Add Transaction</a></h1>
            @include('flash::message')
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <p>Full Name: <strong>{{$user->full_name}}</strong></p>
                    <p>Email: <strong>{{$user->email}}</strong></p>
                    <p>Balance :<strong>{{$user->balance}}</strong></p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">

                </div>
            </div>

            @if(!$user->transactions->isEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    ZAR Amount
                                </th>
                                <th>
                                    USD Rates
                                </th>
                                <th>
                                    USD Amount
                                </th>
                                <th>
                                    USD Balance
                                </th>
                                <th>
                                    Balance
                                </th>
                            </thead>
                            <tbody>
                                @foreach($user->transactions as $row)
                                    <tr>
                                        <td>@if($row->description) {{ $row->description }} @endif</td>
                                        <td>@if($row->transaction_types) {{ $row->transaction_types->name }} @endif</td>
                                        <td>@if($row->amount) {{ $row->amount }} @endif</td>
                                        <td>@if($row->usd_rate) {{ $row->usd_rate }} @endif</td>
                                        <td>@if($row->usd_amount) {{ $row->usd_amount }} @endif</td>
                                        <td>@if($row->usd_balance) {{ $row->usd_balance }} @endif</td>
                                        <td>@if($row->balance) {{ $row->balance }} @endif</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <a href="{!! route('transaction.export', [$user->id]) !!}" class="export-link mb-4">Export Excel</a>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection
