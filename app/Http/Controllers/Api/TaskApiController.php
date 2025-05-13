<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\Response;

/**
 * 
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */
class TaskApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tareas",
     *     summary="Mostrar tareas",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos las tareas."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|string',
            'status' => 'required|in:pendiente,en progreso,completada',
            'priority' => 'required|in:baja,media,alta',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            // Crear la tarea en la base de datos
            $task = Task::create($validatedData);

            // Responder con el estado y la tarea creada
            return response()->json([
                'message' => 'Tarea creada exitosamente',
                'task' => $task
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hubo un error al crear la tarea',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Encontrar la tarea o lanzar error
            $tarea = Task::findOrFail($id);

            // Actualizar los campos de la tarea
            $tarea->update($request->all());

            return response()->json([
                'message' => 'Tarea actualizada exitosamente',
                'task' => $tarea
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Tarea no encontrada o error al actualizar',
                'details' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        try {
            // Encontrar la tarea y eliminarla
            $tarea = Task::findOrFail($id);
            $tarea->delete();

            return response()->json([
                'message' => 'Tarea eliminada correctamente.'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Tarea no encontrada o error al eliminar',
                'details' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id)
    {
        try {
            // Obtener la tarea
            $tarea = Task::findOrFail($id);

            return response()->json([
                'task' => $tarea
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Tarea no encontrada',
                'details' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }
}
