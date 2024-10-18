<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardCalendar extends Component
{
    public $startDate;
    public $endDate;
    public $event;
    public $activeEvent;
    public $newType;

    public function mount()
    {
        $this->startDate = now()->startOfMonth();
        $this->endDate = now()->endOfMonth();
    }

    public function setEvent($event)
    {
        $our_event = Event::where('id', $event['id'])->firstOrFail();

        $this->activeEvent = $our_event;
    }

    public function eventReceive($data)
    {
        // Handle new events
        $event = Event::create([
            // 'user_id' => auth()->id(),
            'title' => $data['title'],
            // 'content' => '',
            // 'editable' => true,
            'start' => $data['start'],
            // 'created_by' => auth()->id(),
        ]);

        if (isset($data['extendedProps']['meta'])) {
            $event->meta = $data['extendedProps']['meta'];
            $event->save();
        }

        $this->clearCache();
        $this->emit('refreshCalendar');
    }

    public function eventDrop($event, $oldEvent)
    {
        // Modify existing events
        $dh_event = Event::find($event['id']);
        if ($dh_event->user_id != 1 || $dh_event->created_by != 1) {
            abort(403);
        }

        $dh_event->start = $event['start'];
        $dh_event->save();

        $this->clearCache();
        $this->emit('refreshCalendar');
    }

    public function eventRemove($event)
    {
        $id = $event['id'];
        $our_event = Event::find($id);

        if ($our_event->created_by == 1) {
            $our_event->delete();
        } else {
            abort(403);
        }

        $this->reset('activeEvent');
    }

    public function getEvents()
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;

        // $events = Cache::remember('user-events-' . auth()->id() . '-' . base64_encode($startDate.$endDate), now()->addHour(), function() use ($startDate, $endDate){
        $events = [];

        // add other events
        $global_events = Event::query()
        ->where(function ($query) {
            return $query->where('user_id', 1)->orWhereNull('user_id');
        })
        ->whereDate('start', '>=', $startDate)
        ->where(function ($query) use ($endDate) {
            return $query->whereDate('end', '<=', $endDate)->orWhereNull('end');
        })
        ->get();

        foreach ($global_events as $global_event) {
            $event = [
                // 'id' => $global_event->id,
                'title' => $global_event->title,
                'start' => $global_event->start->startOfDay()->format('Y-m-d'),
                // 'end' => $global_event->end ? $global_event->end->addDay()->startOfDay()->format('Y-m-d') : null,
                // 'allDay' => $global_event->allDay,
                // 'editable' => $global_event->editable,
                // 'deletable' => $global_event->created_by == 1,
                // 'backgroundColor' => $global_event->backgroundColor,
                // 'extendedProps' => [
                //     'type' => 'Event',
                //     'content' => $global_event->content,
                //     'notes' => $global_event->notes,
                //     'editable' => $global_event->editable,
                // ],
            ];

            $events[] = $event;
        }

        // return $events;
        // });

        return $events;
    }

    public function clearCache()
    {
        Cache::forget('user-events-' . 1 . '-' . base64_encode($this->startDate . $this->endDate));
    }

    public function newEvent($type)
    {
        $this->reset('event');
        $this->newType = $type;

        $this->dispatchBrowserEvent('reloadModalJS');
    }

    // public function save()
    // {
    //     /** @var App\Models\User */
    //     // $user = ;

    //     $title = '';

    //     if ($this->newType == 'rest') {
    //         $title = 'Rest';
    //     } elseif ($this->newType == 'ride') {
    //         $title = $this->event['riding_style'] . ' Ride';
    //     } else {
    //         $title = $this->event['title'];
    //     }

    //     // $title = Purifier::clean($title);

    //     // $user->events()->create([
    //     //     'title' => $title,
    //     //     // 'type' => $this->newType,
    //     //     // 'content' => '',
    //     //     // 'start' => Carbon::parse($this->event['start_date'])->format('Y-m-d'),
    //     //     // 'end' => ! empty($this->event['end_date']) ? Carbon::parse($this->event['end_date'])->format('Y-m-d') : null,
    //     //     // 'editable' => 1,
    //     //     // 'allDay' => 1,
    //     //     // 'meta' => [
    //     //     //     'riding_style' => Purifier::clean(@$this->event['riding_style']),
    //     //     //     'time' => Purifier::clean(@$this->event['time']),
    //     //     //     'intensity' => Purifier::clean(@$this->event['intensity']),
    //     //     //     'notes' => Purifier::clean(@$this->event['notes']),
    //     //     // ],
    //     //     // 'notes' => Purifier::clean(@$this->event['notes']),
    //     //     // 'created_by' => auth()->id(),
    //     // ]);

    //     $this->reset('event');
    //     $this->clearCache();
    //     $this->emit('refreshCalendar');
    //     $this->emitSelf('closeModal');
    // }

    public function render()
    {
        return view('livewire.calendar');
    }
}
