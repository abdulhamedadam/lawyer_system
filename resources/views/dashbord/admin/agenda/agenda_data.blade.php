@extends('dashbord.layouts.master')
@section('css')
<style>
    .do {
        background-color: lightgoldenrodyellow !important;
        color: black !important;
    }
    .doing{
        background-color: lightgreen !important;
        color: black !important;
    }
    .done{
        background-color: lightcoral !important;
        text-decoration: line-through !important;
        text-decoration-color: black !important;

        color: black !important;
    }

         /* Custom CSS for modal */
     .modelCalender {
         max-width: 80% !important;
         margin: 0 auto !important; /* This centers the modal horizontally */
     }

</style>
@notifyCss
@endsection
@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid" >
    <div id="kt_app_content_container" class="t_container" >
        <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
            <div class="card-header">
                <h3 class="card-title"></i> {{translate('agenda')}}</h3>
                <div class="card-toolbar">
                    <div class="text-center">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalsettings">
                            <i class="bi bi-plus fs-3"></i>{{translate('add_agenda')}}
                        </a>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <div id="kt_docs_fullcalendar_basic"></div>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalsettings">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #0c5460;">
                <h3 class="modal-title" style="color:white"><?=translate('add_agenda')?></h3>


                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>
            <form method="post" action="{{route('admin.save_agenda')}}" enctype="multipart/form-data" id="form">
                @csrf
                <div class="modal-body">
                <input type="hidden" name="row_id" id="row_id" value="">
                <div class="row col-md-12" style="margin: 10px">
                    <div class="col-md-4" >
                        <label for="title" class="form-label">{{translate('title')}}</label>
                        <input type="text" class="form-control" name="title" id="title" value="" >
                    </div>
                    <div class="col-md-8" >
                        <label for="" class="form-label">{{translate('description')}}</label>
                        <input type="text" class="form-control" name="description" id="description" value="" >
                    </div>
                </div>
                    <div class="row col-md-12" style="margin: 10px">
                        <div class="col-md-6" >
                            <label for="title" class="form-label">{{translate('start')}}</label>
                            <input type="datetime-local" class="form-control" name="start" id="start" value="" >
                        </div>
                        <div class="col-md-6" >
                            <label for="title" class="form-label">{{translate('end')}}</label>
                            <input type="datetime-local" class="form-control" name="end" id="end" value="" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                </div>

            </form>


        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modaldetails1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #0c5460;">
                <h3 class="modal-title" style="color:white"><?=translate('agenda_details')?></h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>
            <form method="post" action="" enctype="multipart/form-data" id="form">
                @csrf
                <div class="modal-body">

                </div>
                <div class="modal-footer" >
                    <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                </div>

            </form>


        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="modaldetails">
    <div class="modal-dialog modal-xl modal-dialog-centered modelCalender">
        <div class="modal-content">
            <div class="modal-header" style="background: #0c5460;">
                <h3 class="modal-title" style="color:white"><?=translate('agenda_details')?></h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">&times;</i>
                </div>

            </div>
            <div class="modal-body">

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
                        if (element.hasClass('fc-event-primary')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            info.event.setProp('borderColor', '#ff0000');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description text-danger">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').length !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description text-danger">' + info.event.extendedProps.description + '</div>');
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


<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\Agenda\AgendaSave_R', '#form') !!}

@endsection



