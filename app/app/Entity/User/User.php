<?php

namespace App\Entity\User;

use App\Entity\Adverts\Advert\Advert;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\HasApiTokens;

/**
 * App\Entity\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $verify_token
 * @property string $role
 * @property string $status
 * @property string $permission
 * @property string|null $remember_token
 * @property string $phone
 * @property bool $phone_verified
 * @property string $phone_verify_token
 * @property boolean $phone_auth
 * @property Carbon $phone_verify_token_expire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifyToken($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifyToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifyTokenExpire($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Advert[] $adverts
 * @property-read int|null $adverts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Advert[] $favorites
 * @property-read int|null $favorites_count
 * @method Builder byNetwork(string $network, string $identity)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User\Network[] $networks
 * @property-read int|null $networks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const PHONE_TOKEN_EXPIRE=300;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public static $statuses=[
        self::STATUS_WAIT=>'Ожидает активации',
        self::STATUS_ACTIVE=>'Активны пользователь'
    ];

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MODERATOR= 'moderator';

    public static $rolesName=[
        self::ROLE_ADMIN=>'Администратор',
        self::ROLE_USER=>'Пользователь',
        self::ROLE_MODERATOR=>'Модератор'
    ];

    public const PERMISSION_USER = 'user';
    public const PERMISSION_EXECUTOR = 'executor';

    public static $permissions=[
        self::PERMISSION_USER=>'Пользователь',
        self::PERMISSION_EXECUTOR=>'Исполнитель'
    ];

    protected $casts = [
       // 'phone_verified' => 'boolean',
        'phone_verify_token_expire' => 'datetime',
        //'phone_auth' => 'boolean',
    ];

    protected $guarded = ['id'];

    public static function registerByNetwork(string $network, string $identity): self
    {
        $user = static::create([
            'name' => $identity,
            'email' => null,
            'password' => null,
            'verify_token' => null,
            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE,
        ]);
        $user->networks()->create([
            'network' => $network,
            'identity' => $identity,
        ]);
        return $user;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->{$user->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(RegisterRequest $request): self
    {
        return static::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verify_token' => Str::uuid(),
            'role' => self::ROLE_USER,
            'permission'=>self::PERMISSION_USER,
            'status' => self::STATUS_WAIT,
        ]);
    }

    public static function new(CreateRequest $request): self
    {
        return static::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(Str::random()),
            'role' => self::ROLE_USER,
            'permission'=>self::PERMISSION_USER,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function attachNetwork($network,$id)
    {
        $exists =$this->networks()->where([
            'network' => $network,
            'identity' => $id
        ]);
        if($exists){
            throw new \DomainException('Пользователь с таким id зарегистрирован в системе');
        }

        $this->networks()->create([
            'network' => $network,
            'identity' => $id
        ]);
    }

    public function unverifyPhone(): void
    {
        $this->phone_verified = false;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->phone_auth=false;
        $this->saveOrFail();
    }

    public function requestPhoneVerification(Carbon $now): string
    {
        if (empty($this->phone)) {
            throw new \DomainException('Не указан номер телефона.');
        }
        if (!empty($this->phone_verify_token) && $this->phone_verify_token_expire && $this->phone_verify_token_expire->gt($now)) {
            throw new \DomainException('Токен не создан');
        }
        $this->phone_verified = false;
        $this->phone_verify_token = (string)random_int(10000, 99999);
        $this->phone_verify_token_expire = $now->copy()->addSeconds(self::PHONE_TOKEN_EXPIRE);
        $this->saveOrFail();

        return $this->phone_verify_token;
    }

    public function verifyPhone($token, Carbon $now): void
    {
        if ($token !== $this->phone_verify_token) {
            throw new \DomainException('Не правильный токен.');
        }
        if ($this->phone_verify_token_expire->lt($now)) {
            throw new \DomainException('Время ожидание ввода токена истекло.');
        }
        $this->phone_verified = true;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }

    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::$rolesName)) {
            throw new \InvalidArgumentException('Роль "' . $role . '" не найдена');
        }
        if ($this->role === $role) {
            throw new \DomainException('Роль присвоена.');
        }
        $this->update(['role' => $role]);
    }

    public function addToFavorites(Advert $advert): void
    {
        if ($this->hasInFavorites($advert->id)) {
            throw new \DomainException('This advert is already added to favorites.');
        }
        $this->favorites()->attach($advert);
    }

    public function removeFromFavorites($id): void
    {
        $this->favorites()->detach($id);
    }

    public function hasInFavorites($id): bool
    {
        return $this->favorites()->where('id', $id)->exists();
    }

    public function changePermission($permission): void
    {
        if (!array_key_exists($permission, self::$permissions)) {
            throw new \InvalidArgumentException('Разрешение "' . $permission . '" не найдено');
        }
        if ($this->permission === $permission) {
            throw new \DomainException('Разрешение присвоено.');
        }
        $this->update(['permission' => $permission]);
    }

    public function enablePhoneAuth(): void
    {
        if (!empty($this->phone) && !$this->isPhoneVerified()) {
            throw new \DomainException('Phone number is empty.');
        }
        $this->phone_auth = true;
        $this->saveOrFail();
    }

    public function disablePhoneAuth(): void
    {
        $this->phone_auth = false;
        $this->saveOrFail();
    }

    public function isPhoneAuthEnabled(): bool
    {
        return (bool)$this->phone_auth;
    }

    public function hasFilledProfile(): bool
    {
        return !empty($this->name) && !empty($this->last_name) && $this->isPhoneVerified();
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isExecutor(): bool
    {
        return $this->permission === self::PERMISSION_EXECUTOR;
    }

    public function isPhoneVerified(): bool
    {
        return $this->phone_verified;
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Advert::class, 'advert_favorites', 'user_id', 'advert_id');
    }

    public function networks()
    {
        return $this->hasMany(Network::class, 'user_id', 'id');
    }

    public function scopeByNetwork(Builder $query, string $network, string $identity): Builder
    {
        return $query->whereHas('networks', function(Builder $query) use ($network, $identity) {
            $query->where('network', $network)->where('identity', $identity);
        });
    }

    public function findForPassport($identifier)
    {
        return self::where('email', $identifier)->where('status', self::STATUS_ACTIVE)->first();
    }
}