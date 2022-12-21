<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ComponentCalendar extends Component
{
    public function render()
    {
        $calendar = null;
        return view('livewire.component-calendar', compact('calendar'));
    }
}
