@extends('dashbord.layouts.master')
@section('css')
   <style>
       .card{
           border: 1px solid #ccc;
       }
   </style>


@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="row">
                 {{--user--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-person-circle text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('users')}}</h5> <!-- Removed translate function -->
                                <a href="{{route('admin.user_data')}}" class="card-text">{{data_count('admins')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--clients--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-secondary p-5 me-3">
                                <i class="bi bi-person-check text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('clients')}}</h5> <!-- Removed translate function -->
                                <a href="{{route('admin.clients_data')}}"   class="card-text">{{data_count('tbl_clients')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--cases--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-success p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('cases')}}</h5> <!-- Removed translate function -->
                                <a href="{{route('admin.cases_data')}}"   class="card-text">{{data_count('tbl_clients_cases')}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--legal_services--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-success p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('legal_services')}}</h5> <!-- Removed translate function -->
                                <a href="{{route('admin.index_legal_services')}}"   class="card-text">{{data_count('tbl_legal_services')}}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" style="margin-top: 10px">

                {{--sessions--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-warning p-5 me-3">
                                <i class="bi bi-people text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('sessions')}}</h5>
                                <p class="card-text">{{data_count('tbl_cases_sessions')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{--sessions--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-warning p-5 me-3">
                                <i class="bi bi-people text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('contract_forms')}}</h5> <!-- Removed translate function -->
                                <p class="card-text">{{data_count('tbl_contract_forms')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-warning p-5 me-3">
                                <i class="bi bi-people text-white fs-2x"></i> <!-- Changed color and icon -->
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('employees')}}</h5> <!-- Removed translate function -->
                                <p class="card-text">{{data_count('employees')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i>
                            </div>

                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('folder_in_archive')}}</h5> <!-- Removed translate function -->
                                <a href="{{route('admin.user_data')}}" class="card-text">{{data_count('tbl_archive')}}</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-success p-5 me-3">
                                <i class="bi bi-currency-dollar text-white fs-2x"></i>
                            </div>

                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('total_financial_dues')}}</h5>
                                <a class="card-text">0 {{get_currency()}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-warning p-5 me-3">
                                <i class="bi bi-bar-chart-line text-white fs-2x"></i>
                            </div>

                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('obtained_financial_dues')}}</h5> <!-- Removed translate function -->
                                <a class="card-text">0 {{get_currency()}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-danger p-5 me-3">
                                <i class="bi bi-currency-dollar text-white fs-2x"></i>
                            </div>

                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('total_cost')}}</h5> <!-- Removed translate function -->
                                <a class="card-text">0 {{get_currency()}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-warning p-5 me-3">
                                <i class="bi bi-bar-chart-line text-white fs-2x"></i>
                            </div>

                            <div>
                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('net_profit')}}</h5> <!-- Removed translate function -->
                                <a class="card-text">0 {{get_currency()}}</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>





{{--
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i>
                            </div>

                            <div>

                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('today_payments_sum')}}</h5> <!-- Removed translate function -->
                                <h5 class="text-center text-danger">( {{current_day()}} )</h5>
                                <h5 class="text-center">
                                    <a href="{{redirect()->to(URL::current())}}" class="card-text ">{{get_today_payments_sum()}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i>
                            </div>

                            <div>

                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('monthly_payments_sum')}}</h5> <!-- Removed translate function -->
                                <h5 class="text-center text-danger">( {{current_month()}} )</h5>
                                <h5 class="text-center">
                                    <a href="{{redirect()->to(URL::current())}}" class="card-text ">{{get_monthly_payments_sum()}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i>
                            </div>

                            <div>

                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('yearly_payments_sum')}}</h5> <!-- Removed translate function -->
                                <h5 class="text-center text-danger">( {{current_year()}} )</h5>
                                <h5 class="text-center">
                                    <a href="{{redirect()->to(URL::current())}}" class="card-text ">{{get_yearly_payments_sum()}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                            <div class="bg-primary p-5 me-3">
                                <i class="bi bi-folder text-white fs-2x"></i>
                            </div>

                            <div>

                                <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('all_payments_sum')}}</h5> <!-- Removed translate function -->
                                <h5 class="text-center text-danger">{{translate('since')}} - {{get_oldest_payment_date()}} </h5>
                                <h5 class="text-center">
                                    <a href="{{redirect()->to(URL::current())}}" class="card-text ">{{get_all_payments_sum()}}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}


            <div class="row" style="margin-top: 10px">
                <div class="col-md-6">
                    <div class="card" style="border: 1px solid #ccc;">
                        <div class="card-header">
                            <h5 class="card-title">{{translate('agenda')}}</h5>
                        </div>
                        <ul class="products-list product-list-in-card pl-2 pr-2" style="padding: 10px">
                            <?php $x=1; ?>
                            @foreach ($all_agenda as $item)
                                <?php
                                $dateTime = new DateTime($item->start);
                                $date = $dateTime->format('Y-m-d');
                                $time = $dateTime->format('H:i:s');
                                $today = date('Y-m-d');
                                    if ($item->status == 'done')
                                    {
                                        $color= '#43915e';
                                        $title= 'تمت';

                                    }else{
                                        $color='#ed3d07';
                                        $title='جارية';
                                    }
                                ?>
                                <li class="item d-flex justify-content-between align-items-center" style="margin-bottom: 5px; <?php if ($date == $today) { echo 'border: 2px solid green;'; } ?>">
                                    <div class="first-div">
                                        <span>{{$x++}}:</span>
                                        <span class="text-muted"><i class="bi bi-calendar-event"></i> {{translate('title')}}:</span>
                                        <span  style="color: black; <?php if ($item->status == 'done') { echo 'text-decoration: line-through;'; } ?>">{{$item->title}}</span>
                                        (<span  style=" color:{{$color}}">{{$title}}</span>)
                                    </div>

                                    <div class="second-div">
                                        <span class="text-muted"><i class="bi bi-calendar3"></i> {{translate('date')}}:</span>
                                        <span style="color: green">{{$date}}</span>
                                        <span class="text-muted"><i class="bi bi-clock"></i> {{translate('time')}}:</span>
                                        <span style="color: red">{{$time}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>






                </div>




                <div class="col-md-6" >
                    <div class="card" style="border: 1px solid #ccc;">
                        <div class="card-header">
                            <h5 class="card-title">{{translate('agenda')}}</h5>
                        </div>
                        <div id="kt_docs_fullcalendar_basic" style="height: 400px;"></div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-top: 10px; ">
                <div class="col-md-3">
                   <div class="col-m-12">
                       <div class="card">
                           <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                               <div class="bg-danger p-5 me-3">
                                   <i class="bi bi-currency-dollar text-white fs-2x"></i>
                               </div>

                               <div>
                                   <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('total_cost')}}</h5> <!-- Removed translate function -->
                                   <a class="card-text">0 {{get_currency()}}</a>
                               </div>
                           </div>
                       </div>
                   </div>
                    <div class="col-m-12" style="height: 500px;overflow-y: scroll;">
                        <div class="card" style="border: 1px solid #ccc;">
                            <div class="card-header">
                                <h5 class="card-title">{{translate('agenda')}}</h5>
                            </div>
                            <ul class="products-list product-list-in-card pl-2 pr-2" style="padding: 10px">
                                <?php $x=1; ?>
                                @foreach ($all_agenda as $item)
                                    <?php
                                    $dateTime = new DateTime($item->start);
                                    $date = $dateTime->format('Y-m-d');
                                    $time = $dateTime->format('H:i:s');
                                    $today = date('Y-m-d');
                                    if ($item->status == 'done')
                                    {
                                        $color= '#43915e';
                                        $title= 'تمت';

                                    }else{
                                        $color='#ed3d07';
                                        $title='جارية';
                                    }
                                    ?>
                                    <li class="item d-flex justify-content-between align-items-center" style="margin-bottom: 5px; <?php if ($date == $today) { echo 'border: 2px solid green;'; } ?>">
                                        <div class="first-div">
                                            <span>{{$x++}}:</span>
                                            <span class="text-muted"><i class="bi bi-calendar-event"></i> {{translate('title')}}:</span>
                                            <span  style="color: black; <?php if ($item->status == 'done') { echo 'text-decoration: line-through;'; } ?>">{{$item->title}}</span>
                                            (<span  style=" color:{{$color}}">{{$title}}</span>)
                                        </div>

                                        <div class="second-div">
                                            <span class="text-muted"><i class="bi bi-calendar3"></i> {{translate('date')}}:</span>
                                            <span style="color: green">{{$date}}</span>
                                            <span class="text-muted"><i class="bi bi-clock"></i> {{translate('time')}}:</span>
                                            <span style="color: red">{{$time}}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-3">

                    <div class="col-m-12">
                        <div class="card">
                            <div class="card-body d-flex align-items-center" style="padding: 10px !important;">
                                <div class="bg-danger p-5 me-3">
                                    <i class="bi bi-currency-dollar text-white fs-2x"></i>
                                </div>

                                <div>
                                    <h5 class="card-title mb-0" style="font-size: 16px;">{{translate('total_cost')}}</h5>
                                    <a class="card-text">0 {{get_currency()}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-m-12" style="height: 500px;overflow-y: scroll;">
                        <div class="card" style="border: 1px solid #ccc;">
                            <div class="card-header">
                                <h5 class="card-title">{{translate('agenda')}}</h5>
                            </div>
                            <ul class="products-list product-list-in-card pl-2 pr-2" style="padding: 10px">
                                <?php $x=1; ?>
                                @foreach ($all_agenda as $item)
                                    <?php
                                    $dateTime = new DateTime($item->start);
                                    $date = $dateTime->format('Y-m-d');
                                    $time = $dateTime->format('H:i:s');
                                    $today = date('Y-m-d');
                                    if ($item->status == 'done')
                                    {
                                        $color= '#43915e';
                                        $title= 'تمت';

                                    }else{
                                        $color='#ed3d07';
                                        $title='جارية';
                                    }
                                    ?>
                                    <li class="item d-flex justify-content-between align-items-center" style="margin-bottom: 5px; <?php if ($date == $today) { echo 'border: 2px solid green;'; } ?>">
                                        <div class="first-div">
                                            <span>{{$x++}}:</span>
                                            <span class="text-muted"><i class="bi bi-calendar-event"></i> {{translate('title')}}:</span>
                                            <span  style="color: black; <?php if ($item->status == 'done') { echo 'text-decoration: line-through;'; } ?>">{{$item->title}}</span>
                                            (<span  style=" color:{{$color}}">{{$title}}</span>)
                                        </div>

                                        <div class="second-div">
                                            <span class="text-muted"><i class="bi bi-calendar3"></i> {{translate('date')}}:</span>
                                            <span style="color: green">{{$date}}</span>
                                            <span class="text-muted"><i class="bi bi-clock"></i> {{translate('time')}}:</span>
                                            <span style="color: red">{{$time}}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        "use strict";

        // Class definition
        var KTGeneralFullCalendarBasicDemos = function () {
            // Private functions

            var exampleBasic = function () {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('kt_docs_fullcalendar_basic');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'ar',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },

                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                    nowIndicator: true,
                    now: TODAY + 'T09:25:00', // just for demo

                    views: {
                        dayGridMonth: { buttonText: 'month' },
                        timeGridWeek: { buttonText: 'week' },
                        timeGridDay: { buttonText: 'day' }
                    },

                    initialView: 'dayGridMonth',
                    initialDate: TODAY,

                    editable: true,
                    dayMaxEvents: true, // allow "more" link when too many events
                    navLinks: true,
                    events: [
                            @foreach($all_data as $event)
                        {
                            id: '{{ $event->id }}',
                            title: '{{ $event->title }}',
                            start: '{{ $event->start }}',
                            end: '{{ $event->end }}',
                            type: '{{ $event->status }}',
                            description: '{{ $event->description }}',
                            className: '{{ $event->status === "do" ? "fc-event-primary do" : ($event->status === "doing" ? "fc-event-primary doing" : "fc-event-primary done") }}',
                        },
                        @endforeach
                    ],




                    eventContent: function (info) {
                        var element = $(info.el);

                        if (info.event.extendedProps && info.event.extendedProps.description) {
                            if (element.hasClass('fc-day-grid-event')) {
                                element.data('content', info.event.extendedProps.description);
                                element.data('placement', 'top');
                                KTApp.initPopover(element);
                            } else if (element.hasClass('fc-time-grid-event')) {
                                element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                            }
                        }
                    },




                    dateClick: function(info) {
                        var clickedDate = info.date;
                        var eventsOnDate = calendar.getEvents().filter(function(event) {
                            return event.start.toDateString() === clickedDate.toDateString();
                        });

                        var modalBody = $('#modaldetails').find('.modal-body');
                        modalBody.empty();

                        if (eventsOnDate.length > 0) {
                            var table = $('<table class="table table-striped"></table>');
                            var tableHead = $('<thead><tr><th>{{translate('title')}}</th><th>{{translate('description')}}</th><th>{{translate('start')}}</th><th>{{translate('end')}}</th><th>{{translate('status')}}</th><th>{{translate('actions')}}</th></tr></thead>');
                            var tableBody = $('<tbody></tbody>');

                            eventsOnDate.forEach(function(event) {
                                //console.log('evddd::'+event.extendedProps.type);
                                var row = $('<tr></tr>');
                                row.append('<td><input type="text" class="form-control" value="' + event.title + '"></td>');
                                row.append('<td><input type="text" class="form-control" value="' + (event.extendedProps.description || '') + '"></td>');
                                row.append('<td><input type="datetime-local" class="form-control" value="' + event.start.toISOString().slice(0, 16) + '"></td>');
                                row.append('<td><input type="datetime-local" class="form-control" value="' + event.end.toISOString().slice(0, 16) + '"></td>');
                                var statusSelect = '<select class="form-control">' +
                                    '<option value="do" ' + (event.extendedProps.type === 'do' ? 'selected' : '') + '>{{translate('do')}}</option>' +
                                    '<option value="doing" ' + (event.extendedProps.type === 'doing' ? 'selected' : '') + '>{{translate('doing')}}</option>' +
                                    '<option value="done" ' + (event.extendedProps.type === 'done' ? 'selected' : '') + '>{{translate('done')}}</option>' +
                                    '</select>';
                                row.append('<td>' + statusSelect + '</td>');

                                var deleteIcon = $('<a class="delete-event-btn text-danger " data-event-id="' + event.id + '"><i class="bi bi-trash"></i></a>');
                                deleteIcon.on('click', function() {
                                    if (confirm("Are you sure you want to delete this event?")) {
                                        var eventId = $(this).data('event-id');
                                        deleteEvent(eventId);
                                        //  row.remove(); // Remove the row from the table
                                    }
                                });

                                var editIcon = $('<a class="edit-event-btn text-warning"><i class="bi bi-pencil"></i></a>');
                                editIcon.on('click', function() {
                                    // Call a function to handle editing the event
                                    // You can access the input values within this function
                                    var editedEvent = {
                                        title: row.find('input:eq(0)').val(),
                                        description: row.find('input:eq(1)').val(),
                                        start: row.find('input:eq(2)').val(),
                                        end: row.find('input:eq(3)').val(),
                                        status: row.find('select').val(),

                                    };
                                    editEvent(event.id, editedEvent);
                                });
                                row.append($('<td></td>').append(deleteIcon).append(editIcon));
                                tableBody.append(row);
                            });

                            table.append(tableHead);
                            table.append(tableBody);
                            modalBody.append(table);
                        } else {
                            modalBody.text('No events found for this day.');
                        }

                        $('#modaldetails').modal('show');
                    }

                });

                calendar.render();
            }

            return {
                // Public Functions
                init: function () {
                    exampleBasic();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTGeneralFullCalendarBasicDemos.init();
        });

        function deleteEvent(eventId) {
            $.ajax({
                url: "{{ route('admin.delete_event', ['id' => '__id__']) }}".replace('__id__', eventId),
                type: "get",
                dataType: "json",
                success: function(response) {
                    window.location.href="{{ route('admin.agenda_data') }}"
                },
                error: function(xhr, status, error) {
                    window.location.href="{{ route('admin.agenda_data') }}"
                }

            });
        }

        function editEvent(eventId, editedEvent) {
            $.ajax({
                url: "{{ route('admin.edit_event', ['id' => '__id__']) }}".replace('__id__', eventId),
                type: "post", // Change to "post" since you are sending data to the server
                dataType: "json",
                data: editedEvent, // Send the edited event data to the server
                success: function(response) {
                    window.location.href="{{ route('admin.agenda_data') }}"
                },
                error: function(xhr, status, error) {
                    window.location.href="{{ route('admin.agenda_data') }}"
                }
            });
        }





    </script>
@endsection
