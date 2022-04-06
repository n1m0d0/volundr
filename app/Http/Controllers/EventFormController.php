<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class EventFormController extends Controller
{
    public function form(Form $form)
    {
        $form->questions = $form->questions;
        foreach ($form->questions as $question) {
            $question->options = $question->options;
        }

        return response()->json([
            'code' => 200,
            'data' => $form
        ], 200);
    }
}
