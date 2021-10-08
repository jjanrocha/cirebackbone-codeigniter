<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/login', 'Login::logar');
$routes->post('/logout', 'Login::logout');

/** Links da sidebar */
$routes->get('/carimbos/b2b', function () {
    return view('fallback/manutencao');
});
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'adminGuard']);
$routes->get('/carimbos/controle', 'ControleController::index', ['filter' => 'authGuard']);
$routes->get('/carimbos/gerais', function () {
    return view('fallback/manutencao');
});
$routes->get('/carimbos/vivo2', function () {
    return view('fallback/manutencao');
});
$routes->get('/usuarios', 'UsuarioController::index', ['filter' => 'adminGuard']);
$routes->get('/links', function () {
    return view('fallback/manutencao');
});
/** Fim dos links da sidebar */

/** Itens Dashboard */
$routes->post('/dashboard/geral', 'DashboardController::dadosGraficoGeral', ['filter' => 'adminGuard']);
/** Fim dos itens do Dashboard */

/** Caregar forms de carimbos */
$routes->post('/carimbos/controle/formularios/controle_crise', 'ControleController::carregarFormCrise', ['filter' => 'authGuard']);
$routes->post('/carimbos/controle/formularios/controle_urgente', 'ControleController::carregarFormUrgente', ['filter' => 'authGuard']);
$routes->post('/carimbos/controle/formularios/controle_atualizacao_telegram', 'ControleController::carregarFormAtualizacaoTelegram', ['filter' => 'authGuard']);
/** Fim do carregamento dos forms de carimbos */

/* Insert de carimbos */
$routes->post('/carimbos/controle/formularios/controle_crise/insert','ControleController::insertCarimboCrise', ['filter' => 'authGuard']);
$routes->post('/carimbos/controle/formularios/controle_urgente/insert', 'ControleController::insertCarimboUrgente', ['filter' => 'authGuard']);
$routes->post('/carimbos/controle/formularios/controle_atualizacao_telegram/insert','AtualizacaoTelegramController::store', ['filter' => 'authGuard']);
/* Fim do insert de carimbos */

/** CRUD de usuários */
$routes->post('/listarUsuarios', 'UsuarioController::listarUsuarios', ['filter' => 'adminGuard']);
$routes->get('/usuarios/create', 'UsuarioController::create', ['filter' => 'adminGuard']);
$routes->post('/usuarios/store', 'UsuarioController::store', ['filter' => 'adminGuard']);
$routes->get('/usuarios/(:num)', 'UsuarioController::show/$1', ['filter' => 'adminGuard']);
$routes->post('/listar_atividades_usuario', 'UsuarioController::listarAtividadesUsuario', ['filter' => 'adminGuard']);
$routes->get('/usuarios/edit/(:num)', 'UsuarioController::edit/$1', ['filter' => 'adminGuard']);
$routes->put('/usuarios/(:num)', 'UsuarioController::update/$1', ['filter' => 'adminGuard']);
$routes->delete('/usuarios/(:num)', 'UsuarioController::destroy/$1', ['filter' => 'adminGuard']);
/** Fim do CRUD de usuários */


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
