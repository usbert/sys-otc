<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\FieldActivityController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EquipmentPrefixController;
use App\Http\Controllers\EquipmentGroupController;
use App\Http\Controllers\EquipmentFamilyController;
use App\Http\Controllers\EquipmentModelController;
use App\Http\Controllers\ProjectLocationController;
use App\Http\Controllers\SupplyerController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PcoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\WarehouseController;
use App\Models\MeasurementUnit;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/register', function () {
    Auth::register();

});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::middleware('auth')->group(function() {

    Route::controller(PermissionController::class)->prefix('permission')->group(function() {
        Route::get('/', 'getAll')->name('permission-list');
        Route::get('/get-permission/{user_id}', 'getPermissionByUser')->name('get-permission');

    });

    Route::get('dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');


    // Route::get('user-list', [UserController::class, 'index'])
    //     ->name('user-list')
    //     ->middleware('can:is_admin');

    // Route::get('roles', [RoleAndPermissionController::class, 'indexRole'])->name('roles');


    Route::controller(UserController::class)->prefix('user')->group(function() {
        Route::get('/', 'getAll')->name('user-list');
        Route::get('/create', 'getDataToCreate')->name('create')->middleware('can:is_admin');;
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        // Route::post('/softdelete', 'delete')->name('delete');
    });

    Route::controller(ContactController::class)->prefix('contact')->group(function() {
        Route::get('/', 'getAll')->name('contact-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });


    Route::controller(TypeDocumentController::class)->prefix('type-document')->group(function() {
        Route::get('/', 'getAll')->name('type-document-list');
        Route::post('/', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/softdelete', 'delete')->name('delete');
        // Route::put('/{id}', 'update')->name('update');
    });

    // MEASUREMENT UNITS
    Route::controller(MeasurementUnit::class)->prefix('measurement-unit')->group(function() {
        Route::get('/', 'get');
    });


    // Field Activies
    Route::controller(FieldActivityController::class)->prefix('field-activity')->group(function() {
        Route::get('/', 'getAll')->name('field-activity-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    // Project
    Route::controller(ProjectController::class)->prefix('project')->group(function() {
        Route::get('/', 'getAll')->name('project-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    // addresses
    Route::controller(AddressController::class)->prefix('address')->group(function() {
        Route::get('/', 'getAll')->name('address-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        // Route::get('/edit/{id}', 'edit')->name('edit');
        // Route::post('/update', 'update')->name('update');
        // Route::post('/softdelete', 'delete')->name('delete');
    });

    // Companies
    Route::controller(CompanyController::class)->prefix('company')->group(function() {
        Route::get('/', 'getAll')->name('company-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        // Route::get('/edit/{id}', 'edit')->name('edit');
        // Route::post('/update', 'update')->name('update');
        // Route::post('/softdelete', 'delete')->name('delete');
    });

    // Drivers
    Route::controller(DriverController::class)->prefix('driver')->group(function() {
        Route::get('/', 'getAll')->name('driver-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    // Brand Group
    Route::controller(BrandController::class)->prefix('brand')->group(function() {
        Route::get('/', 'getAll')->name('brand-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

     Route::controller(EquipmentPrefixController::class)->prefix('prefix')->group(function() {
        Route::get('/', 'getAll')->name('prefix-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });


    // Route::get('prefix-list', [EquipmentPrefixController::class, 'getAll'])->name('prefix-list');
    // // Route::get('search-prefix', [EquipmentPrefixController::class, 'search']);
    // Route::post('store', [EquipmentPrefixController::class, 'store']);
    // Route::post('edit', [EquipmentPrefixController::class, 'edit']);
    // Route::post('delete', [EquipmentPrefixController::class, 'destroy']);

    // Equipment Group
    Route::controller(EquipmentGroupController::class)->prefix('equipment-group')->group(function() {
        Route::get('/', 'getAll')->name('equipment-group-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    // Families Group
    Route::controller(EquipmentFamilyController::class)->prefix('family')->group(function() {
        Route::get('/', 'getAll')->name('family-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });


     // Models Equipments Group
     Route::controller(EquipmentModelController::class)->prefix('model')->group(function() {
        Route::get('/', 'getAll')->name('model-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');

    });

    // Models Projects Locations
     Route::controller(ProjectLocationController::class)->prefix('location')->group(function() {
        Route::get('/', 'getAll')->name('location-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');

    });

    // Suppliers
    Route::controller(SupplyerController::class)->prefix('supplyer')->group(function() {
        Route::get('/', 'getAll')->name('supplyer-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    Route::controller(FuelController::class)->prefix('fuel')->group(function() {
        Route::get('/', 'index')->name('fuel-list');
    });

    Route::controller(SupervisorController::class)->prefix('supervisor')->group(function() {
        Route::get('/', 'getAll')->name('supervisor-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });

    Route::controller(ClientController::class)->prefix('client')->group(function() {
        Route::get('/', 'getAll')->name('client-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/softdelete', 'delete')->name('delete');
    });


     // Files / Uploads
     Route::controller(FileController::class)->prefix('file')->group(function() {
        Route::post('/store', 'store')->name('store');
        Route::post('/delete-file', 'deleteFile')->name('delete-file');
    });

    Route::controller(ContractController::class)->prefix('contract')->group(function() {
        Route::get('/panel', 'panel')->name('panel');
        Route::get('/', 'getAll')->name('contract-list');
        // Tela Cadastrar somente Contrato
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        // Tela para Cadastrar Contrato no equipamento
        Route::get('/equipment-contract', 'getEquipmentContract')->name('equipment-contract');
        // Mostrar os Contratos de um fornecedor específico pelo ID do fornecedor
        Route::get('/get-contract-by-supplyer/{supplyer_id}/{vehicle_id}', 'getContractBySupplyer')->name('get-contract-by-supplyer');
        // Route::get('/edit/{id}', 'edit')->name('edit');
        // Route::post('/update', 'update')->name('update');
        // Route::post('/softdelete', 'delete')->name('delete');
    });


    // addresses
    Route::controller(WarehouseController::class)->prefix('warehouse')->group(function() {
        Route::get('/', 'getAll')->name('warehouse-list');
        Route::get('/create', 'getDataToCreate')->name('create');
    });


    // materials
    Route::controller(MaterialController::class)->prefix('material')->group(function() {
        Route::get('/', 'getAll')->name('material-list');
        Route::get('/create', 'getDataToCreate')->name('create');
    });

   // tools
    Route::controller(ToolController::class)->prefix('tool')->group(function() {
        Route::get('/', 'getAll')->name('tool-list');
        Route::get('/create', 'getDataToCreate')->name('create');
    });


    // pco
    Route::controller(PcoController::class)->prefix('pco')->group(function() {
        Route::get('/', 'getAll')->name('pco-list');
        Route::get('/create', 'getDataToCreate')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/get-address-by-project/{project_id}', 'getAddressByProject')->name('get-address-by-project');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/softdelete', 'delete')->name('delete');
        Route::post('/store-service-item', 'storeServiceItem')->name('store-service-item');
        Route::get('/get-service-item-by-user/{user_id}', 'getServiceItemByUser')->name('get-service-item-by-user');
        Route::post('/delete-service-item-by-user', 'deleteServiceItemByUser')->name('delete-service-item-by-user');
    });


    // Users Permissions
    Route::controller(PermissionController::class)->prefix('permission')->group(function() {
        Route::get('/', 'getAll')->name('permission-list');
        Route::get('/get-permission/{user_id}', 'getPermissionByUser')->name('get-permission');
    });




});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// routes: primeiro-segundo
// variavel: primeiroSegundo
// funcao: PrimeiroSegundo
// Class: PrimeiroSegundo
