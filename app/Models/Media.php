<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * @property string $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $extension
 * @property-read mixed $human_readable_size
 * @property-read Model|Eloquent $model
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read mixed $type
 *
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static Builder|Media newModelQuery()
 * @method static Builder|Media newQuery()
 * @method static Builder|Media ordered()
 * @method static Builder|Media query()
 * @method static Builder|Media whereCollectionName($value)
 * @method static Builder|Media whereConversionsDisk($value)
 * @method static Builder|Media whereCreatedAt($value)
 * @method static Builder|Media whereCustomProperties($value)
 * @method static Builder|Media whereDisk($value)
 * @method static Builder|Media whereFileName($value)
 * @method static Builder|Media whereGeneratedConversions($value)
 * @method static Builder|Media whereId($value)
 * @method static Builder|Media whereManipulations($value)
 * @method static Builder|Media whereMimeType($value)
 * @method static Builder|Media whereModelId($value)
 * @method static Builder|Media whereModelType($value)
 * @method static Builder|Media whereName($value)
 * @method static Builder|Media whereOrderColumn($value)
 * @method static Builder|Media whereResponsiveImages($value)
 * @method static Builder|Media whereSize($value)
 * @method static Builder|Media whereUpdatedAt($value)
 * @method static Builder|Media whereUuid($value)
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 * @method static MediaCollection<int, static> all($columns = ['*'])
 * @method static MediaCollection<int, static> get($columns = ['*'])
 *
 * @mixin Eloquent
 */
class Media extends BaseMedia
{
    use HasUuids;
}
