<?php


namespace App\Entity\Adverts\Advert;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Adverts\Advert\Value
 *
 * @property int $advert_id
 * @property int $attribute_id
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|Value newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value query()
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereValue($value)
 * @mixin \Eloquent
 */
class Value extends Model
{
    protected $table = 'advert_advert_values';

    public $timestamps = false;

    protected $fillable = ['attribute_id', 'value'];

    protected $primaryKey =['advert_id','attribute_id'];
}