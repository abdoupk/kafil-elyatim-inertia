<?php

namespace App\Models;

use Database\Factories\MemberPreviewFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $id
 * @property string $user_id
 * @property string $preview_id
 *
 * @method static MemberPreviewFactory factory($count = null, $state = [])
 * @method static Builder|MemberPreview newModelQuery()
 * @method static Builder|MemberPreview newQuery()
 * @method static Builder|MemberPreview query()
 * @method static Builder|MemberPreview whereId($value)
 * @method static Builder|MemberPreview wherePreviewId($value)
 * @method static Builder|MemberPreview whereUserId($value)
 *
 * @mixin Eloquent
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
