<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{ $containerNav }} {{ $navbarDetached }} navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    @include('layouts/sections/navbar/navbar-partial')
</nav>
@else
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{ $containerNav }}">@include('layouts/sections/navbar/navbar-partial')</div>
</nav>
@endif
<!-- / Navbar -->