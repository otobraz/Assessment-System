<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Response;
use App\Models\MultipleChoiceResponse;
use App\Models\TextResponse;
use App\Models\Survey;
use App\Models\SingleChoiceResponse;

class ResponseController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create($id)
   {
      $survey = Survey::find(decrypt($id));
      $questions = $survey->questions;
      if(session()->get('role') === 'Administrador'){
         return view('response.admin.create', compact('survey', 'questions'));
      }else if(session()->get('role') === 'Aluno'){
         return view('response.student.create', compact('survey', 'questions'));
      }
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $survey = Survey::find(decrypt($request->survey_id));

      $response = new Response([
         'survey_id' => $survey->id,
         'student_id' => session()->get('id')
      ]);
      $response->save();

      $inputs = $request->all();

      foreach($survey->questions as $question){
         switch ($question->type->id) {
            case 1: # it's a text input
               $textResponse = new TextResponse([
                  'response' => $inputs["question-" . $question->id . "-text"],
                  'response_id' =>  $response->id,
                  'question_id' => $question->id
               ]);
               $textResponse->save();
               break;

            case 2: # it's a radio input
               $singleChoiceResponse = new SingleChoiceResponse([
                  'choice_id' => $inputs["question-" . $question->id . "-radio"],
                  'response_id' => $response->id,
                  'question_id' => $question->id
               ]);
               $singleChoiceResponse->save();
               break;

            case 3: # it's a checkbox input
               $multipleChoiceResponse = new MultipleChoiceResponse([
                  'response_id' => $response->id,
                  'question_id' => $question->id
               ]);
               $multipleChoiceResponse->save();
               foreach ($inputs["question-" . $question->id . "-checkbox"] as $choice) {
                  $multipleChoiceResponse->choices()->attach($choice);
               }
               break;
         }
      }

   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      //
   }
}
