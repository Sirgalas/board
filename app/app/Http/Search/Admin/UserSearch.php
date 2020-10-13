<?php


namespace App\Http\Search\Admin;


use App\Entity\User\User;
use App\Http\Requests\Admin\Users\SearchRequest;

class UserSearch
{
    public function search(SearchRequest $request){
        $query = User::orderByDesc('id');

        if (!empty($value = $request->id)) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->name)) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->email)) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->status)) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->role)) {
            $query->where('role', $value);
        }
        return $query->paginate(20);
    }
}