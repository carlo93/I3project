@extends('layouts.custom')
@section('title', 'Create Transaction')
@section('content')
    <div class="transaction-page">
        <div class="container bg-white">
        <section class="content-header">
            <h1 class="mt-3 pt-lg-4">
                Create Transaction : {{ $user->full_name }}
            </h1>
            <hr>
        </section>
        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::open(['route' => ['transaction.store', $user->id]]) !!}

                        @include('transactions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
