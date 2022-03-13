<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los elementos
     * store para guardar un todo
     * update para actualizar
     * destroy para eliminar
     * edit para mostrar el formulario de edicion
     */

    public function store(Request $request){

        $request -> validate(['title' => 'required|min:3']);

        $todo = new Todo;
        $todo -> title = $request -> title;
        $todo -> save(); 

        return redirect()-> route('todos') -> with('succes', 'Tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

    public function show($id){
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo -> title = $request -> title;
        $todo -> save();
        // return view('todos.index', ['succes' => 'Tarea actualizada correctamente']);
        return redirect()-> route('todos') -> with('succes', 'Tarea actualizada correctamente');
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo -> delete();
        return redirect()-> route('todos') -> with('succes', 'Tarea borrada correctamente');
    }
}
