<?php

use Illuminate\Support\Facades\Route;
use Modules\HotelMgnt\Http\Controllers\ConferenceRoomsController;
use Modules\Setups\Http\Controllers\DepartmentController;
use Modules\Setups\Http\Controllers\IdentityTypesController;
use Modules\Setups\Http\Controllers\InstitutionsController;
use Modules\Setups\Http\Controllers\ItemCategoriesController;
use Modules\Setups\Http\Controllers\PaymentMethodController;
use Modules\Setups\Http\Controllers\SetupsController;
use Modules\Setups\Http\Controllers\StaffRoleController;
use Modules\Setups\Http\Controllers\UnitsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('setups', SetupsController::class)->names('setups');
});

Route::middleware('auth')->group(function () {
    Route::resource('identity-types', IdentityTypesController::class)->except('show', 'destroy');
    Route::get('identity-types/destroy/{id}', [IdentityTypesController::class, 'destroy'])->name('identity-types.destroy');

    Route::resource('departments', DepartmentController::class)->except('show', 'destroy');
    Route::get('departments/destroy/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    Route::resource('staff-roles', StaffRoleController::class)->except('show', 'destroy');
    Route::get('staff-roles/destroy/{id}', [StaffRoleController::class, 'destroy'])->name('staff-roles.destroy');

    Route::resource('units', UnitsController::class)->except('show', 'destroy');
    Route::get('units/destroy/{id}', [UnitsController::class, 'destroy'])->name('units.destroy');

    Route::resource('item-categories', ItemCategoriesController::class)->except('show', 'destroy');
    Route::get('item-categories/destroy/{id}', [ItemCategoriesController::class, 'destroy'])->name('item-categories.destroy');

    Route::resource('institutions', InstitutionsController::class)->except('show', 'destroy');
    Route::get('institutions/destroy/{id}', [InstitutionsController::class, 'destroy'])->name('institutions.destroy');

    Route::resource('payment-methods', PaymentMethodController::class)->except('show', 'destroy');
    Route::get('payment-methods/destroy/{id}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');

});

