@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')

    @include('dashbord.admin.clients.clients_nav')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">

            <div class="col-md-12 row">
                <div class="col-md-9">
                    <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                        <div class="card-header" style="background-color: #f8f9fa;">
                            <h3 class="card-title"></i> {{translate('clients_payments')}}</h3>
                            <div class="card-toolbar">
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="margin-top: 30px; padding: 20px">
                                @if(isset($payment_data) && !empty($payment_data))
                                    <table id="table" class="example table table-bordered responsive nowrap text-center" cellspacing="0" width="100%">
                                        <thead>
                                        <tr class="greentd" style="background-color: lightgrey">
                                            <th>{{translate('hash')}}</th>
                                            <th>{{translate('paid_date')}}</th>
                                            <th>{{translate('paid_time')}}</th>
                                            <th>{{translate('paid_value')}}</th>
                                            <th>{{translate('recieved_from')}}</th>
                                            <th>{{translate('phone')}}</th>
                                            <th>{{translate('notes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $x = 1;
                                            $total_paid_value = 0;
                                        @endphp
                                        @foreach ($payment_data as $item)
                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td style="color: red">{{ $item['paid_date'] }}</td>
                                                <td style="color: purple">{{ $item['paid_time']}}</td>
                                                <td><span style="background-color: lightblue;" class="span_data_table">{{ $item['paid_value']}}</span></td>
                                                <td style="color: blue;text-decoration: underline">{{ $item['person_name']}}</td>
                                                <td style="color: green">{{ $item['person_phone']}}</td>
                                                <td>{{ $item['notes']}}</td>
                                            </tr>
                                            @php
                                                $total_paid_value += $item['paid_value'];
                                            @endphp
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th style="background-color: lightcoral;" colspan="3">{{translate('total_paid')}}</th>
                                            <th style="background-color: lightgoldenrodyellow;"><span  class="span_data_table">{{ $total_paid_value }}</span></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <strong>{{translate('Warning:')}}</strong> {{ translate('there_is_no_payments') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>


                <div class="col-md-3">
                    @include('dashbord.admin.load_v.client_data')

                </div>



            </div>

        </div>

    </div>









@endsection

@section('js')





    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Clients\ClientsStoreRequest', '#store_form') !!}
@endsection



