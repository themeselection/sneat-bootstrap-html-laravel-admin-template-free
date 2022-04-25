@extends('layouts/contentNavbarLayout')

@section('title', 'Navbar - UI elements')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Navbar</h4>

<!-- Basic -->
<h5 class="pb-1 mt-5 mb-4">Example</h5>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
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
<h5 class="pb-1 mb-4">Supported content</h5>
<div class="mb-5">
  <h6 class="mt-2 mb-3 text-muted">Text</h6>
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

  <h6 class="mt-4 mb-3 text-muted">Input Group</h6>
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

  <h6 class="mt-4 mb-3 text-muted">Button</h6>
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

<!-- Mega dropdown -->
<h5 class="pb-1 mb-4">Mega dropdown</h5>

<div class="mb-5">
  <h6 class="mt-2 mb-3 text-muted">Open on click</h6>
  <nav class="navbar navbar-example navbar-expand-lg bg-light" style="z-index: 21">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-14">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-ex-14">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0)">Action</a>
              <a class="dropdown-item" href="javascript:void(0)">Another action</a>
              <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
            </div>
          </li>
          <li class="nav-item mega-dropdown">
            <a class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown" href="javascript:void(0);" aria-expanded="false" data-bs-toggle="mega-dropdown">Mega</a>
            <div class="dropdown-menu px-3 py-0">
              <div class="row row-bordered">
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="m-2 fw-bold">Applications</h6>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-envelope"></i> Email</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-chat"></i> Chat</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-task"></i> ToDos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-calendar"></i> Calender</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link disabled" href="javascript:void(0)" tabindex="-1"><i class="tf-icons bx bx-block"></i> Disabled</a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="m-2 fw-bold">Useful Links</h6>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Profit Margins</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Overall Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Gross Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Net Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Quarterly Profits</a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="my-2 fw-bold">List Group</h6>
                  <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Analytical Reports</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Operational Growth</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Files and Directories</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Audit & Logs</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Customer CRM</a>
                  </div>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <form onsubmit="return false">
                    <div class="mb-3">
                      <label class="form-label" for="exampleDropdownFormEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="exampleDropdownFormPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" />
                    </div>
                    <div class="mb-3">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck" />
                        <label class="form-check-label" for="dropdownCheck">
                          Remember me
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <h6 class="mt-4 mb-3 text-muted">Open on hover</h6>
  <nav class="navbar navbar-example navbar-expand-lg bg-light" style="z-index: 20">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-15">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-ex-15">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" data-trigger="hover">Dropdown</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0)">Action</a>
              <a class="dropdown-item" href="javascript:void(0)">Another action</a>
              <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
            </div>
          </li>
          <li class="nav-item mega-dropdown">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle navbar-ex-15-mega-dropdown mega-dropdown" aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">Mega</a>
            <div class="dropdown-menu px-3 py-0">
              <div class="row row-bordered">
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="m-2 fw-bold">Applications</h6>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-envelope"></i> Email</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-chat"></i> Chat</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-task"></i> ToDos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)"><i class="tf-icons bx bx-calendar"></i> Calender</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link disabled" href="javascript:void(0)" tabindex="-1"><i class="tf-icons bx bx-block"></i> Disabled</a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="m-2 fw-bold">Useful Links</h6>
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Profit Margins</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Overall Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Gross Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Net Profits</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mega-dropdown-link" href="javascript:void(0)">Quarterly Profits</a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <h6 class="my-2 fw-bold">List Group</h6>
                  <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Analytical Reports</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Operational Growth</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Files and Directories</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Audit & Logs</a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action mega-dropdown-link">Customer CRM</a>
                  </div>
                </div>
                <div class="col-sm-6 col-lg p-3">
                  <form onsubmit="return false">
                    <div class="mb-3">
                      <label class="form-label" for="exampleDropdownFormEmail2">Email address</label>
                      <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="exampleDropdownFormPassword2">Password</label>
                      <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password" />
                    </div>
                    <div class="mb-3">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck1" />
                        <label class="form-check-label" for="dropdownCheck1">
                          Remember me
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<!--/ Mega dropdown -->

@endsection
