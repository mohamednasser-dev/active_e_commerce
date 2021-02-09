<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\sellerstype
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property int $top
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\sellerstype whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class sellerstype extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('alphabetical', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }
}
