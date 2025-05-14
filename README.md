![image](https://github.com/user-attachments/assets/2bf3f5c3-30f7-4e1e-8663-f417471b38e8)Instrucciones para la instalacion del sistema

1.	Si esta instalado, debemos escribir composer update.
2.	Instalar composer para poder crear un proyecto Laravel.
3.	Armamos la base de datos, modelos y controladores con -> php artisan make:model NombreDeLaTabla—resource
4.	Migramos la base de datos con los seeders (datos de prueba) a traves de -> php artisan migrate –seed
5.	Una vez hecho esto, tendremos acceso al usuario admin con su contraseña que se ve en UsersSeeder en la carpeta database
6.	El otro rol se llama "usuario", este usuario solo tiene acceso a sus propias tareas y no a todas en general. El usuario root tiene acceso a las interfaces de "Tareas" y "Usuarios".
7.	Se procede a crear todas las vistas entre el controlador, rutas web.php y vistas en la carpeta resources.
8.	Luego viene crear las API de Tareas y Usuarios y se comprobamos que funciona con Postman.
9.	Y para documentar las API se utilizó Swagger. Primero corremos -> composer require darkaonline/l5-swagger. Luego -> php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
10. Para verificar las API de tareas -> http://127.0.0.1:8000/api/tareas y de usuarios -> http://127.0.0.1:8000/api/users
11. Para comprobar la documentacion de las API a traves de Swagger UI utilizamos este link -> http://127.0.0.1:8000/api/documentation
12. Despues comprobamos que el servidor o API está corriendo correctamente con -> http://127.0.0.1:8000/api/test
13. Por ultimo en App/Providers/RouteServiceProvider
    RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });
    Aqui limitamos el numero de solicitudes por minuto, que en este caso son dos horas. De igual forma se puede comprobar con Postman



Los usuarios por defecto son
[
                'name' => 'admin',
                'correo' => 'admin@example.com',
                'password' => 12345678,
                'roles_id' => 1
            ],
            [
                'name' => 'usuario',
                'correo' => 'user@example.com',
                'password' => 12345678,
                'roles_id' => 2
            ]

            ES MUY IMPORTANTE CORRER
php artisan migrate --seed y luego php artisan serve


IMAGENES QUE COMPRUEBAN QUE LAS API FUNCIONAN

![image](https://github.com/user-attachments/assets/79acc03c-1544-4f8e-98e5-8042588893fc)

![image](https://github.com/user-attachments/assets/49174f99-06f4-4742-8efb-f96822686134)

![image](https://github.com/user-attachments/assets/d971e971-8be3-4ffe-b990-d17125058af6)

![image](https://github.com/user-attachments/assets/18b61b56-15e4-4977-b5ea-cc9c3b2f631b)

![image](https://github.com/user-attachments/assets/21bbde76-4f96-4357-acc6-cff9198b1838)

![image](https://github.com/user-attachments/assets/58112f2f-5d5c-4892-a168-f7c8b8da9a40)

![image](https://github.com/user-attachments/assets/4b1fc207-c053-4187-bc75-22a57e4b294b)













RESPUESTAS PREGUNTAS TECNICAS

1. Patrón Observer

2. 

a.	

MODELO USER.PHP
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}

MODELO TASK.PHP
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

b. $user = User::find($userId);
$highPriorityTasks = $user->tasks()->where('priority', 'alta')->get();

c.	use Illuminate\Support\Facades\DB;

$topUser = User::withCount([
 'tasks as completed_tasks_count' => function ($query) {
$query->where('completed', true);
 }
])->orderByDesc('completed_tasks_count')->first();


3. 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class CheckTaskEditPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true); 

        // a) Verificar permiso de edición
        $taskId = $request->route('task'); 
        $task = Task::find($taskId);

        if (!$task) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }

        $user = $request->user();

        // Ejemplo: sólo el propietario puede editar
        if ($task->user_id !== $user->id) {
            return response()->json(['error' => 'No tienes permiso para editar esta tarea'], 403);
        }

        // Continuar con la petición
        $response = $next($request);

        // b) Calcular y registrar tiempo de ejecución
        $end = microtime(true);
        $duration = $end - $start;

        Log::info("Tiempo de ejecución para {$request->method()} {$request->path()}: {$duration} segundos");

        return $response;
    }
}

4.

a.	

public function test_user_cannot_edit_others_tasks()
{
    $owner = new User(1, 'Propietario');
    $otherUser = new User(2, 'Intruso');

    $task = new Task(100, 'Tarea original', $owner->getId(), 'pendiente');

    $controller = new TaskController();

    $this->expectException(PermissionDeniedException::class);

    $controller->editTask($task, [
        'title' => 'Tarea modificada'
    ], $otherUser);
}

b.	

public function test_task_validation_fails_with_invalid_data()
{
    $user = new User(1, 'Validador');
    $controller = new TaskController();

    $invalidData = [
        'title' => '', // vacío
        'priority' => 'urgente' // no válido
    ];

    $this->expectException(ValidationException::class);

    $controller->createTask($invalidData, $user);
}











