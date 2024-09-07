<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Inventory extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'name',
        'qty',
        'unit',
        'note',
        'type',
        'qty_for_family',
        'created_by',
    ];

    public function searchableAs(): string
    {
        return 'inventory';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'qty' => $this->qty,
            'unit' => $this->unit,
            'note' => $this->note,
            'tenant_id' => $this->tenant_id,
            'created_by' => [
                'id' => $this->creator?->id,
                'name' => $this->creator?->getName(),
            ],
            'created_at' => strtotime($this->created_at),
            'type' => $this->type,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->id()) {
                $model->created_by = auth()->id();
            }
        });

        static::softDeleted(function ($model) {
            if (auth()->id()) {
                $model->deleted_by = auth()->id();

                $model->save();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'tenant_id' => 'string',
        ];
    }
}
