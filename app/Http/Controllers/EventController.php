<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', Event::Active)->orderBy('id', 'DESC')->get();
        foreach($events as $event)
        {
            $formName = Form::find($event->form_id);
            $userName = User::find($event->user_id);
            $event->form_name = $formName->name;
            $event->user_name = $userName->name;
        }
        return response()->json([
            'code' => 200,
            'data' => $events
        ], 200);
    }

    public function store(Request $request)
    {
        //
    }
    
    public function show(Event $event)
    {
        //
    }
    
    public function update(Request $request, Event $event)
    {
        //
    }
    
    public function destroy(Event $event)
    {
        //
    }
}
