<?php

namespace App\Http\Controllers;

use App\Livewire\Concerns\MetaTrait;
use App\Models\Tool;
use Illuminate\Http\Request;

class PackageIndexController extends Controller
{
    use MetaTrait;

    public function php(Request $request)
    {
        $tools = Tool::query()
            ->where("is_published", true)
            ->where("type", Tool::PHP_PACKAGES)
            //->simplePaginate(10);
            ->orderBy('updated_at', 'desc')
            ->get();

        $meta = $this->getMetaIndex('PHP Packages', 'List of PHP packages');

        return inertia()->render("Package/PHP/Index", [
            "tools" => $tools,
            'meta' => $meta
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

        $meta = $this->getMetaIndex('Go Packages', 'List of go packages');

        return inertia()->render("Package/Go/Index", [
            "tools" => $tools,
            'meta' => $meta
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

        $meta = $this->getMetaIndex('Recommended Dev Tools', 'List of my dev tools');

        return inertia()->render("Package/DevTools/Index", [
            "tools" => $tools,
            'meta' => $meta
        ]);
    }
}
