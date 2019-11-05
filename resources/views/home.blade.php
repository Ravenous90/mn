@extends('layouts.app')

    <script>
        var currentMonth = {{ $currentMonthId }};
    </script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 up-block p-3 br-10">
            <div class="row">
                {{ Form::select('months', $months, $currentMonthId,  [
                    'class' => ['form-control', 'selectpicker'],
                    'id' => 'select-month',
                    'data-style' => 'border',
                    'placeholder' => ''
                ]) }}
            </div>
            <div class="row mt-3">
                <h4>Fact balance:
                    <span class="font-weight-bold" id="fact-balance">
                        {{ $balanceFact }}
                    </span>
                </h4>
            </div>
        </div>
    </div>

{{--    $balanceFact--}}
    <div class="row justify-content-between">
        <div class="col-md-5 br-10 mt-3 pl-3 pr-3" id="in-block">
            <div class="row justify-content-center">
                <h3>
                    Input finances
                </h3>
            </div>
            <div class="row justify-content-center">
                <button id="in-button" type="button" class="btn btn-primary pl-4 pr-4 add-btn" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            <div class="row justify-content-between custom-table-row mt-2">
                <div class="col-2">
                    <span class="font-weight-bold">Date</span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold">Title</span>
                </div>
                <div class="col-1">
                    <span class="font-weight-bold">Sum</span>
                </div>
                <div class="col-1">
                </div>
            </div>
            @foreach($in as $item)
                <div class="row justify-content-between custom-table-row">
                    <div class="col-2">
                        <span style="white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($item['date'])->format('d-m-Y') }}
                        </span>
                    </div>
                    <div class="col-6">
                        {{ $item['title'] }}
                    </div>
                    <div class="col-1">
                        {{ $item['sum'] }}
                    </div>
                    <div class="col-1">
                        <span class="font-weight-bold remove-data" id="remove-in">
                            -
                        </span>
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-between custom-table-sum">
                <div class="col-4"></div>
                <div class="col-6"></div>
                <div class="col-2">
                    <h5 class="font-weight-bold" id="in-sum">
                        {{ $sum['in'] }}
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-5 br-10 mt-3 pl-3 pr-3" id="out-block">
            <div class="row justify-content-center">
                <h3>
                    Output finances
                </h3>
            </div>
            <div class="row justify-content-center">
                <button id="out-button" type="button" class="btn btn-primary pl-4 pr-4 add-btn" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            <div class="row justify-content-between custom-table-row mt-2">
                <div class="col-2">
                    <span class="font-weight-bold">Date</span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold">Title</span>
                </div>
                <div class="col-1">
                    <span class="font-weight-bold">Sum</span>
                </div>
                <div class="col-1">
                </div>
            </div>
            @foreach($out as $item)
                <div class="row justify-content-between custom-table-row">
                    <div class="col-2">
                        <span style="white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($item['date'])->format('d-m-Y') }}
                        </span>
                    </div>
                    <div class="col-6">
                        {{ $item['title'] }}
                    </div>
                    <div class="col-1">
                        {{ $item['sum'] }}
                    </div>
                    <div class="col-1">
                        <span class="font-weight-bold remove-data" id="remove-out">
                            -
                        </span>
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-between custom-table-sum">
                <div class="col-4"></div>
                <div class="col-4"></div>
                <div class="col-2">
                    <h5 class="font-weight-bold" id="out-sum">
                        {{ $sum['out'] }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8 br-10 mt-3 pl-3 pr-3" id="plan_out-block">
            <div class="row justify-content-center">
                <h3>
                    Planning output finances
                </h3>
            </div>
            <div class="row justify-content-center">
                <button id="plan_out-button" type="button" class="btn btn-primary pl-4 pr-4 add-btn" data-toggle="modal" data-target="#addData">
                    +
                </button>
            </div>
            <div class="row justify-content-between custom-table-row mt-2">
                <div class="col-2">
                    <span class="font-weight-bold">Date</span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold">Title</span>
                </div>
                <div class="col-1">
                    <span class="font-weight-bold">Sum</span>
                </div>
                <div class="col-1"></div>
            </div>
            @foreach($planOut as $item)
                <div class="row justify-content-between custom-table-row">
                    <div class="col-2">
                        <span style="white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($item['date'])->format('d-m-Y') }}
                        </span>
                    </div>
                    <div class="col-6">
                        {{ $item['title'] }}
                    </div>
                    <div class="col-1">
                        {{ $item['sum'] }}
                    </div>
                    <div class="col-1">
                        <span class="font-weight-bold remove-data" id="remove-plan_oun">
                            -
                        </span>
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-between custom-table-sum">
                <div class="col-4"></div>
                <div class="col-6"></div>
                <div class="col-2">
                    <h5 class="font-weight-bold" id="plan_out-sum">
                        {{ $sum['plan_out'] }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modal')

</div>
@endsection
