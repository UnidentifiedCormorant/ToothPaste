<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * App\Models\Pasta
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta withoutTrashed()
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $expirationTime
 * @property string $hash
 * @property int|null $user_id
 * @property int $access_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AccessType|null $accessType
 * @method static \Database\Factories\PastaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereAccessTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereExpirationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta whereUserId($value)
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta defaultSort(string $column, string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta filtersApplySelection($class)
 * @mixin \Eloquent
 */
class Pasta extends Model
{
    use HasFactory, SoftDeletes, AsSource, Filterable;

    protected $fillable = [
        'title',
        'content',
        'expirationTime',
        'hash',
        'user_id',
        'access_type',
    ];

    protected $allowedSorts = [
        'title'
    ];

    protected $allowedFilters = [
        'title'
    ];

    /**
     * Возвращает тип досутпа пасты
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accessType(): BelongsTo
    {
        return $this->belongsTo(AccessType::class);
    }

    /**
     * Возвращает пользователя, создавшего пасту
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
