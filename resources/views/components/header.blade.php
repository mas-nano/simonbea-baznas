<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->user()->operator == null && auth()->user()->awardee == null)
                    <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1"
                        style="aspect-ratio:1; object-fit:cover; object-position:center">
                @else
                    @if (auth()->user()->operator != null)
                        <img alt="image" src="{{ asset('storage/' . auth()->user()->operator->picture) }}"
                            class="rounded-circle mr-1"
                            style="aspect-ratio:1; object-fit:cover; object-position:center">
                    @else
                        <img alt="image" src="{{ asset('storage/' . auth()->user()->awardee->picture) }}"
                            class="rounded-circle mr-1"
                            style="aspect-ratio:1; object-fit:cover; object-position:center">
                    @endif
                @endif

                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ auth()->user()->email }}</div>
                <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('profile.setting') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post" id="logout">
                    @csrf
                    <a role="button" type="submit" class="dropdown-item has-icon text-danger"
                        onclick="return logout.submit()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
