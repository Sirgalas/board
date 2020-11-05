<?php


namespace App\Http\Search\Admin;


use App\Entity\User\User;
use App\Http\Requests\Admin\Users\SearchRequest;

class UserSearch
{
    public function search(SearchRequest $request){
        $query = User::orderByDesc('id');

        if (!empty($request->id)) {
            $query->where('id', $request->id);
        }

        if (!empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name. '%');
        }
        if (!empty($request->email)) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        if (!empty($request->role)) {
            $query->where('role', $request->role);
        }
        return $query->paginate(20);
    }
}