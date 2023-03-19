<div>
    <a href="{{ route('cart') }}" class="widget-header mr-2">

        <div class="icon">
            <i class="icon-sm rounded-circle border fa fa-shopping-cart"></i>
            <span class="notify">{{ \Darryldecode\Cart\Facades\CartFacade::session(session()->getId())->getContent()->count() }}</span>
        </div>
    </a>


    <a href="#" class="widget-header mr-2">
        <div class="icon">
            <i class="icon-sm rounded-circle border fa fa-heart"></i>
        </div>
    </a>

    @guest
        <div class="widget-header dropdown">
            <a href="#" data-toggle="dropdown" data-offset="20,10">
                <div class="icontext">
                    <div class="icon">
                        <i class="icon-sm rounded-circle border fa fa-user"></i>
                    </div>
                    <div class="text">
                        <small class="text-muted">Sign in | Join</small>
                        <div>My account <i class="fa fa-caret-down"></i> </div>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
               <livewire:user-login/>
            </div>
        </div>
    @else
        <div class="widget-header dropdown">
            <a href="#" data-toggle="dropdown" data-offset="20,10">
                {{ __('Wellcome') }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <a class="dropdown-item " href="{{ route('dashboard') }}">
                    {{ __('Dashboard') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>

            </div>
        </div>
    @endguest


</div>
