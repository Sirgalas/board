<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\User\Network
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Network newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Network newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Network query()
 * @mixin \Eloquent
 */
class Network extends Model
{
    protected $table ='user_networks';

    protected $fillable=['network','identity'];

    public $timestamps=false;
}
