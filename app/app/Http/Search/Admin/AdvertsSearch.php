<?php


namespace App\Http\Search\Admin;


use App\Http\Requests\Admin\Adverts\SearchRequest;
use App\Entity\Adverts\Advert\Advert;
class AdvertsSearch
{
    public function search(SearchRequest $request)
    {
        $query = Advert::orderByDesc('updated_at');

        if (!empty($value = $request->id)) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->title)) {
            $query->where('title', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->user)) {
            $query->where('user_id', $value);
        }

        if (!empty($value = $request->region)) {
            $query->where('region_id', $value);
        }

        if (!empty($value = $request->category)) {
            $query->where('category_id', $value);
        }

        if (!empty($value = $request->status)) {
            $query->where('status', $value);
        }

        return $query->paginate(20);
    }

}