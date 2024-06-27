<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $id
 * @property string $user_id
 * @property string $preview_id
 *
 * @method static \Database\Factories\MemberPreviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview query()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview wherePreviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberPreview whereUserId($value)
 *
 * @mixin \Eloquent
 */
class MemberPreview extends Pivot
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'member_preview';

    protected function casts(): array
    {
        return [
            'user_id' => 'string',
            'preview_id' => 'string',
        ];
    }
}
