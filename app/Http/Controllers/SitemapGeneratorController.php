<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SitemapGeneratorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Artisan::call('sitemap:generate');
        return response()->json('sitemap generated');
    }
}
