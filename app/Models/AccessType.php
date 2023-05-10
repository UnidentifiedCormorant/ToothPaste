<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccessType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType query()
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccessType extends Model
{
    use HasFactory;


}
