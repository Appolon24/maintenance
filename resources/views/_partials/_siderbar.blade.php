<!-- ! Sidebar -->
<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="{{route('dashboard')}}" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">Oxfam</span>
                    <span class="logo-subtitle">informatique ixelles</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a  class="{{request()->routeIs('dashboard')?'active':''}}" href="{{route('dashboard')}}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
             {{--   <li>
                    <a class="{{request()->routeIs('demande.index')?'active':''}}" href="{{route('demande.index')}}"><span class="icon folder" aria-hidden="true"></span>Demande depanage</a>
                </li>--}}

                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon folder" aria-hidden="true"></span>Demandes
                        <span class="category__btn transparent-btn {{request()->routeIs('demande.*')?'rotated':''}}" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu {{request()->routeIs('demande.*')?'visible':''}}">
                        <li>
                            <a class="{{request()->routeIs('demande.pending')?'active':''}}" href="{{route('demande.pending')}}">Depannage en attente</a>
                        </li>
                        <li>
                            <a class="{{request()->routeIs('demande.index')?'active':''}}" href="{{route('demande.index')}}">Depannage terminés</a>
                        </li>

                    </ul>
                </li>
            </ul>
            <span class="system-menu__title">Operation</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a  class="{{request()->routeIs('fiche.depannage')?'active':''}}" href="{{route('fiche.depannage')}}"><span class="icon paper" aria-hidden="true"></span>Fiche de depanage</a>
                </li>
                <li>
                    <a class="{{request()->routeIs('fiche.index')?'active':''}}" href="{{route('fiche.index')}}"><span class="icon arrow-down" aria-hidden="true"></span>Bon de sortie</a>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a class="{{request()->routeIs('piecedetache.*')?'active':''}}" href="{{route('piecedetache.index')}}"><span class="icon document" aria-hidden="true"></span>Piece detachés</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn {{request()->routeIs('users.*')?'':'rotated'}}" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu {{request()->routeIs('users.*')?'visible':''}}">
                        <li>
                            <a class="{{request()->routeIs('users.customer')?'active':''}}" href="{{route('users.customer')}}">Clients</a>
                        </li>
                        <li>
                            <a class="{{request()->routeIs('users.technicien')?'active':''}}" href="{{route('users.technicien')}}">Techniciens</a>
                        </li>
                        <li>
                            <a class="{{request()->routeIs('users.administrateur')?'active':''}}" href="{{route('users.administrateur')}}">Administrateurs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                </li>
            </ul>
        </div>
    </div>
 {{--   <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">Nafisa Sh.</span>
                <span class="sidebar-user__subtitle">Support manager</span>
            </div>
        </a>
    </div>--}}
</aside>
