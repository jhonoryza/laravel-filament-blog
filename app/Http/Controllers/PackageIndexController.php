<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class PackageIndexController extends Controller
{
    public function php(Request $request)
    {
        $tools = Tool::query()
            ->where("is_published", true)
            ->where("type", Tool::PHP_PACKAGES)
            //->simplePaginate(10);
            ->orderBy('updated_at', 'desc')
            ->get();
        return inertia()->render("Package/PHP/Index", [
            "tools" => $tools,
        ]);
    }

    public function go(Request $request)
    {
        $tools = Tool::query()
            ->where("is_published", true)
            ->where("type", Tool::GO_PACKAGES)
            //->simplePaginate(10);
            ->orderBy('updated_at', 'desc')
            ->get();
        return inertia()->render("Package/Go/Index", [
            "tools" => $tools,
        ]);
    }

    public function devtools(Request $request)
    {
        $tools = Tool::query()
            ->where("is_published", true)
            ->where("type", Tool::DEV_TOOLS)
            //->simplePaginate(10);
            ->orderBy('updated_at', 'desc')
            ->get();
        return inertia()->render("Package/DevTools/Index", [
            "tools" => $tools,
        ]);
    }
}
