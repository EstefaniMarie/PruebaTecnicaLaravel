Instrucciones para la instalacion del sistema

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


