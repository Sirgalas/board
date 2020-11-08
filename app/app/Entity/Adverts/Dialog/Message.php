<?php

namespace App\Entity\Adverts\Dialog;

use App\Entity\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Adverts\Dialog\Message
 *
 * $property int $id
 * $property Carbon $created_at
 * $property Carbon $updated_at
 * $property int $user_id
 * $property string $message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $table = 'advert_dialog_messages';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
