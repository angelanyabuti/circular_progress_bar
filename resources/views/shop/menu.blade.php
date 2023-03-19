
<li class="nav-item">
    <a class="nav-link" href="{{ route('market') }}">{{ __('Home') }}</a>
</li>

@foreach(\App\Helpers\MainHelper::categories() as $category)
    @if($category -> children() -> count() == 0)
        <li class="nav-item">
            <a class="nav-link " href="{{ route('market.category', $category->slug) }}" id="topnav-dashboards">
                {{ $category->name }}
            </a>
        </li>
    @else
        <li class="nav-item dropdown ml-2">
            <a class="nav-link dropdown-toggle" href="{{ route('market.category', $category->slug) }}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $category->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('market.category', $category->slug) }}">
                    {{ $category->name }}
                </a>
            @foreach($category->children() as $cats)
                    <a class="dropdown-item" href="{{ route('market.category', $cats->slug) }}">{{ $cats -> name }}</a>
                @endforeach
            </div>
        </li>
  @endif
@endforeach

