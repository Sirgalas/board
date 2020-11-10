<?php


namespace App\UseCases\Adverts;


use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Requests\Adverts\AttributesRequest;
use App\Http\Requests\Adverts\CreateRequest;
use App\Entity\User\User;
use App\Entity\Adverts\Advert\Advert;
use App\Http\Requests\Adverts\EditRequest;
use App\Http\Requests\Adverts\PhotoRequest;
use App\Http\Requests\Adverts\RejectRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Advert\ModerationPassedNotification;

class AdvertService
{

    public function create(User $user, Category $category, Region $region,CreateRequest $request)
    {
        return DB::transaction(function () use ($request,$user,$category,$region){

            /** @var Advert $advert */

            $advert = Advert::make([
                'title' => $request->title,
                'content' => $request->content,
                'price' => $request->price,
                'address' => $request->address,
                'status' => Advert::STATUS_DRAFT,
            ]);

            $advert->user()->associate($user);
            $advert->category()->associate($category);
            $advert->region()->associate($region);

            $advert->saveOrFail();

            foreach ($category->allAttributes() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $advert->values()->make([
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);
                }
            }

            return $advert;
        });
    }

    public function addPhotos(int $id, PhotoRequest $request):void
    {
        $advert=$this->getAdvert($id);
        DB::transaction(function () use ($request,$advert){
            foreach ($request->files as $file){
                $advert->photos()->create([
                    'file'=>$file->store('adverts')
                ]);
            }
            $advert->update();
        });
    }

    public function edit(int $id,EditRequest $request):void
    {
        $advert=$this->getAdvert($id);
        $old=$advert->price;
        $advert->update(
            $request->only([
                'title',
                'content',
                'price',
                'address',
            ])
        );
    }

    public function sendToModeration($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->sendToModeration();
    }

    public function moderate($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->moderate(Carbon::now());
        $advert->user->notify(new ModerationPassedNotification($advert));
    }

    public function reject($id, RejectRequest $request): void
    {
        $advert = $this->getAdvert($id);
        $advert->reject($request->reason);
    }

    public function editAttributes($id, AttributesRequest $request):void
    {
        $advert=$this->getAdvert($id);
        DB::transaction(function () use ($request, $advert){
            $advert->values()->delete();
            foreach ($advert->category->allAttributes() as $attribute){
                $value=$request['attributes'][$attribute->id] ?? null;
                if(!empty($value)){
                    $advert->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);
                }
                $advert->update();
            }
        });
    }

    public function expire(Advert $advert): void
    {
        $advert->expire();
    }

    public function close($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->close();
    }

    public function remove($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->delete();
    }

    private function getAdvert(int $id): Advert
    {
        return Advert::findOrFail($id);
    }
}