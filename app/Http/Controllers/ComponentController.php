<?php

namespace App\Http\Controllers;

use App\Models\LivewireComponent;

class ComponentController extends Controller
{
    public function __invoke()
    {
        $components = LivewireComponent::query()
            ->with([
                'styles'
            ])
            ->where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return inertia()->render('Component/Index', [
            'components' => $components
        ]);
    }
}
