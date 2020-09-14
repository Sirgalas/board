<?php


namespace App\Entity\Adverts\Advert;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Adverts\Advert\Photo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $advert_id
 * @property string $file
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 */
class Photo extends Model
{

    protected $table = 'advert_advert_photos';

    public $timestamps = false;

    protected $fillable = ['file'];
}