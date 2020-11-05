<?php


namespace App\Http\Search\Admin;


use App\Entity\Ticket\Ticket;
use App\Http\Requests\Admin\Ticket\SearchRequest;

class TicketSearch
{
    public function search(SearchRequest $request)
    {
        $query = Ticket::orderByDesc('updated_at');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('user'))) {
            $query->where('user_id', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        return $query->paginate(20);
    }
}