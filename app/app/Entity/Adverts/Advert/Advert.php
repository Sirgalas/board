<?php

namespace App\Entity\Adverts\Advert;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Entity\User;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Entity\Adverts\Advert\Advert
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int|null $region_id
 * @property string $title
 * @property int $price
 * @property string $address
 * @property string $content
 * @property string $status
 * @property string|null $reject_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property-read Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Adverts\Advert\Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read Region|null $region
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Adverts\Advert\Value[] $values
 * @property-read int|null $values_count
 * @method static Builder|Advert active()
 * @method static Builder|Advert forCategory(\App\Entity\Adverts\Category $category)
 * @method static Builder|Advert forRegion(\App\Entity\Region $region)
 * @method static Builder|Advert forUser(\App\Entity\User $user)
 * @method static Builder|Advert newModelQuery()
 * @method static Builder|Advert newQuery()
 * @method static Builder|Advert query()
 * @method static Builder|Advert whereAddress($value)
 * @method static Builder|Advert whereCategoryId($value)
 * @method static Builder|Advert whereContent($value)
 * @method static Builder|Advert whereCreatedAt($value)
 * @method static Builder|Advert whereExpiresAt($value)
 * @method static Builder|Advert whereId($value)
 * @method static Builder|Advert wherePrice($value)
 * @method static Builder|Advert wherePublishedAt($value)
 * @method static Builder|Advert whereRegionId($value)
 * @method static Builder|Advert whereRejectReason($value)
 * @method static Builder|Advert whereStatus($value)
 * @method static Builder|Advert whereTitle($value)
 * @method static Builder|Advert whereUpdatedAt($value)
 * @method static Builder|Advert whereUserId($value)
 * @mixin \Eloquent
 */
class Advert extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_MODERATION ='moderation';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_EXECUTED='executed';

    protected $table ='advert_adverts';

    protected $guarded=['id'];

    protected $casts=[
        'published_at'=>'datetime',
        'expires_at'=>'datetime',
    ];

    public static $statusesList=[
        self::STATUS_DRAFT=>'Draft',
        self::STATUS_MODERATION=>'На модерации',
        self::STATUS_ACTIVE=>'Активный',
        self::STATUS_CLOSED=>'Закрыто',
        self::STATUS_EXECUTED=>'Исполнено'
    ];

    public static $statusClasses=[
        self::STATUS_DRAFT=>'secondary',
        self::STATUS_MODERATION=>'primary',
        self::STATUS_ACTIVE=>'primary',
        self::STATUS_CLOSED=>'danger',
        self::STATUS_EXECUTED=>'success'
    ];

    public function sendToModeration():void
    {
        if(!$this->isDraft()){
            throw  new \DomainException('Advert is not draft.');
        }
        if(!count($this->photos)){
            throw new \DomainException('Upload photos.');
        }
        $this->update([
            'status' => self::STATUS_MODERATION,
        ]);
    }

    public function moderate(Carbon $date):void
    {
        if($this->status !== self::STATUS_MODERATION){
            throw new \DomainException('Advert is not sent to moderation.');
        }
        $this->update([
            'published_at' => $date,
            'expires_at' => $date->copy()->addDays(15),
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function reject($reason):void
    {
        $this->update([
            'status' => self::STATUS_DRAFT,
            'reject_reason' => $reason,
        ]);
    }

    public function expire():void
    {
        $this->update([
            'status' => self::STATUS_CLOSED
        ]);
    }

    public function getValue($id)
    {
        foreach ($this->values as $value){
            if($value->attribute_id === $id){
                return $value->value;
            }
        }
        return null;
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isOnModeration(): bool
    {
        return $this->status === self::STATUS_MODERATION;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isClosed(): bool
    {
        return $this->status === self::STATUS_CLOSED;
    }

    public function isExecuted():bool
    {
        return $this->status === self::STATUS_EXECUTED;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'advert_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'advert_id', 'id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeForCategory(Builder $query, Category $category)
    {
        return $query->whereIn('category_id', array_merge(
            [$category->id],
            $category->descendants()->pluck('id')->toArray()
        ));
    }

    public function scopeForRegion(Builder $query, Region $region)
    {
        $ids = [$region->id];
        $childrenIds = $ids;
        while ($childrenIds = Region::where(['parent_id' => $childrenIds])->pluck('id')->toArray()) {
            $ids = array_merge($ids, $childrenIds);
        }
        return $query->whereIn('region_id', $ids);
    }
}
