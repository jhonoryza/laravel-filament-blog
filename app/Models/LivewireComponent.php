<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LivewireComponent extends Model
{
    public function styles(): BelongsToMany
    {
        return $this->belongsToMany(Style::class, 'livewire_component_styles');
    }
}
