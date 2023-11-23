<?php 
  include __DIR__ . "/../includes/app.php";

  use MVC\Router;
  use Controller\AdminController;
  use Controller\APIController;
use Controller\ConfigController;
use Controller\EstacionamientoController;
  use Controller\EventosController;
  use Controller\LoginController;
  use Controller\OrganizadorController;
  use Controller\PaginasController;
  use Controller\UsuarioController;

  /** ROUTING DE LA APLICACIÓN */
  $router = new Router();

  // Zona pública
  $router->get("/", [PaginasController::class, "index"]);
  $router->get("/error", [PaginasController::class, "error"]);
  $router->get("/nosotros", [PaginasController::class, "nosotros"]);
  $router->get("/servicios", [PaginasController::class, "servicios"]);
  $router->get("/eventos", [PaginasController::class, "eventos"]);
  $router->get("/evento", [PaginasController::class, "evento"]);
  $router->get("/ubicacion", [PaginasController::class, "ubicacion"]);
  $router->get("/contacto", [PaginasController::class, "contacto"]);
  
  // Login
  $router->get("/iniciar-sesion", [LoginController::class, "login"]);
  $router->post("/iniciar-sesion", [LoginController::class, "login"]);
  $router->get("/crear-cuenta", [LoginController::class, "singin"]);
  $router->post("/crear-cuenta", [LoginController::class, "singin"]);
  $router->get("/mensaje", [LoginController::class, "mensaje"]);
  $router->get("/confirmar-cuenta", [LoginController::class, "confirmar"]);
  $router->get("/recuperar-password", [LoginController::class, "olvide"]);
  $router->post("/recuperar-password", [LoginController::class, "olvide"]);
  $router->get("/envio-email", [LoginController::class, "envio"]);
  $router->get("/reestablecer-password", [LoginController::class, "reestablecer"]);
  $router->post("/reestablecer-password", [LoginController::class, "reestablecer"]);

  // Zona privada
  $router->get("/admin", [AdminController::class, "index"]);
  $router->get("/admin/eventos", [AdminController::class, "eventos"]);
  $router->get("/admin/usuarios", [AdminController::class, "usuarios"]);
  $router->get("/admin/organizadores", [AdminController::class, "organizadores"]);
  $router->get("/admin/estacionamiento", [AdminController::class, "estacionamiento"]);
  $router->get("/admin/config", [AdminController::class, "config"]);
  $router->post("/admin/config", [AdminController::class, "config"]);
  $router->post("/admin/logout", [AdminController::class, "logout"]);
  $router->post("/admin/config", [ConfigController::class, "actualizar"]);

  // Zona privada(Eventos)
  $router->get("/eventos/evento", [EventosController::class, "evento"]);
  $router->get("/eventos/crear", [EventosController::class, "crear"]);
  $router->post("/eventos/crear", [EventosController::class, "crear"]);
  $router->get("/eventos/actualizar", [EventosController::class, "actualizar"]);
  $router->get("/eventos/eliminar", [EventosController::class, "eliminar"]);
  $router->post("/eventos/actualizar", [EventosController::class, "actualizar"]);

  // Zona privada (Organizadores)
  $router->get("/organizadores/crear", [OrganizadorController::class, "crear"]);
  $router->post("/organizadores/crear", [OrganizadorController::class, "crear"]);
  $router->get("/organizadores/actualizar", [OrganizadorController::class, "actualizar"]);
  $router->post("/organizadores/actualizar", [OrganizadorController::class, "actualizar"]);
  $router->get("/organizadores/eliminar", [OrganizadorController::class, "eliminar"]);
  
  // Zona pribvada (admin-usuarios)
  $router->get("/usuarios/contactar", [AdminController::class, "contactar"]);
  $router->get("/usuarios/eliminar", [AdminController::class, "eliminarUsuario"]);

  // Zona privada (Usuarios)
  $router->get("/home", [UsuarioController::class, "index"]);
  $router->get("/home/eventos", [UsuarioController::class, "eventos"]);
  $router->get("/home/evento", [UsuarioController::class, "evento"]);
  $router->get("/home/mis-eventos", [UsuarioController::class, "misEv"]);
  $router->get("/home/configuracion", [UsuarioController::class, "config"]);

  // Zona privada (Estacionamiento)
  $router->get("/estacionamiento/espacio", [EstacionamientoController::class, "espacio"]);
  
  // APIS
  $router->get("/api/espacios", [APIController::class, "index"]);
  $router->get("/api/eventos", [APIController::class, "eventos"]);
  $router->get("/api/login", [APIController::class, "login"]);
  
  $router->comprobarRutas();
?>