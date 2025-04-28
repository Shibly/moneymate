@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{$title}}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-3">
                    <div class="container-xl">
                        <div class="col-12 d-flex flex-column">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Details</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th class="w-25">Category</th>
                                <td id="modal-category"></td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td id="modal-amount" class="text-success"></td>
                            </tr>
                            <tr>
                                <th>Currency</th>
                                <td id="modal-currency"></td>
                            </tr>
                            <tr>
                                <th>Account</th>
                                <td id="modal-account"></td>
                            </tr>
                            <tr>
                                <th>Reference</th>
                                <td id="modal-reference"></td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td id="modal-note"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td id="modal-description"></td>
                            </tr>
                            <tr>
                                <th>Attachment</th>
                                <td id="modal-attachment"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('libs/fullcalendar/index.global.js') }}"></script>
    <script>
        "use strict";

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: "{{ route('calendar.data') }}",
                eventDidMount: function (info) {
                    info.el.style.cursor = 'pointer'; // Add pointer cursor on hover
                },
                eventClick: function (info) {
                    var event = info.event.extendedProps;
                    document.getElementById("modal-title").innerText = info.event.title;
                    document.getElementById("modal-category").innerText = info.event.title;
                    document.getElementById("modal-amount").innerText = event.amount;
                    document.getElementById("modal-currency").innerText = event.currency;
                    document.getElementById("modal-account").innerText = event.account;
                    document.getElementById("modal-reference").innerText = event.reference || 'N/A';
                    document.getElementById("modal-note").innerText = event.note || 'N/A';
                    document.getElementById("modal-description").innerText = event.description || 'N/A';
                    if (event.attachment) {
                        const downloadUrl = "{{ url('/download/attachment') }}/" + encodeURIComponent(event.attachment);
                        document.getElementById("modal-attachment").innerHTML =
                            `<a href="${downloadUrl}" target="_blank">Download Attachment</a>`;
                    } else {
                        document.getElementById("modal-attachment").innerHTML = '<span>No attachment</span>';
                    }

                    var modal = new bootstrap.Modal(document.getElementById("modal-large"));
                    modal.show();
                }
            });
            calendar.render();
        });
    </script>

@endsection
