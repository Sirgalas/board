<?php

namespace App\Entity\Adverts\Dialog;

use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Adverts\Dialog\Dialog
 *
 * @property int $id
 * @property int $advert_id
 * @property int $user_id
 * @property int $client_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_new_messages
 * @property int $client_new_messages
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Dialog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dialog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dialog query()
 * @mixin \Eloquent
 */
class Dialog extends Model
{
    protected $table = 'advert_dialogs';

    protected $guarded = ['id'];

    public function writeMessageByOwner(int $userId, string $message): void
    {
        $this->messages()->create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        $this->client_new_messages++;
        $this->save();
    }

    public function writeMessageByClient(int $userId, string $message): void
    {
        $this->messages()->create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        $this->user_new_messages++;
        $this->save();
    }

    public function readByOwner(): void
    {
        $this->update(['user_new_messages' => 0]);
    }

    public function readByClient(): void
    {
        $this->update(['client_new_messages' => 0]);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'dialog_id', 'id');
    }
}
