<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Recurr\Exception\InvalidArgument;
use Recurr\Rule;
use Recurr\Transformer\TextTransformer;
use Recurr\Transformer\Translator;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Str;

class Event extends Model
{
    use BelongsToTenant, HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'until',
        'frequency',
        'interval',
        'lesson_id',
        'start_date',
        'end_date',
        'color',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(PrivateSchool::class);
    }

    public function occurrences(): HasMany
    {
        return $this->hasMany(EventOccurrence::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @throws InvalidArgument
     */
    public function humanReadable()
    {
        $rule = new Rule();
        $rule->setStartDate($this->start_date);
        $rule->setEndDate($this->end_date);
        $rule->setFreq(Str::upper($this->frequency));
        $rule->setInterval($this->interval);
        $rule->setUntil(Carbon::parse($this->until));
        $rule->setWeekStart('SU');

        $textTransformer = new TextTransformer(
            new Translator('fr')
        );

        return $textTransformer->transform($rule);
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
            'school_id' => 'string',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
