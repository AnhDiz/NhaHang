<?php

use App\Database\Migrations\Group;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dang_nhap', 'account\AccountController::index');
$routes->get('/dang_ky','account\AccountController::regist');
$routes->post('/registed','account\AccountController::create');
$routes->post('/login/authenticate', 'account\AccountController::login');
$routes->get('/logout', 'account\AccountController::logout');
$routes->get('error','Home::error');

$routes->group('main',function($routes):void{
    $routes->group('booking',function($routes):void{
        $routes->get('','main\BookController::index');
        $routes->post('getbyfloor','main\BookController::getbyfloor');
    });
    $routes->get('contact','home::contact');
    $routes->get('menu','home::menu');
    $routes->get('service','home::service');
    $routes->get('team','home::team');
    $routes->get('testmonial','home::testmonial');
});

$routes->group('notification',function($routes):void{
    $routes->post('create', 'Notification\NotificationController::create');
    $routes->get('unread/(:num)', 'Notification\NotificationController::fetchUnread/$1');
    $routes->post('mark-as-read/(:num)', 'Notification\NotificationController::markAsRead/$1');
});

$routes->group('dashboard',['filter'=>'permissionFilter'],function($routes){
    $routes->get('','dashboard\AdminController::index');

    $routes->group('user',function($routes){
        $routes->get('','dashboard\User\UserDataController::index');
        $routes->get('add','dashboard\User\UserDataController::Add');
        $routes->post('create','dashboard\User\UserDataController::create');
        $routes->get('edit/(:num)','dashboard\User\UserDataController::edit/$1');
        $routes->post('update','dashboard\User\UserDataController::update');
        $routes->post('updateI','dashboard\User\UserDataController::updateGroupid');
        $routes->get('delete/(:num)','dashboard\User\UserDataController::delete/$1');
    });
    $routes->group('group',function($routes){
        $routes->get('','dashboard\Group\GroupController::index');
        $routes->get('add','dashboard\Group\GroupController::add');
        $routes->post('create','dashboard\Group\GroupController::create');
        $routes->get('edit/(:num)', 'dashboard\Group\GroupController::edit/$1');
        $routes->post('update','dashboard\Group\GroupController::update');
        $routes->get('delete/(:num)', 'dashboard\Group\GroupController::delete/$1');
    });
    $routes->group('role',function($routes){
        $routes->get('','dashboard\Role\RoleController::index');
        $routes->get('add','dashboard\Role\RoleController::add');
        $routes->post('create','dashboard\Role\RoleController::create');
        $routes->get('edit/(:num)', 'dashboard\Role\RoleController::edit/$1');
        $routes->post('update','dashboard\Role\RoleController::update');
        $routes->get('delete/(:num)', 'dashboard\Role\RoleController::delete/$1');
    });
    $routes->group('permission',function($routes){
        $routes->get('','dashboard\Permission\PermissionController::index');
    });
    $routes->group('material',function($routes): void{
        $routes->get('','dashboard\Material\MaterialController::index');
        $routes->get('add','dashboard\Material\MaterialController::add');
        $routes->post('create','dashboard\Material\MaterialController::create');
        $routes->post('updateI','dashboard\Material\MaterialController::updateid');
        $routes->get('extract','dashboard\Material\MaterialController::extract');
        $routes->post('getbytype','dashboard\Material\MaterialController::getbytype');
        $routes->post('extract','dashboard\Material\MaterialController::extractM');
    });
    $routes->group('materialtype',function($routes): void{
        $routes->get('','dashboard\Material\MaterialTypeController::index');
        $routes->get('add','dashboard\Material\MaterialTypeController::add');
        $routes->post('create','dashboard\Material\MaterialTypeController::create');
    });
    $routes->group('materialunit',function($routes): void{
        $routes->get('','dashboard\Material\MaterialUnitController::index');
        $routes->get('add','dashboard\Material\MaterialUnitController::add');
        $routes->post('create','dashboard\Material\MaterialUnitController::create');
    });
    $routes->group('dish',function($routes): void{
        $routes->get('','dashboard\Dish\DishController::index');
        $routes->get('add','dashboard\Dish\DishController::add');
        $routes->post('create','dashboard\Dish\DishController::create');
        $routes->get('edit/(:num)','dashboard\Dish\DishController::edit/$1');
        $routes->post('update/(:num)','dashboard\Dish\DishController::update/$1');
        $routes->get('delete/(:num)','dashboard\Dish\DishController::delete/$1');
    });
    $routes->group('dishtype',function($routes): void{
        $routes->get('','dashboard\Dish\DishTypeController::index');
        $routes->get('add','dashboard\Dish\DishTypeController::add');
        $routes->post('create','dashboard\Dish\DishTypeController::create');
        $routes->get('edit/(:num)', 'dashboard\Dish\DishTypeController::edit/$1');
        $routes->post('update','dashboard\Dish\DishTypeController::update');
        $routes->get('delete/(:num)', 'dashboard\Dish\DishTypeController::delete/$1');
    });
    $routes->group('table',function($routes){
        $routes->get('','dashboard\Table\TableController::index');
        $routes->get('add','dashboard\Table\TableController::add');
        $routes->post('create','dashboard\Table\TableController::create');
        $routes->get('edit/(:num)', 'dashboard\Table\TableController::edit/$1');
        $routes->post('update','dashboard\Table\TableController::update');
        $routes->post('updateI','dashboard\Table\TableController::updateid');
        $routes->get('delete/(:num)', 'dashboard\Table\TableController::delete/$1');
        $routes->post('getbyfloor','dashboard\Table\TableController::getbyfloor');
    });
    $routes->group('booking',function($routes){
        $routes->get('','dashboard\Table\BookingController::index');
        $routes->get('add','dashboard\Table\BookingController::add');
        $routes->post('create','dashboard\Table\BookingController::create');
        $routes->get('edit/(:num)', 'dashboard\Table\BookingController::edit/$1');
        $routes->post('update','dashboard\Table\BookingController::update');
        $routes->post('updateI','dashboard\Table\BookingController::updateid');
        $routes->get('delete/(:num)', 'dashboard\Table\BookingController::delete/$1');
    });
});

