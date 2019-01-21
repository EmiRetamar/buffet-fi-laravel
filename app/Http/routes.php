<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Frontend

Route::get('/', [
	'as' => 'frontend',
	'uses' => 'Home_Controller@frontend'
]);

// Authentication routes...

Route::get('login', [
	'as' => 'login',
	'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('login', [
	'as' => 'login',
	'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'Auth\AuthController@getLogout'
]);

Route::get('register', [
	'as' => 'register',
	'uses' => 'Auth\AuthController@getRegister'
]);

Route::post('register', [
	'as' => 'register',
	'uses' => 'Auth\AuthController@postRegister'
]);

// Backend

Route::get('backend', [
	'as' => 'backend',
	'middleware' => 'auth',
	'uses' => 'Home_Controller@backend'
]);

Route::get('configuracion', [
	'as' => 'configuracion',
	'middleware' => 'auth',
	'uses' => 'Configuracion_Controller@index'
]);

Route::post('configuracion/{id}', [
	'as' => 'configuracion.update',
	'middleware' => 'auth',
	'uses' => 'Configuracion_Controller@update'
]);

Route::get('productos', [
	'as' => 'productos',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@index'
]);

Route::get('productos/vista-crear', [
	'as' => 'productos.vista-crear',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@create'
]);

Route::post('productos/crear', [
	'as' => 'productos.crear',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@store'
]);

Route::get('productos/vista-modificar/{id}', [
	'as' => 'productos.vista-modificar',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@edit'
]);

Route::post('productos/modificar/{id}', [
	'as' => 'productos.modificar',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@update'
]);

Route::get('productos/vista-eliminar/{id}', [
	'as' => 'productos.vista-eliminar',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@viewDestroy'
]);

Route::post('productos/eliminar/{id}', [
	'as' => 'productos.eliminar',
	'middleware' => 'auth',
	'uses' => 'Producto_Controller@destroy'
]);

Route::get('compras', [
	'as' => 'compras',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@index'
]);

Route::get('compras/vista-crear', [
	'as' => 'compras.vista-crear',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@create'
]);

Route::post('compras/agregar-producto', [
	'as' => 'compras.agregar-producto',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@agregarProductoACompra'
]);

Route::get('compras/quitar-producto/{id}', [
	'as' => 'compras.quitar-producto',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@quitarProductoDeCompra'
]);

Route::post('compras/crear', [
	'as' => 'compras.crear',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@store'
]);

Route::get('compras/cancelar', [
	'as' => 'compras.cancelar',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@cancelar'
]);

Route::get('compras/vista-detalle/{id}', [
	'as' => 'compras.vista-detalle',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@show'
]);

Route::get('compras/vista-modificar/{id}', [
	'as' => 'compras.vista-modificar',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@edit'
]);

Route::post('compras/modificar/{id}', [
	'as' => 'compras.modificar',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@update'
]);

Route::get('compras/vista-eliminar/{id}', [
	'as' => 'compras.vista-eliminar',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@viewDestroy'
]);

Route::post('compras/eliminar/{id}', [
	'as' => 'compras.eliminar',
	'middleware' => 'auth',
	'uses' => 'Compra_Controller@destroy'
]);

Route::get('ventas', [
	'as' => 'ventas',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@index'
]);

Route::get('ventas/vista-crear', [
	'as' => 'ventas.vista-crear',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@create'
]);

Route::post('ventas/agregar-producto', [
	'as' => 'ventas.agregar-producto',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@agregarProductoAVenta'
]);

Route::get('ventas/quitar-producto/{id}', [
	'as' => 'ventas.quitar-producto',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@quitarProductoDeVenta'
]);

Route::post('ventas/crear', [
	'as' => 'ventas.crear',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@store'
]);

Route::get('ventas/cancelar', [
	'as' => 'ventas.cancelar',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@cancelar'
]);

Route::get('ventas/vista-detalle/{id}', [
	'as' => 'ventas.vista-detalle',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@show'
]);

Route::get('ventas/vista-modificar/{id}', [
	'as' => 'ventas.vista-modificar',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@edit'
]);

Route::post('ventas/modificar/{id}', [
	'as' => 'ventas.modificar',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@update'
]);

Route::get('ventas/vista-eliminar/{id}', [
	'as' => 'ventas.vista-eliminar',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@viewDestroy'
]);

Route::post('ventas/eliminar/{id}', [
	'as' => 'ventas.eliminar',
	'middleware' => 'auth',
	'uses' => 'Venta_Controller@destroy'
]);

Route::get('usuarios', [
	'as' => 'usuarios',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@index'
]);

Route::get('usuarios/vista-crear', [
	'as' => 'usuarios.vista-crear',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@create'
]);

Route::post('usuarios/crear', [
	'as' => 'usuarios.crear',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@store'
]);

Route::get('usuarios/vista-modificar/{id}', [
	'as' => 'usuarios.vista-modificar',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@edit'
]);

Route::post('usuarios/modificar/{id}', [
	'as' => 'usuarios.modificar',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@update'
]);

Route::get('usuarios/vista-eliminar/{id}', [
	'as' => 'usuarios.vista-eliminar',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@viewDestroy'
]);

Route::post('usuarios/eliminar/{id}', [
	'as' => 'usuarios.eliminar',
	'middleware' => 'auth',
	'uses' => 'Usuario_Controller@destroy'
]);

Route::get('productos-faltantes', [
	'as' => 'productos-faltantes',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@productosFaltantes'
]);

Route::get('productos-stock-minimo', [
	'as' => 'productos-stock-minimo',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@productosStockMinimo'
]);

Route::get('balance-ganancias', [
	'as' => 'balance-ganancias',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@balanceGanancias'
]);

Route::post('listado-balance-ganancias', [
	'as' => 'listado-balance-ganancias',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@calcularBalanceGanancias'
]);

Route::get('balance-ventas', [
	'as' => 'balance-ventas',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@balanceVentas'
]);

Route::post('listado-balance-ventas', [
	'as' => 'listado-balance-ventas',
	'middleware' => 'auth',
	'uses' => 'Listado_Controller@calcularBalanceVentas'
]);

Route::get('menu', [
	'as' => 'menu',
	'middleware' => 'auth',
	'uses' => 'Menu_Controller@index'
]);

Route::get('menu/vista-crear/{dia}', [
	'as' => 'menu.vista-crear',
	'middleware' => 'auth',
	'uses' => 'Menu_Controller@create'
]);

Route::get('menu/route', [
	'as' => 'menu.route',
	'middleware' => 'auth',
	'uses' => 'Menu_Controller@route'
]);

?>