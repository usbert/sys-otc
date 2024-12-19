<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        // USERS
        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository',
        );
        // USER PROJECTS
        $this->app->bind(
            'App\Repositories\Interfaces\UserProjectRepositoryInterface',
            'App\Repositories\UserProjectRepository',
        );

        // TYPE OF DOCUMENTS
        $this->app->bind(
            'App\Repositories\Interfaces\TypeDocumentRepositoryInterface',
            'App\Repositories\TypeDocumentRepository',
        );

        // CONTACTS
        $this->app->bind(
            'App\Repositories\Interfaces\ContactRepositoryInterface',
            'App\Repositories\ContactRepository',
        );


        // MEASUREMENT UNITS
        $this->app->bind(
            'App\Repositories\Interfaces\MeasurementUnitRepositoryInterface',
            'App\Repositories\MeasurementUnitRepository',
        );

        // FIELD ACTIVITIES
        $this->app->bind(
            'App\Repositories\Interfaces\FieldActivityRepositoryInterface',
            'App\Repositories\FieldActivityRepository',
        );

        // COMPANIES
        $this->app->bind(
            'App\Repositories\Interfaces\CompanyRepositoryInterface',
            'App\Repositories\CompanyRepository',
        );

        // ADDRESSES
        $this->app->bind(
            'App\Repositories\Interfaces\AddressRepositoryInterface',
            'App\Repositories\AddressRepository',
        );


        // PROJECTS
        $this->app->bind(
            'App\Repositories\Interfaces\ProjectRepositoryInterface',
            'App\Repositories\ProjectRepository',
        );
        // ACTIVITIES OF PROJECTS
        $this->app->bind(
            'App\Repositories\Interfaces\ProjectActivityRepositoryInterface',
            'App\Repositories\ProjectActivityRepository',
        );
        // SUPERVISORS OF PROJECTS
        $this->app->bind(
            'App\Repositories\Interfaces\ProjectSupervisorRepositoryInterface',
            'App\Repositories\ProjectSupervisorRepository',
        );

        // CLIENTS
        $this->app->bind(
            'App\Repositories\Interfaces\ClientRepositoryInterface',
            'App\Repositories\ClientRepository',
        );

        // PROJECT LOCATIONS
        $this->app->bind(
            'App\Repositories\Interfaces\ProjectLocationRepositoryInterface',
            'App\Repositories\ProjectLocationRepository',
        );

        // SUPPLYERS
        $this->app->bind(
            'App\Repositories\Interfaces\SupplyerRepositoryInterface',
            'App\Repositories\SupplyerRepository',
        );

        // DRIVERS
        $this->app->bind(
            'App\Repositories\Interfaces\DriverRepositoryInterface',
            'App\Repositories\DriverRepository',
        );

        // SUPERVISORS
        $this->app->bind(
            'App\Repositories\Interfaces\SupervisorRepositoryInterface',
            'App\Repositories\SupervisorRepository',
        );

        // BRANDS
        $this->app->bind(
            'App\Repositories\Interfaces\BrandRepositoryInterface',
            'App\Repositories\BrandRepository',
        );


        // EQUIPMENT PREFIXES
        $this->app->bind(
            'App\Repositories\Interfaces\EquipmentPrefixRepositoryInterface',
            'App\Repositories\EquipmentPrefixRepository',
        );

        // EQUIPMENT GROUPS
        $this->app->bind(
            'App\Repositories\Interfaces\EquipmentGroupRepositoryInterface',
            'App\Repositories\EquipmentGroupRepository',
        );

        // EQUIPMENT FAMILIES
        $this->app->bind(
            'App\Repositories\Interfaces\EquipmentFamilyRepositoryInterface',
            'App\Repositories\EquipmentFamilyRepository',
        );

        // EQUIPMENT MODELS
        $this->app->bind(
            'App\Repositories\Interfaces\EquipmentModelRepositoryInterface',
            'App\Repositories\EquipmentModelRepository',
        );

        // VEHICLES
        $this->app->bind(
            'App\Repositories\Interfaces\VehicleRepositoryInterface',
            'App\Repositories\VehicleRepository',
        );


        // PIVOT MEASURES OF FAMILIES
        $this->app->bind(
            'App\Repositories\Interfaces\FamilyMeasureRepositoryInterface',
            'App\Repositories\FamilyMeasureRepository',
        );

        // PIVOT PROJECT OF CLIENTS
        $this->app->bind(
            'App\Repositories\Interfaces\ProjectClientRepositoryInterface',
            'App\Repositories\ProjectClientRepository',
        );


        // PERMISSÕES
        $this->app->bind(
            'App\Repositories\Interfaces\PermissionRepositoryInterface',
            'App\Repositories\PermissionRepository',
        );

        // FILES ATTACHED
        $this->app->bind(
            'App\Repositories\Interfaces\FileRepositoryInterface',
            'App\Repositories\FileRepository',
        );

        // CONTRACTS
        $this->app->bind(
            'App\Repositories\Interfaces\ContractRepositoryInterface',
            'App\Repositories\ContractRepository',
        );

        // MATERIALS
        $this->app->bind(
            'App\Repositories\Interfaces\MaterialRepositoryInterface',
            'App\Repositories\MaterialRepository',
        );

        // TOOLS
        $this->app->bind(
            'App\Repositories\Interfaces\ToolRepositoryInterface',
            'App\Repositories\ToolRepository',
        );


        // WAREHOUSES
        $this->app->bind(
            'App\Repositories\Interfaces\WarehouseRepositoryInterface',
            'App\Repositories\WarehouseRepository',
        );

         // PCOS
         $this->app->bind(
            'App\Repositories\Interfaces\PcoRepositoryInterface',
            'App\Repositories\PcoRepository',
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
