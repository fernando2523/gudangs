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
use App\Http\Controllers\storeequipmentcost\StoreEquipmentCostController;
use App\Http\Controllers\sale\SaleController;
use App\Http\Controllers\repeat\RepeatOrderController;
use App\Http\Controllers\purchaseOrder\PurchaseOrderController;
use App\Http\Controllers\asset\AssetController;
use App\Http\Controllers\barcode\BarcodeController;
use App\Http\Controllers\order\OrderController;
use App\Http\Controllers\orderreseller\OrderResellerController;
use App\Http\Controllers\area\AreaController;
use App\Http\Controllers\ordercancel\CancelOrderController;
use App\Http\Controllers\orderrefund\RefundOrderController;
use App\Http\Controllers\orderreturn\ReturnOrderController;
use App\Http\Controllers\reportSummary\ReportSummaryController;
use App\Http\Controllers\reportProduct\ReportProductController;
use App\Http\Controllers\reportStore\ReportStoreController;
use App\Http\Controllers\reportBrand\ReportBrandController;
use App\Http\Controllers\reportQuality\ReportQualityController;
use App\Http\Controllers\productTransfer\ProductTransferController;
use App\Http\Controllers\Auth\ChangePasswordController;
// use App\Http\Controllers\setting\SettingController;

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
route::any('/load_editstore', [EmployeeController::class, 'load_editstore']);
route::any('/load_selectrole', [EmployeeController::class, 'load_selectrole']);

route::get('/supplier/suppliers', [SupplierController::class, 'supplier'])->middleware('auth');
route::get('/tablesupplier', [SupplierController::class, 'tablesupplier'])->middleware('auth');
route::any('/supplier/editact/{id}', [SupplierController::class, 'editact'])->middleware('auth');
route::any('/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->middleware('auth');
route::any('/supplier/suppliers/store', [SupplierController::class, 'store'])->middleware('auth');

route::get('/reseller/resellers', [ResellerController::class, 'reseller'])->middleware('auth');
route::any('/tablereseller', [ResellerController::class, 'tablereseller'])->middleware('auth');
route::any('/reseller/resellers/store', [ResellerController::class, 'store'])->middleware('auth');
route::any('/resellers/editact/{id}', [ResellerController::class, 'editact'])->middleware('auth');
route::any('/resellers/destroy/{id}', [ResellerController::class, 'destroy'])->middleware('auth');

route::get('/warehouse/warehouses', [WarehouseController::class, 'warehouse'])->middleware('auth');
route::any('/tablewarehouse', [WarehouseController::class, 'tablewarehouse'])->middleware('auth');
route::any('/warehouse/warehouses/store', [WarehouseController::class, 'store'])->middleware('auth');
route::any('/warehouse/editact/{id}', [WarehouseController::class, 'editact'])->middleware('auth');
route::any('/warehouse/destroy/{id}', [WarehouseController::class, 'destroy'])->middleware('auth');
// nando 11 nov
route::any('/edit_select_ware', [WarehouseController::class, 'edit_select_ware']);
// end nando 11 nov

route::get('/store/stores', [StoreController::class, 'store'])->middleware('auth');
route::any('/store/stores/storeadd', [StoreController::class, 'storeadd'])->middleware('auth');
route::any('/tablestore', [StoreController::class, 'tablestore'])->middleware('auth');
route::any('/store/editact/{id}', [StoreController::class, 'editact'])->middleware('auth');
route::any('/store/destroy/{id}', [StoreController::class, 'destroy'])->middleware('auth');
// nando 11 nov
route::any('/edit_select_store', [StoreController::class, 'edit_select_store']);
// end nando 11 nov

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
route::any('/editselectcategory', [CategoryController::class, 'editselectcategory']);

route::get('/product/products', [ProductController::class, 'product'])->middleware('auth');
route::get('/product/products_test', [ProductController::class, 'product_test'])->middleware('auth');
route::any('/tableproduct/{id_ware}', [ProductController::class, 'tableproduct'])->middleware('auth');
Route::any('/load_variation', [ProductController::class, 'load_variation']);
route::any('/product/products/store', [ProductController::class, 'store'])->middleware('auth');
route::any('/product/editact/{id}', [ProductController::class, 'editact'])->middleware('auth');
route::any('/product/destroy/{id}', [ProductController::class, 'destroy'])->middleware('auth');
route::any('/load_edit_variation', [ProductController::class, 'load_edit_variation']);
route::any('/load_image', [ProductController::class, 'load_image']);
route::any('/detail_product', [ProductController::class, 'detail_product'])->middleware('auth');

route::get('/store_expense/store_expenses', [StoreEquipmentCostController::class, 'store_expense'])->middleware('auth');
route::any('/tableexpenses', [StoreEquipmentCostController::class, 'tableexpenses'])->middleware('auth');
route::any('/store_expense/store_expenses/store', [StoreEquipmentCostController::class, 'store'])->middleware('auth');
route::any('/expense_select_store', [StoreEquipmentCostController::class, 'expense_select_store']);
route::any('/store_expenses/editact/{id}', [StoreEquipmentCostController::class, 'editact'])->middleware('auth');
route::any('/expense_desc', [StoreEquipmentCostController::class, 'expense_desc']);
route::any('/store_expenses/destroy/{id}', [StoreEquipmentCostController::class, 'destroy'])->middleware('auth');

route::get('/repeat/repeatorders', [RepeatOrderController::class, 'repeatorders'])->middleware('auth');
route::any('/tablerepeatorder/{id_ware}', [RepeatOrderController::class, 'tablerepeatorder'])->middleware('auth');
route::any('/load_repeatorder', [RepeatOrderController::class, 'load_repeatorder']);
route::any('/table_detail_repeatorder/{id_ware}/{id_produk}', [RepeatOrderController::class, 'table_detail_repeatorder'])->middleware('auth');
route::any('/repeat/repeats/{id}', [RepeatOrderController::class, 'repeats'])->middleware('auth');
route::any('/detail_repeat_order', [RepeatOrderController::class, 'detail_repeat_order'])->middleware('auth');

route::get('/purchase/purchaseorder', [PurchaseOrderController::class, 'purchaseorder'])->middleware('auth');
route::any('/load_purchase_order', [PurchaseOrderController::class, 'load_purchase_order']);
route::any('/load_tb_po', [PurchaseOrderController::class, 'load_table_po']);
route::any('/load_details_po', [PurchaseOrderController::class, 'load_details_po']);
route::any('/load_edit_po', [PurchaseOrderController::class, 'load_edit_po']);
route::any('/purchase_variation', [PurchaseOrderController::class, 'purchase_variation']);
route::any('/deleteitem_po', [PurchaseOrderController::class, 'deleteItem']);
route::any('/deleted_po', [PurchaseOrderController::class, 'deletePo']);
route::any('/edit_po', [PurchaseOrderController::class, 'edit_po']);

route::get('/asset/assets', [AssetController::class, 'assets'])->middleware('auth');
route::any('/tableassets', [AssetController::class, 'tableassets'])->middleware('auth');
route::any('/load_detail_asset', [AssetController::class, 'load_detail_asset'])->middleware('auth');
route::any('/table_detail_asset/{id_produk}', [AssetController::class, 'table_detail_asset'])->middleware('auth');

route::get('/sale/sales', [SaleController::class, 'sale'])->middleware('auth');
route::any('/tablesale', [SaleController::class, 'tablesale']);
route::any('/load_size', [SaleController::class, 'load_size']);
route::any('/load_ware', [SaleController::class, 'load_ware']);
route::any('/getbarcodeproduct', [SaleController::class, 'getbarcodeproduct']);
route::any('/savesales', [SaleController::class, 'save_sales']);

// nando baru 9 nov
route::get('/barcode/barcodes', [BarcodeController::class, 'barcodes'])->middleware('auth');
route::any('/tablebarcode', [BarcodeController::class, 'tablebarcode'])->middleware('auth');
route::any('/barcode_detail', [BarcodeController::class, 'barcode_detail'])->middleware('auth');

route::get('/order/orders', [OrderController::class, 'orders'])->middleware('auth');
route::get('/orderreseller/orderresellers', [OrderResellerController::class, 'orderresellers'])->middleware('auth');
// nando baru 9 nov

// nando 14 nov
route::get('/area/areas', [AreaController::class, 'area'])->middleware('auth');
route::any('/tablearea', [AreaController::class, 'tablearea'])->middleware('auth');
route::any('/area/editact/{id}', [AreaController::class, 'editact'])->middleware('auth');
// end nando 14 nov
route::any('/load_tborders', [OrderController::class, 'load_tborders'])->middleware('auth');

route::any('/cancel_order', [OrderController::class, 'cancel_order'])->middleware('auth');
// tian cek
route::any('/load_refund', [OrderController::class, 'load_refund']);
route::any('/load_retur', [OrderController::class, 'load_retur']);
route::any('/cek_size_retur', [OrderController::class, 'cek_size_retur']);

// nando 17 Nov
route::get('/ordercancel/cancel', [CancelOrderController::class, 'cancel'])->middleware('auth');
route::any('/tablecancel', [CancelOrderController::class, 'tablecancel']);
route::any('/table_rincian_cancel/{id_invoice}', [CancelOrderController::class, 'table_rincian_cancel']);
route::any('/rincian_cancel', [CancelOrderController::class, 'rincian_cancel']);

route::get('/orderreturn/return', [ReturnOrderController::class, 'return'])->middleware('auth');
route::any('/tablereturn', [ReturnOrderController::class, 'tablereturn']);
route::any('/table_rincian_return/{id_invoice}', [ReturnOrderController::class, 'table_rincian_return']);
route::any('/rincian_return', [ReturnOrderController::class, 'rincian_return']);

route::get('/orderrefund/refund', [RefundOrderController::class, 'refund'])->middleware('auth');
route::any('/tablerefund', [RefundOrderController::class, 'tablerefund']);
route::any('/table_rincian_refund/{id_invoice}', [RefundOrderController::class, 'table_rincian_refund']);
route::any('/rincian_refund', [RefundOrderController::class, 'rincian_refund']);
// nando 17 Nov
// tian cek
route::any('/refund_order', [OrderController::class, 'refund_order']);
route::any('/retur_order', [OrderController::class, 'retur_order']);

route::get('/reportSummary/summary', [ReportSummaryController::class, 'summary'])->middleware('auth');
route::any('/load_tbsummary', [ReportSummaryController::class, 'load_tbsummary'])->middleware('auth');

route::get('/reportProduct/product', [ReportProductController::class, 'product'])->middleware('auth');
route::any('/tablereportproduct', [ReportProductController::class, 'tablereportproduct'])->middleware('auth');

route::get('/reportStore/store', [ReportStoreController::class, 'store'])->middleware('auth');

// tian new
route::any('/get_warehouse', [OrderController::class, 'get_warehouse']);
// tian new
route::any('/tablereportstore', [ReportStoreController::class, 'tablereportstore'])->middleware('auth');

route::get('/reportBrand/brand', [ReportBrandController::class, 'brand'])->middleware('auth');
route::any('/tablereportbrand', [ReportBrandController::class, 'tablereportbrand'])->middleware('auth');

route::get('/reportQuality/quality', [ReportQualityController::class, 'quality'])->middleware('auth');
route::any('/tablereportquality', [ReportQualityController::class, 'tablereportquality'])->middleware('auth');

route::get('/productTransfer/productTransfers', [ProductTransferController::class, 'productTransfers'])->middleware('auth');
route::any('/tableproducttransfer/{id_ware}', [ProductTransferController::class, 'tableproducttransfer'])->middleware('auth');
route::any('/load_product_transfer', [ProductTransferController::class, 'load_product_transfer'])->middleware('auth');
route::any('/productTransfer/transfer/{id_produk}', [ProductTransferController::class, 'transfer'])->middleware('auth');
route::any('/detail_product_transfer', [ProductTransferController::class, 'detail_product_transfer'])->middleware('auth');

route::any('/setting/changepassword/{id}', [ChangePasswordController::class, 'changepassword'])->middleware('auth');
route::any('/setting/editsetting/{id}', [ChangePasswordController::class, 'editsetting'])->middleware('auth');
route::get('/setting/setting', [ChangePasswordController::class, 'setting'])->middleware('auth');

route::any('/transfer', [ProductTransferController::class, 'transfer'])->middleware('auth');
