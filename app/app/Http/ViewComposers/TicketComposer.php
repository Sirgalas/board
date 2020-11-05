<?php


namespace App\Http\ViewComposers;

use App\Entity\Ticket\Status;
use App\Entity\Ticket\Ticket;
use Illuminate\View\View;

class TicketComposer
{
    public function compose(View $view): void
    {
        $view->with('menuTicket', Ticket::where(['status'=>Status::OPEN])->get());
    }
}