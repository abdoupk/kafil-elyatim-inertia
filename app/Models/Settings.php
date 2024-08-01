<?php

namespace App\Models;

use Database\Factories\SettingsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property-read User|null $user
 *
 * @method static Builder|Settings newModelQuery()
 * @method static Builder|Settings newQuery()
 * @method static Builder|Settings query()
 *
 * @property int $id
 * @property string $user_id
 * @property string $theme
 * @property string $color_scheme
 * @property string $layout
 * @property string|null $notifications
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static SettingsFactory factory($count = null, $state = [])
 * @method static Builder|Settings whereColorScheme($value)
 * @method static Builder|Settings whereCreatedAt($value)
 * @method static Builder|Settings whereId($value)
 * @method static Builder|Settings whereLayout($value)
 * @method static Builder|Settings whereNotifications($value)
 * @method static Builder|Settings whereTheme($value)
 * @method static Builder|Settings whereUpdatedAt($value)
 * @method static Builder|Settings whereUserId($value)
 *
 * @property string $appearance
 *
 * @method static Builder|Settings whereAppearance($value)
 *
 * @property string $tenant_id
 * @property-read Tenant $tenant
 *
 * @method static Builder|Settings whereTenantId($value)
 *
 * @mixin Eloquent
 */
class Settings extends Model
{
    use BelongsToTenant, HasFactory, HasUuids;

    protected $fillable = [
        'theme',
        'color_scheme',
        'layout',
        'appearance',
        'user_id',
        'notifications',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'notifications' => 'json',
        ];
    }
}
