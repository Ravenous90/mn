@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 up-block p-3 br-10"> main info
            <div class="row p-3">
                {{ Form::select('months', $months, $currentMonthId,  [
                    'class' => ['form-control', 'selectpicker'],
                    'data-style' => 'border',
                    'placeholder' => ''
                ]) }}
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-5 middle-block br-10 mt-3 pl-3 pr-3">
            <div class="row justify-content-center">
                <button id="in-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            input finance </div>
        <div class="col-md-5 middle-block br-10 mt-3 pl-3 pr-3">
            <div class="row justify-content-center">
                <button id="out-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            output finance
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 down-block br-10 mt-3 pl-3 pr-3">
            <div class="row justify-content-center">
                <button id="plan_out-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            plan to output this month
        </div>
    </div>

    @include('partials.modal')
</div>
@endsection
