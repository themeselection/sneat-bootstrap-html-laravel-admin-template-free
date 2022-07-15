<?php

use Illuminate\Support\Facades\Route;

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

// Main Page Route
Route::get('/', 'dashboard\Analytics@index')->name('dashboard-analytics');

// layout
Route::get('/layouts/without-menu', 'layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', 'layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', 'layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', 'layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', 'layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', 'pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', 'pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', 'pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', 'pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', 'pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', 'authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', 'authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', 'authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', 'cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', 'user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', 'user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', 'user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', 'user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', 'user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', 'user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', 'user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', 'user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', 'user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', 'user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', 'user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', 'user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', 'user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', 'user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', 'user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', 'user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', 'user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', 'user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', 'user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', 'extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', 'extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', 'icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', 'form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', 'form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', 'form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', 'form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', 'tables\Basic@index')->name('tables-basic');
