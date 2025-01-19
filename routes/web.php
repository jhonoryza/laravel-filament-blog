<?php

use App\Http\Controllers\ComponentController;
use App\Http\Controllers\PackageIndexController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\SitemapGeneratorController;
use App\Http\Controllers\ToolController;
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

Route::get("/", PostIndexController::class)->name("home");
Route::get("posts/{post}", PostShowController::class)->name("posts.show");
//Route::get("projects", PostShowController::class)->name("projects");
Route::get("components", ComponentController::class)->name("components");
Route::get("devtools", [PackageIndexController::class, "devtools"])->name("devtools");
Route::get("packages/php", [PackageIndexController::class, "php"])->name(
    "packages.php"
);
Route::get("packages/go", [PackageIndexController::class, "go"])->name(
    "packages.go"
);

Route::prefix("wire")
    ->name("wire.")
    ->group(function () {
        Route::get("/", App\Livewire\LoadMorePosts::class)->name("home");
        Route::get("authors/{author}", App\Livewire\AuthorProfile::class)->name(
            "authors.show"
        );
        Route::get("posts/{post}", App\Livewire\PostDetailPage::class)->name(
            "posts.show"
        );
        Route::get("projects", App\Livewire\ProjectsPage::class)->name(
            "projects"
        );
        Route::get("components", App\Livewire\ComponentList::class)->name(
            "components"
        );
        Route::get("devtools", App\Livewire\DevToolList::class)->name(
            "devtools"
        );
        Route::get("packages/php", App\Livewire\PhpPackageList::class)->name(
            "packages.php"
        );
        Route::get("packages/go", App\Livewire\GoPackageList::class)->name(
            "packages.go"
        );
        Route::get("tutorials", App\Livewire\TutorialList::class)->name(
            "tutorials"
        );
    });

Route::get("generate/sitemap", SitemapGeneratorController::class)->name(
    "generate.sitemap"
);
