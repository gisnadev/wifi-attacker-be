<nav id="topbar">
    <ul class="navbar-nav theme-brand flex-row  text-center">
        <li class="nav-item theme-logo">
            <a href="{{route('dashboard')}}">
                <img src="{{ asset('img/intek.png') }}" class="navbar-logo" alt="logo" style="width:auto">
            </a>
        </li>
    </ul>

    <ul class="list-unstyled menu-categories" id="topAccordion">

        <li class="menu single-menu {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <a href="/dashboard">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        <li class="menu single-menu {{ (request()->is('normal-ap')) || (request()->is('rouge-ap')) || (request()->is('deauth')) || (request()->is('cracking')) || (request()->is('arp-attact')) || (request()->is('clients')) ? 'active' : '' }} ">
            <a href="#analyze" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                <div class="">
                    <i data-feather="zoom-in"></i>
                    <span>Analyzes</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="analyze" data-parent="#topAccordion">
                <li class=" {{ (request()->is('normal-ap')) ? 'active' : '' }}">
                    <a href="/normal-ap"> Normal Ap's </a>
                </li>
                <li class=" {{ (request()->is('rouge-ap')) ? 'active' : '' }}">
                    <a href="/rouge-ap"> Rouge Ap's </a>
                </li>
                <li class=" {{ (request()->is('deauth')) ? 'active' : '' }}">
                    <a href="/deauth"> Deauth's </a>
                </li>
                <li class=" {{ (request()->is('cracking')) ? 'active' : '' }}">
                    <a href="/cracking"> Cracking </a>
                </li>
                <li class=" {{ (request()->is('arp-attact')) ? 'active' : '' }}">
                    <a href="/arp-attact"> Arp Attack </a>
                </li>
                <li class=" {{ (request()->is('clients')) ? 'active' : '' }}">
                    <a href="/clients"> Client's </a>
                </li>
            </ul>
        </li>
        <li class="menu single-menu {{ (request()->is('users'))  || (request()->is('user/create')) || (request()->is('roles')) || (request()->is('permission')) ? 'active' : '' }} ">
            <a href="#administration" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown">
                <div class="">
                    <i data-feather="file-text"></i>
                    <span>Administration</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="administration" data-parent="#topAccordion">
                <li class="{{ (request()->is('users')) ? 'active' : '' }}">
                    <a href="/users"> Users </a>
                </li>
                <li class="{{ (request()->is('user/create')) ? 'active' : '' }}">
                    <a href="/user/create"> Add User </a>
                </li>
                <li class="{{ (request()->is('roles')) ? 'active' : '' }}">
                    <a href="/roles"> Roles </a>
                </li>
                <li class="{{ (request()->is('permission')) ? 'active' : '' }}">
                    <a href="/permission"> Permission </a>
                </li>
            </ul>
        </li>
        <!--<li class="menu single-menu {{ (request()->is('settings')) ? 'active' : '' }}">
        <a href="/settings">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span>Settings</span>
                </div>
            </a>
        </li>-->
        
        <li class="menu single-menu {{ (request()->is('settings')) ? 'active' : '' }}">
            <a href="#Setting" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle autodroprown ">
                <div class="">
                    <i data-feather="settings"></i>
                    <span>Settings</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="Setting" data-parent="#topAccordion">
                <li class=" {{ (request()->is('devices')) ? 'active' : '' }}">
                    <a href="/settings/devices"> Network, DB & Notification</a>
                </li>
                <li class=" {{ (request()->is('notification')) ? 'active' : '' }}">
                    <a href="/settings/services"> Device, Logs & Services </a>
                </li>
            </ul>
        </li>
        <li class="menu single-menu ">
            <a href="/logout">
                <div class="">
                    <i data-feather="log-out"></i>
                    <span>Logout</span>
                </div>
            </a>
        </li>
    </ul>
</nav>