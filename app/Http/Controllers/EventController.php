<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', Event::Active)->orderBy('id', 'DESC')->get();
        foreach ($events as $event) {
            $form = Form::find($event->form_id);
            $user = User::find($event->user_id);
            $event->form_name = $form->name;
            $event->user_name = $user->name;
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
        $form = Form::find($event->form_id);

        $event->form_name = $form->name;
        $event->form_description = $form->description;

        $event->form_parent_id = $form->forms->first()->id;

        $answers = Answer::where('event_id', $event->id)->get();

        $event->questions = $form->questions;        

        foreach ($form->questions as $question) {
            if ($question->type->id == 1) {
                $question->answer = null;
            } else {
                if ($question->type->id == 2) {
                    $question->answer = null;
                } else {
                    foreach ($answers as $answer) {
                        if ($question->id == $answer->question->id) {
                            if ($question->type->id == 3) {
                                $question->answer = $answer->input_data;
                            }
                            if ($question->type->id == 4) {
                                $question->answer = $answer->input_data;
                            }
                            if ($question->type->id == 5) {
                                $question->answer = $answer->option->name;
                            }
                            if ($question->type->id == 6) {
                                $question->answer = $answer->input_data;
                            }
                            if ($question->type->id == 7) {
                                $question->answer = $answer->input_data;
                            }
                            if ($question->type->id == 8) {
                                $question->answer = $answer->media_file;
                            }
                            if ($question->type->id == 9) {
                                $question->answer = $answer->media_file;
                            }
                        }
                    }
                }
            }
        }

        return response()->json([
            'code' => 200,
            'data' => $event
        ], 200);
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
