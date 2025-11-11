<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

// layout
Route::name('layouts-')->prefix('layouts/')->group(function () {
  Route::get('without-menu', [WithoutMenu::class, 'index'])->name('layoutwithout-menu');
  Route::get('without-navbar', [WithoutNavbar::class, 'index'])->name('without-navbar');
  Route::get('fluid', [Fluid::class, 'index'])->name('fluid');
  Route::get('container', [Container::class, 'index'])->name('container');
  Route::get('blank', [Blank::class, 'index'])->name('blank');
});



// pages
Route::name('pages-')->prefix('pages/')->group(function () {
  Route::get('account-settings-account', [AccountSettingsAccount::class, 'index'])->name('account-settings-account');
  Route::get('account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('account-settings-notifications');
  Route::get('account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('account-settings-connections');
  Route::get('misc-error', [MiscError::class, 'index'])->name('misc-error');
  Route::get('misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('misc-under-maintenance');
});


// authentication
Route::name('auth-')->prefix('auth/')->group(function () {
  Route::get('login-basic', [LoginBasic::class, 'index'])->name('login-basic');
  Route::get('register-basic', [RegisterBasic::class, 'index'])->name('register-basic');
  Route::get('forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('reset-password-basic');
});


// cards
Route::name('cards-')->prefix('cards/')->group(function () {
  Route::get('basic', [CardBasic::class, 'index'])->name('basic');
});

// User Interface
Route::name('ui-')->prefix('ui/')->group(function () {
  Route::get('accordion', [Accordion::class, 'index'])->name('accordion');
  Route::get('alerts', [Alerts::class, 'index'])->name('alerts');
  Route::get('badges', [Badges::class, 'index'])->name('badges');
  Route::get('buttons', [Buttons::class, 'index'])->name('buttons');
  Route::get('carousel', [Carousel::class, 'index'])->name('carousel');
  Route::get('collapse', [Collapse::class, 'index'])->name('collapse');
  Route::get('dropdowns', [Dropdowns::class, 'index'])->name('dropdowns');
  Route::get('footer', [Footer::class, 'index'])->name('footer');
  Route::get('list-groups', [ListGroups::class, 'index'])->name('list-groups');
  Route::get('modals', [Modals::class, 'index'])->name('modals');
  Route::get('navbar', [Navbar::class, 'index'])->name('navbar');
  Route::get('offcanvas', [Offcanvas::class, 'index'])->name('offcanvas');
  Route::get('pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('pagination-breadcrumbs');
  Route::get('progress', [Progress::class, 'index'])->name('progress');
  Route::get('spinners', [Spinners::class, 'index'])->name('spinners');
  Route::get('tabs-pills', [TabsPills::class, 'index'])->name('tabs-pills');
  Route::get('toasts', [Toasts::class, 'index'])->name('toasts');
  Route::get('tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('tooltips-popovers');
  Route::get('typography', [Typography::class, 'index'])->name('typography');
});

// extended ui
Route::name('extended-')->prefix('extended/')->group(function () {
  Route::get('ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('ui-perfect-scrollbar');
  Route::get('ui-text-divider', [TextDivider::class, 'index'])->name('ui-text-divider');
});

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');