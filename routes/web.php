<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\supplier\SupplierController;
use App\Http\Controllers\reseller\ResellerController;
use App\Http\Controllers\warehouse\WarehouseController;
use App\Http\Controllers\store\StoreController;
use App\Http\Controllers\brand\BrandController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\product\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard/dashboards');
// });

Route::get('/', function () {

    return view('login');
});
Auth::routes();

// Route::get('/', [DashboardController::class, 'dashboard']);

Route::get('dashboard/dashboards', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard/dashboards')->middleware('auth');

route::get('/employee/employees', [EmployeeController::class, 'employees'])->middleware('auth');
route::any('/employee/employees/store', [EmployeeController::class, 'store'])->middleware('auth');
route::any('/employees/editact/{id}', [EmployeeController::class, 'editact'])->middleware('auth');
route::any('/register', [RegisterController::class, 'register'])->middleware('auth');
route::any('/employees/destroy/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
route::any('/employees/destroy_employee/{id}', [EmployeeController::class, 'destroy_employee'])->middleware('auth');
route::get('/layouts/main', [EmployeeController::class, 'main'])->middleware('auth');
route::any('/employee/employees/cari', [EmployeeController::class, 'cari'])->middleware('auth');

route::get('/supplier/suppliers', [SupplierController::class, 'supplier'])->middleware('auth');
route::get('/tablesupplier', [SupplierController::class, 'tablesupplier'])->middleware('auth');
route::any('/supplier/editact/{id}', [SupplierController::class, 'editact'])->middleware('auth');
route::any('/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->middleware('auth');
route::any('/supplier/suppliers/store', [SupplierController::class, 'store'])->middleware('auth');

route::get('/reseller/resellers', [ResellerController::class, 'reseller'])->middleware('auth');
route::any('/tablereseller', [ResellerController::class, 'tablereseller'])->middleware('auth');
route::any('/reseller/resellers/store', [ResellerController::class, 'store'])->middleware('auth');
route::any('/resellers/editact/{id}', [ResellerController::class, 'editact'])->middleware('auth');

route::get('/warehouse/warehouses', [WarehouseController::class, 'warehouse'])->middleware('auth');
route::any('/tablewarehouse', [WarehouseController::class, 'tablewarehouse'])->middleware('auth');
route::any('/warehouse/warehouses/store', [WarehouseController::class, 'store'])->middleware('auth');
route::any('/warehouse/editact/{id}', [WarehouseController::class, 'editact'])->middleware('auth');
route::any('/warehouse/destroy/{id}', [WarehouseController::class, 'destroy'])->middleware('auth');

route::get('/store/stores', [StoreController::class, 'store'])->middleware('auth');
route::any('/store/stores/storeadd', [StoreController::class, 'storeadd'])->middleware('auth');
route::any('/tablestore', [StoreController::class, 'tablestore'])->middleware('auth');
route::any('/store/editact/{id}', [StoreController::class, 'editact'])->middleware('auth');
route::any('/store/destroy/{id}', [StoreController::class, 'destroy'])->middleware('auth');

route::get('/brand/brands', [BrandController::class, 'brand'])->middleware('auth');
route::any('/tablebrand', [BrandController::class, 'tablebrand'])->middleware('auth');
route::any('/brand/brands/store', [BrandController::class, 'store'])->middleware('auth');
route::any('/brand/editact/{id}', [BrandController::class, 'editact'])->middleware('auth');
route::any('/brand/destroy/{id}', [BrandController::class, 'destroy'])->middleware('auth');

route::get('/category/categories', [CategoryController::class, 'category'])->middleware('auth');
route::any('/tablecategory', [CategoryController::class, 'tablecategory'])->middleware('auth');
route::any('/tablesubcategory', [CategoryController::class, 'tablesubcategory'])->middleware('auth');
route::any('/category/categories/store', [CategoryController::class, 'store'])->middleware('auth');
route::any('/category/categories/storeadd', [CategoryController::class, 'storeadd'])->middleware('auth');
route::any('/category/editact/{id}', [CategoryController::class, 'editact'])->middleware('auth');
route::any('/category/editactsub/{id}', [CategoryController::class, 'editactsub'])->middleware('auth');
route::any('/category/destroy/{id}', [CategoryController::class, 'destroy'])->middleware('auth');
route::any('/category/destroysub/{id}', [CategoryController::class, 'destroysub'])->middleware('auth');

route::get('/product/products', [ProductController::class, 'product'])->middleware('auth');
route::get('/product/products_test', [ProductController::class, 'product_test'])->middleware('auth');
route::any('/tableproduct', [ProductController::class, 'tableproduct'])->middleware('auth');
Route::any('/load_variation', [ProductController::class, 'load_variation']);
