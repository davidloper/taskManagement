<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/{{ Request::segment(1) }}">{{ navTitle(Request::segment(1)) }}</a>
  @if(navChild(Request::segment(1)))
    <ul class="navbar-nav">
      @foreach(navChild(Request::segment(1)) as $child)
        <li class="nav-item">
          <a class="nav-link {{ $child['url'] == '/'.Request::path()?'active':'' }}" href="{{ $child['url'] }}">{{ $child['title'] }}</a>
        </li>
      @endforeach
    </ul>
  @endif
</nav>