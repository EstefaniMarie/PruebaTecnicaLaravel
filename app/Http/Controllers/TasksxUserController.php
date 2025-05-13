<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TasksxUserController extends Controller
{
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
            return redirect()->route('taskxUser')->with('success', 'Tarea creada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error']);
        }
    }

    public function mostrarTareas()
    {
        $usuario = auth()->user(); 
        $tareas = Task::where('user_id', $usuario->id)
            ->orderBy('due_date', 'desc')
            ->get();
        return view('tareasxUser', compact('tareas'));

    }
}