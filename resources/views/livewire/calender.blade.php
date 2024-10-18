<div>
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css" integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --fc-event-bg-color: var(--bs-primary) !important;
            --fc-event-border-color: var(--bs-primary) !important;
        }
        .fc-event-title a {
            color: white !important;
        }
        .fc-daygrid-event {
            border-radius: 50em;
            padding: 3px 10px;
        }
    </style>
    @endpush
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-5">
                <div class="row">
                    <div class="col-lg-3">
                        <div id="external-events">
                            <p class="font-bold">Add to Calendar</p>

                            <button type="button" class="btn btn-primary text-start w-100 mb-2 px-3" wire:click="newEvent('event')" data-bs-toggle="modal" data-bs-target="#addCustomEvent">
                                <i class="fas fa-plus"></i> Event
                            </button>

                            <hr />

                            <button type="button" class="btn btn-primary text-start w-100 mb-2 px-3" wire:click="newEvent('custom')" data-bs-toggle="modal" data-bs-target="#addCustomEvent">
                                <i class="fas fa-plus"></i> Custom
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addCustomEvent" tabindex="-1" role="dialog" aria-labelledby="addCustomEventLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form wire:submit.prevent="save">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addCustomEventLabel">Add Event to Calendar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($newType == "custom" || $newType == "event")
                                                <div class="mb-3">
                                                    <label class="form-label" for="label">Title</label>
                                                    <input type="text" id="label" class="form-control" wire:model.defer="event.title" required />
                                                </div>
                                                @endif



                                                @if($newType == "custom" || $newType == "event")
                                                    <div class="mb-3">
                                                        <label class="form-label" for="date">Start Date</label>
                                                        <input type="text" id="start_date" class="form-control flatpickr" wire:model.defer="event.start_date" placeholder="mm/dd/yyyy" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="date">End Date</label>
                                                        <input type="text" id="end_date" class="form-control flatpickr" wire:model.defer="event.end_date" placeholder="mm/dd/yyyy" required />
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <label class="form-label" for="date">Schedule Date</label>
                                                        <input type="text" id="start_date" class="form-control flatpickr" wire:model.defer="event.start_date" placeholder="mm/dd/yyyy" required />
                                                    </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label" for="time">Time</label>
                                                    <input type="text" id="time" class="form-control" wire:model.defer="event.time" />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="intensity">Intensity</label>
                                                    <input type="text" id="intensity" class="form-control" wire:model.defer="event.intensity" />
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="notes">Notes</label>
                                                    <textarea id="notes" class="form-control" wire:model.defer="event.notes"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div id="calendar-container" wire:ignore>
                            <div id="calendar"></div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js" integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js" integrity="sha256-rPPF6R+AH/Gilj2aC00ZAuB2EKmnEjXlEWx5MkAp7bw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales-all.min.js" integrity="sha256-/ZgxvDj3QtyBZNLbfJaHdwbHF8R6OW82+5MT5yBsH9g=" crossorigin="anonymous"></script>
    <script>
        String.prototype.stripSlashes = function(){
            return this.replace(/\\(.)/mg, "$1");
        }
        function nl2br (str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
        $(document).on("click", ".popover .close" , function(){
            $(this).parents(".popover").popover('hide');
        });
        document.addEventListener('reloadModalJS', function() {
            $(".flatpickr").flatpickr({
                dateFormat: 'm/d/Y'
            });
        });
        document.addEventListener('livewire:load', function() {
            $(document).ready(function(){
                $(".flatpickr").flatpickr({
                    dateFormat: 'm/d/Y'
                });
            });
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var containerEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            // initialize the external events
            // -----------------------------------------------------------------
            new Draggable(containerEl, {
                itemSelector: 'li',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText
                    };
                }
            });
            // initialize the calendar
            // -----------------------------------------------------------------
            var calendar = new Calendar(calendarEl, {
                locale: '{{ config('app.locale') }}',
                editable: true,
                eventDurationEditable: false, // cant resize events to multiple days
                droppable: true, // this allows things to be dropped onto the calendar
                eventAdd: info => @this.eventReceive(info.event),
                eventReceive: info => @this.eventReceive(info.event),
                eventRemove: info => @this.eventRemove(info.event),
                drop: function(info) {
                    // if (shouldRemove) {
                        // if so, remove the element from the "Draggable Events" list
                        // info.draggedEl.parentNode.removeChild(info.draggedEl);
                    // }
                },
                eventDrop: function(info){
                    if (confirm("Are you sure about this change?")) {
                        // reschedule event
                        @this.eventDrop(info.event, info.oldEvent)
                    } else {
                        info.revert();
                    }
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    if (info.event.url) {
                        window.open(info.event.url);
                    }
                    $('.popover .close').trigger('click');
                    @this.setEvent(info.event);
                    $(info.jsEvent.target).popover({
                        html: true,
                        sanitize: false,
                        title: info.event.title + '<a href="#" class="close" data-dismiss="alert">&times;</a>',
                        content: nl2br(info.event.extendedProps.content.stripSlashes()),
                        // placement: 'top',
                        container: '#calendar'
                    }).popover('show');
                    return false;
                },
                loading: function(isLoading) {
                    if (!isLoading) {
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    @this.set('startDate', fetchInfo.start);
                    @this.set('endDate', fetchInfo.end);
                    @this.getEvents().then(results => {
                        successCallback(results);
                    });
                },
            });
            calendar.render();
            @this.on('refreshCalendar', function(){
                calendar.refetchEvents()
            });
            @this.on('closeModal', function(){
                $('.modal').modal('hide');
            });
            $("body").on("keyup", '#quick_notes', _.debounce(function(){
                @this.saveNotes($(this).val());
                calendar.refetchEvents();
            }, 500));
            $('#saveEvent').click(function(){
                calendar.addEvent({
                    title: $('#label').val(),
                    allDay: true,
                    start: $('#start_date').val(),
                    end: $('#end_date') ? $('#end_date').val() : $('#start_date').val(),
                    extendedProps: {
                        content: $('#notes').val(),
                        meta: {
                            time: $('#time').val(),
                            intensity: $('#intensity').val(),
                            notes: $('#notes').val(),
                        }
                    }
                });
            });
            $('body').on('click', '.delete_event', function(){
                var c = confirm('Are you sure you want to delete this?');
                if(c === true) {
                    var id = $(this).attr('data-id');
                    var event = calendar.getEventById(id);
                    event.remove(id);
                    $('.popover .close').trigger('click');
                }
            });
        });
    </script>
    @endpush
</div>