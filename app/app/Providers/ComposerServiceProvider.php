<?php


namespace App\Providers;

use App\Entity\Ticket\Ticket;
use App\Http\ViewComposers\MenuPagesComposer;
use App\Http\ViewComposers\TicketComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', MenuPagesComposer::class);
        View::composer('admin.layouts.main',TicketComposer::class);
    }
}