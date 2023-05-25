<!-- ! Main nav -->
<nav class="main-nav--bg">
    <div class="container main-nav">
        <div class="main-nav-start">
            {{--<div class="search-wrapper">
                <i data-feather="search" aria-hidden="true"></i>
                <input type="text" placeholder="Enter keywords ..." required>
            </div>--}}
            <h2>Espace client</h2>
        </div>

        <div class="main-nav-end">

            <div class="nav-user-wrapper">
                @if(auth()->check() && auth()->user()->user_type == 2)
                    <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                    <span class="sr-only">Mon profile</span>
                    <span class="nav-user-img">
            <picture><source srcset="{{asset("img/avatar/avatar-illustrated-01.webp")}}" type="image/webp"><img src="{{asset("img/avatar/avatar-illustrated-02.png")}}" alt="User name"></picture>
          </span>
                </button>
                <ul class="users-item-dropdown nav-user-dropdown dropdown">

                    <li><a href="{{route('app.dashboard')}}">
                            <i data-feather="user" aria-hidden="true"></i>
                            <span>Profile</span>
                        </a></li>

                    <li><a class="danger" href="{{route('destroy')}}">
                            <i data-feather="log-out" aria-hidden="true"></i>
                            <span>Se deconnecté</span>
                        </a></li>

                </ul>
                @else
                    <a class="btn btn-sm btn-danger">Connexion</a>
                @endif
            </div>

        </div>
    </div>
</nav>
