@include('includes.header')
@include('navbars.navbar')
@yield('toggleBar')
@component('layouts.header_footer_component')
@yield('content')
@endcomponent
