<?php

/*
    ● AGREGAR EL GRUPO /CREDENCIALES CON LOS VERBOS GET Y POST (MOSTRAR QUE VERBO ES).

    ● AL GRUPO, AGREGARLE UN MW QUE, DE ACUERDO EL VERBO, VERIFIQUE CREDENCIALES O NO.

    ● GET -> NO VERIFICA. ACCEDE AL VERBO.

    ● POST-> VERIFICA; SE ENVIA: NOMBRE Y PERFIL.
    *- SI EL PERFIL ES 'ADMINISTRADOR', MUESTRA EL NOMBRE Y ACCEDE AL VERBO.
    *- SI NO, MUESTRA MENSAJE DE ERROR. NO ACCEDE AL VERBO.
*/

// Establecer el nivel de error a -1 para mostrar todos los errores
error_reporting(-1);
// Habilitar la visualización de errores en pantalla
ini_set('display_errors', 1);

// Importar la interfaz ResponseInterface del estándar PSR-7 y asignarla como Response
use Psr\Http\Message\ResponseInterface as Response;
// Importar la interfaz ServerRequestInterface del estándar PSR-7 y asignarla como Request
use Psr\Http\Message\ServerRequestInterface as Request;
// Importar la interfaz RequestHandlerInterface del estándar PSR-15 y asignarla como RequestHandler
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
// Importar la clase Response de Slim PSR-7 y asignarla como ResponseMW para diferenciarla de la interfaz Response
use Slim\Psr7\Response as ResponseMW;
// Importar la clase AppFactory de Slim Factory
use Slim\Factory\AppFactory;
// Importar la clase RouteCollectorProxy de Slim Routing
use Slim\Routing\RouteCollectorProxy;

// Requerir el archivo autoload.php para cargar las dependencias
require __DIR__ . '/../../SlimFiles/vendor/autoload.php';

// Crear una instancia de la aplicación Slim
$app = AppFactory::create();

// Establecer la ruta base (solo es necesario si lo levanto por xampp)
// $app->setBasePath('C:/xampp/htdocs/Programacion-III/clase10');

// Agregar el middleware de manejo de errores
$app->addErrorMiddleware(true, true, true);

// Agregar el middleware de análisis del cuerpo de la solicitud
$app->addBodyParsingMiddleware();

// Definir las rutas dentro del grupo '/credenciales'
$app->group('/credenciales', function (RouteCollectorProxy $group) {
    // Ruta para el verbo GET
    $group->get('', function (Request $request, Response $response) {
        // Manejador para el verbo GET
        $payload = ['mensaje' => 'Verbo Get'];
        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Ruta para el verbo POST
    $group->post('', function (Request $request, Response $response) {
        // Manejador para el verbo POST
        $payload = ['mensaje' => 'Verbo Post'];
        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    });
});

// Ejecutar la aplicación Slim
$app->run();

// composer update
// php -S localhost:666