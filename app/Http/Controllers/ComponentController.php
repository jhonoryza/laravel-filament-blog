<?php

namespace App\Http\Controllers;

use App\Livewire\Concerns\MetaTrait;
use App\Models\LivewireComponent;

class ComponentController extends Controller
{
    use MetaTrait;

    public function __invoke()
    {
        $components = LivewireComponent::query()
            ->with([
                'styles'
            ])
            ->where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $meta = $this->getMetaIndex('Livewire Components', 'List of Livewire Components');

        return inertia()->render('Component/Index', [
            'components' => $components,
            'meta' => $meta
        ]);
    }
}
