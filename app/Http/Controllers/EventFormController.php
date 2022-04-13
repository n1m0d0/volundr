<?php

namespace App\Http\Controllers;

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
        dd($request);
    }
}
