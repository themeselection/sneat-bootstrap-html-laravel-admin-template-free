@extends('layouts/contentNavbarLayout')

@section('title', 'Navbar - UI elements')

@section('content')
<!-- Basic -->
<h5 class="pb-1 mb-6">Example</h5>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-12">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="javascript:void(0)" tabindex="-1">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" onsubmit="return false">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->

<!-- Supported content -->
<h5 class="pb-1 mb-6">Supported content</h5>
<div class="mb-12">
  <h6 class="mt-2 mb-4 text-muted">Text</h6>
  <nav class="navbar navbar-example navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-2" aria-controls="navbar-ex-2" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-ex-2">
        <div class="navbar-nav me-auto">
          <a class="nav-item nav-link active" href="javascript:void(0)">Home</a>
          <a class="nav-item nav-link" href="javascript:void(0)">About</a>
          <a class="nav-item nav-link" href="javascript:void(0)">Contact</a>
        </div>

        <span class="navbar-text">Marshmallow brownie lemon drops cheesecake.</span>
      </div>
    </div>
  </nav>

  <h6 class="mt-6 mb-4 text-muted">Input Group</h6>
  <nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-4">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-ex-4">
        <div class="navbar-nav me-auto">
          <a class="nav-item nav-link active" href="javascript:void(0)">Home</a>
          <a class="nav-item nav-link" href="javascript:void(0)">About</a>
          <a class="nav-item nav-link" href="javascript:void(0)">Contact</a>
        </div>

        <form class="d-flex">
          <div class="input-group">
            <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
            <input type="text" class="form-control" placeholder="Search..." />
          </div>
        </form>
      </div>
    </div>
  </nav>

  <h6 class="mt-6 mb-4 text-muted">Button</h6>
  <nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-ex-3">
        <div class="navbar-nav me-auto">
          <a class="nav-item nav-link active" href="javascript:void(0)">Home</a>
          <a class="nav-item nav-link" href="javascript:void(0)">About</a>
          <a class="nav-item nav-link" href="javascript:void(0)">Contact</a>
        </div>

        <form onsubmit="return false">
          <button class="btn btn-outline-primary" type="button">Buy Now</button>
        </form>
      </div>
    </div>
  </nav>
</div>
<!--/ Supported content -->
@endsection
