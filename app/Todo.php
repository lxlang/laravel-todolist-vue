<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Todo
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $done
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Todo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Todo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Todo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Todo withoutTrashed()
 * @mixin \Eloquent
 */
class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'done',
    ];


    protected $casts = [
        'done' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
