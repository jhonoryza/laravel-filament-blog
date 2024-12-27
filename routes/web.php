<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', App\Livewire\LoadMorePosts::class)->name('home');
Route::get('posts/{post}', App\Livewire\PostDetailPage::class)->name('posts.show');
Route::get('projects', App\Livewire\ProjectsPage::class)->name('projects');
Route::get('components', App\Livewire\ComponentList::class)->name('components');
Route::get('devtools', App\Livewire\DevToolList::class)->name('devtools');
Route::get('packages/php', App\Livewire\PhpPackageList::class)->name('packages.php');
Route::get('packages/go', App\Livewire\GoPackageList::class)->name('packages.go');
Route::get('tutorials', App\Livewire\TutorialList::class)->name('tutorials');
