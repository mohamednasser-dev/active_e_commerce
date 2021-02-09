<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\seller_sellerstype
 *
 * @property int $id
 * @property string|null $photo
 * @property string|null $url
 * @property int $position
 * @property int $published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\seller_sellerstype whereUrl($value)
 * @mixin \Eloquent
 */

class seller_sellerstype extends Model
{
    protected static function boot()
    {
        parent::boot();

         
    }
}
