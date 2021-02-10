<?php

namespace App\Http\Controllers;

use App\Todos;
use App\Http\Controllers\Api;
use Illuminate\Http\Request;

class TodosApi extends Api
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function list() {
        $todos  = Todos::all();
        return response()->json($todos);
    }
    
    public function saveTodo(Request $request) {
        $texte = $request->input('texte');
    
        if($texte){
          $todo = new Todos();
          $todo->texte = $texte;
          $todo->termine = 0;
          $todo->save();
          return response()->json("success");
        }
        else {
          return response()->json("error");
        }
    }
    
    public function deleteTodo($id) {
        $todo  = Todos::find($id);
        if($todo && $todo->termine) {
            $todo->delete();
            return response()->json('success');
        }
        else {
            return response()->json('error');
        }
    }

    public function markAsDone($id) {
        $todo  = Todos::find($id);
        if($todo) {
            $todo->termine = 1;
            $todo->save();
            return response()->json("success");
        }
        else {
            return response()->json("error");
        }
    }

}
