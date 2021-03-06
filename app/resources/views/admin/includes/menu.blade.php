<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Панель</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

@can ('manage-users')
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Пользователи</span></a>
</li>
@endcan
@can ('manage-regions')
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.regions.index') }}">
        <i class="fas fa-fw fa-map-marked"></i>
        <span>Регион</span></a>
</li>
@endcan
<!-- Nav Item - Tables -->
@can ('manage-adverts-categories')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.adverts.categories.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Категории</span></a>
</li>
@endcan
@can ('manage-adverts')
<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.adverts.adverts.index') }}" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-book-reader"></i>
        <span>Объявления</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Объявления:</h6>
            <a class="collapse-item" href="{{ route('admin.adverts.adverts.index') }}">Все объявления</a>
            <a class="collapse-item" href="{{ route('admin.adverts.categories.index') }}">Категории</a>
        </div>
    </div>
</li>
@endcan
@can ('manage-banners')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.banners.index') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Баннер</span>
        </a>
    </li>
@endcan
@can ('manage-pages')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.pages.index') }}">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>Страницы</span>
        </a>
    </li>
@endcan
@can ('manage-tickets')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tickets.index') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Обратная связь</span>
        </a>
    </li>
@endcan
