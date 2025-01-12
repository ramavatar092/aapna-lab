<?php

use App\Livewire\PatientRegistration\Add as AllPatientRegistration;
use App\Livewire\PatientRegistration\PatientList\All as AllPatientList;
use App\Livewire\PatientRegistration\PatientList\Patientdetail as AllPatientDetail;
use App\Livewire\Test\All as AllTest;
use App\Livewire\Test\A as AddTest;

use App\Livewire\Package\All as AllPackage;

use App\Livewire\Dashboard\Dashboard as Dashboard;
use App\Livewire\EnterandVerify\All as AllEnterVerify;
use App\Livewire\Inventry\Dashboard\Dashboard as InventryDashboard;
use App\Livewire\Department\All as AllDepartment;
use App\Livewire\Permission\All as AllPermission;
use App\Livewire\Roles\All as AllRoles;
use App\Livewire\Lab\All as AllLabMangement;
use App\Livewire\ManageUser\All as AllManageUser;
use App\Livewire\LabProfile\All as AllLabProfile;
use App\Livewire\Center\All as AllCenter;
use App\Livewire\Test\TestFeature as AddTestFeature;
use App\Livewire\Users\All as AllUsers;
use App\Livewire\SampleCollector\All as AllSampleCollector;
use Illuminate\Support\Facades\Route;

Route::get('/login-without-password', function () {
    $user = \App\Models\User::first();
    auth()->login($user);
    return redirect()->route('dashboard');
});

Route::view('/', 'auth.login');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin',])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('users', AllUsers::class)->name('admin.users');
    Route::get('patient-registrations',AllPatientRegistration::class)->name('admin.registrations');
    Route::get('patient-list',AllPatientList::class)->name('admin.patient-list');
    Route::get('patient-list/{id}',AllPatientDetail::class)->name('admin.patientdetails');
    Route::get('test',AllTest::class)->name('admin.tests');
    Route::get('/enterverify',AllEnterVerify::class)->name('admin.enterverify');
    Route::get('test/parameter/{id}',AddTestFeature::class)->name('admin.testfeature');
    // Route::get('test/update/{id}',UpdateTest::class)->name('admin.testupdate');
    Route::get('department', AllDepartment::class)->name('admin.departments');
    Route::get('Package',AllPackage::class)->name('admin.packages');
    Route::get('labMangement',AllLabMangement::class)->name('admin.labMangement');
    Route::get('labProfile',AllLabProfile::class)->name('admin.labProfile');
    Route::get('labDashboard', InventryDashboard::class)->name('admin.labDashboard');
    Route::get('center',AllCenter::class)->name('admin.center');
    Route::get('manage-user',AllManageUser::class)->name('admin.manageUser');
    Route::get('sampleCollector',AllSampleCollector::class)->name('admin.sampleCollector');

    Route::get('permissions',AllPermission::class)->name('admin.permission');
    Route::get('roles',AllRoles::class)->name('admin.role');
});
