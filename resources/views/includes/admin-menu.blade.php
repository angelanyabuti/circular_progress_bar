@if(\Illuminate\Support\Facades\Auth::user()->type == 'admin' || Illuminate\Support\Facades\Auth::user()->type == 'internal')
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                <i data-feather="home"></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
            </a>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('my.wallet') }}">
                <i data-feather='dollar-sign'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">My Wallet</span>
            </a>
        </li>
        <li class=" navigation-header">
            <span data-i18n="Apps &amp; Pages">Administration</span>
            <i data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('home.sliders') }}">
                <i data-feather='image'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Sliders</span>
            </a>
        </li>

        <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ route('messaging') }}">
                <i data-feather='message-square'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Communication</span>
            </a>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="file-text"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">User Management</span>
            </a>
            <ul class="menu-content">
                <li>
                    <a class="d-flex align-items-center" href="{{ route('admincompanies') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Companies</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('agents') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Agents</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('customers') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Customers</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('merchants') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Merchants</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('roles') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Roles</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('users') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Users</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='shopping-bag'></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">Subscriptions</span>
            </a>
            <ul class="menu-content">
                <li>
                    <a class="d-flex align-items-center" href="{{ route('plans') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Plans</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('subscriptions.show') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Subscriptions</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class=" navigation-header">
            <span data-i18n="Apps &amp; Pages">Inventory</span>
            <i data-feather="more-horizontal"></i>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i data-feather='shopping-bag'></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">Inventory</span>
            </a>
            <ul class="menu-content">
                <li>
                    <a class="d-flex align-items-center" href="{{ route('categories') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Categories</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('industries') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Industries</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('shops') }}">
                <i data-feather='shopping-bag'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Shops</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('adminevents') }}">
                <i data-feather='film'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Special Events</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('orders') }}">
                <i data-feather='shopping-cart'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Orders</span>
            </a>
        </li>

        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('payments') }}">
                <i data-feather='shopping-cart'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Payments</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('logistics') }}">
                <i data-feather='truck'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Logistics</span>
            </a>
        </li>

    </ul>
@endif
@if(\Illuminate\Support\Facades\Auth::user()->type == 'merchant')
    @if( Route::currentRouteName()  == 'single.shop')
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">Shop Menu</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Back To Dashboards</span>
                </a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                    <i data-feather='trello'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Shop Products</span>
                </a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                    <i data-feather='list'></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Shop Deals</span>
                </a>
            </li>
{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="#">--}}
{{--                    <i data-feather='shopping-bag'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Dashboards">Orders</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="#">--}}
{{--                    <i data-feather='mail'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Dashboards">Communication</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="#">--}}
{{--                    <i data-feather='shopping-cart'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Dashboards">Shipping Schedule</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="#">--}}
{{--                    <i data-feather='settings'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Dashboards">Settings</span>--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>
    @else
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                <i data-feather="home"></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('my.wallet') }}">
                <i data-feather='trello'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">My Wallet</span>
            </a>
        </li>
        <li class=" navigation-header">
            <span data-i18n="Apps &amp; Pages">Inventory</span>
            <i data-feather="more-horizontal"></i>
        </li>

        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('shops') }}">
                <i data-feather='trello'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Shops</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('batch.shipping') }}">
                <i data-feather='trello'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Shipping</span>
            </a>
        </li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('riders') }}">
                <i data-feather='trello'></i>
                <span class="menu-title text-truncate" data-i18n="Dashboards">Riders</span>
            </a>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i data-feather="file-text"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">User Management</span>
            </a>
            <ul class="menu-content">

                <li>
                    <a class="d-flex align-items-center" href="{{ route('merchant.roles') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Roles</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center" href="{{ route('merchant.users') }}">
                        <i data-feather="users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">Users</span>
                    </a>
                </li>

            </ul>
        </li>

    </ul>
    @endif
@endif


