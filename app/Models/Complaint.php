<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Complaint
 *
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property int $pasta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint query()
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint wherePastaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Complaint whereUserId($value)
 * @mixin \Eloquent
 */
class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'pasta_id'
    ];

    /**
     * Возвращает пасту, к которой привязана жалоба
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasta() : BelongsTo
    {
        return $this->belongsTo(Pasta::class);
    }

    /**
     * Возвращает пользователя, к которой создал жалобу
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
