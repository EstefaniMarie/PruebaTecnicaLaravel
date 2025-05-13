<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {

        return view('tareas');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|string',
            'status' => 'required|in:pendiente,en progreso,completada',
            'priority' => 'required|in:baja,media,alta',
            'user_id' => 'required|exists:users,id',
        ]);
        try {
            Task::create($validatedData);
            return redirect()->route('tareas')->with('success', 'Tarea creada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error']);
        }
    }

    public function edit($id)
    {
        $tarea = Task::findOrFail($id);
        return view('tarea.editar', compact('tarea'));
    }
    public function update(Request $request, $id)
    {
        $tarea = Task::findOrFail($id);
        $tarea->update($request->all());
        return redirect()->route('tareas')->with('success', 'Tarea actualizado exitosamente');
    }

    public function destroy($id)
    {
        $tarea = Task::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas')->with('success', 'Tarea eliminada correctamente.');
    }

}