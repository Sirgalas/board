<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link{{$page==='home'?' active':''}}" href="{{ route('cabinet.home') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{$page==='adverts'?' active':''}}" href="{{ route('cabinet.adverts.index') }}">Adverts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{$page==='favorites'?' active':''}}" href="{{ route('cabinet.favorites.index') }}">Favorites</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{$page==='banner'?' active':''}}" href="{{ route('cabinet.banners.index') }}">Banners</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{$page==='profile'?' active':''}}" href="{{ route('cabinet.profile.home') }}">Profile</a>
    </li>
</ul>