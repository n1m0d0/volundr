<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Event;
use App\Models\Form;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class EventFormController extends Controller
{
    public function form(Form $form)
    {
        $questions = Question::where('form_id', $form->id)->where('status', 1)->orderBy('order', 'ASC')->get();
        $form->questions = $questions;
        foreach ($form->questions as $question) {
            $options = Option::where('question_id', $question->id)->where('status', 1)->orderBy('order', 'ASC')->get();
            $question->options = $options;
        }
        
        return response()->json([
            'code' => 200,
            'data' => $form
        ], 200);
    }

    public function save(Request $request)
    {
        $event = new Event();
        $event->parent_id = $request->parent_id;
        $event->form_id = $request->form_id;
        $event->user_id = $request->user_id;
        $event->registered = $request->registered;
        $event->save();

        $answers = $request->answers;
        $event_id = $event->id;

        foreach ($answers as $answer)
        {
            $register = new Answer();
            $register->event_id = $event_id;
            $register->question_id = $answer['question_id'];
            $register->option_id = $answer['option_id'];
            $register->input_data = $answer['input_data'];
            $register->media_file = $answer['media_file'];
            $register->save();
        }
        return response()->json([
            'code' => 200,
            'message' => "Registrado correctamente",
            'event_id' => $event_id
        ]);
    }
}
