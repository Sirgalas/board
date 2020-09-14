<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    Pages
</div>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Пользователи</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.regions.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Регион</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.adverts.categories.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Категории</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.adverts.adverts.index') }}" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
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