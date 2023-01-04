<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ComponentCalendar extends Component
{
    public function render()
    {
        $calendar = [];
        
        $events = Event::where('form_id', 2)->get();

        foreach ($events as $event) {
            $answers = $event->answers;
            $title = "";
            $start = "";
            $end = "";
            $date = "";
            foreach ($answers as $answer) {
                if ($answer->question_id == 6) {
                    $title = $answer->input_data;
                }
                if ($answer->question_id == 7) {
                    $date = $answer->input_data;
                }
                if ($answer->question_id == 8) {
                    $start = $answer->input_data;
                }
                if ($answer->question_id == 9) {
                    $end = $answer->input_data;
                }
            }

            $calendar[] = [
                'title' => $title,
                'start' => Carbon::createFromFormat('Y-m-d', $date)->toDateTimeString(),
                'color' => "purple"
            ];
        }

        $calendar =  json_encode($calendar);

        return view('livewire.component-calendar', compact('calendar'));
    }
}
