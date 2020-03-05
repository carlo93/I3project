<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">

            <!-- Type Field -->
            <div class="form-group">
                {!! Form::label('type_id', 'Transaction Type:') !!}
                {{ Form::select('type_id',  $transactionTypes,null, ['class' => 'form-control select2', 'required']) }}
            </div>
            <!-- Description Field -->
            <div class="form-group">
                {!! Form::label('description', 'Description: <span class="text-danger">*</span>', [], false) !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <!-- Amount Field -->
            <div class="form-group">
                {!! Form::label('amount', 'Amount: <span class="text-danger">*</span>', [], false) !!}
                {!! Form::text('amount', null, ['class' => 'form-control', 'required']) !!}
            </div>
    </div>
</div>


<!-- Submit Field -->
<div class="row">
    <div class="form-group col-sm-12">
        <a href="{!! route('transaction.slave', [$user->id]) !!}" class="btn btn-link">Cancel</a>
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
