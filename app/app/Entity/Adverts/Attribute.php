<?php

namespace App\Entity\Adverts;

use App\Entity\Adverts\Advert\Advert;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Adverts\Atribute
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $type
 * @property string $default
 * @property boolean $required
 * @property array $variants
 * @property integer $sort
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereVariants($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Advert[] $adverts
 * @property-read int|null $adverts_count
 */
class Attribute extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $table = 'advert_attributes';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $casts = [
        'variants' => 'array',
    ];

    public static $typesList= [
            self::TYPE_STRING => 'String',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_FLOAT => 'Float',
        ];


    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isSelect(): bool
    {
        return \count($this->variants) > 0;
    }

    public function isNumber(): bool
    {
        return $this->isInteger() || $this->isFloat();
    }

    public function adverts()
    {
        return $this->belongsToMany(Advert::class);
    }
}
