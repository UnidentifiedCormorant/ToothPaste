<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Pasta
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pasta withoutTrashed()
 * @mixin \Eloquent
 */
class Pasta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'expirationTime',
        'hash',
        'user_id',
        'access_type_id',
    ];


    /**
     * Возвращает тип досутпа пасты
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accessType()
    {
        return $this->belongsTo(AccessType::class);
    }
}
