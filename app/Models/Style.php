<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Style extends Model
{
    public function livewireComponents(): BelongsToMany
    {
        return $this->belongsToMany(LivewireComponent::class, 'livewire_component_styles');
    }

}
