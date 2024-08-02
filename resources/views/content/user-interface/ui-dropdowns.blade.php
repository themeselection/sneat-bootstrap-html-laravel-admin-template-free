@extends('layouts/contentNavbarLayout')

@section('title', 'Dropdowns - UI elements')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">UI elements /</span> Dropdowns
</h4>

<div class="card mb-4" id="btn-dropdown-demo">
  <h5 class="card-header">Dropdowns</h5>

  <!-- Basic Dropdowns -->
  <div class="card-body">
    <small class="text-light fw-medium">Basic</small>
    <div class="demo-inline-spacing">
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Primary</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item disabled" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Secondary</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Success</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Danger</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Warning</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Info</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Basic Dropdowns -->
  <hr class="m-0">

  <!-- Outline Dropdowns -->
  <div class="card-body">
    <small class="text-light fw-medium">Outline</small>
    <div class="demo-inline-spacing">
      <div class="btn-group">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Primary</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Secondary</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Success</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Danger</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-outline-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Warning</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Info</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Basic Dropdowns -->
  <hr class="m-0">
  <!-- Split Dropdowns -->
  <div class="card-body">
    <small class="text-light fw-medium">Split</small>
    <div class="demo-inline-spacing">
      <div class="btn-group">
        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-secondary">Secondary</button>
        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Split Dropdowns -->

  <hr class="m-0">

  <div class="card-body">
    <div class="row gy-3">
      <!-- Hidden Arrow Dropdowns -->
      <div class="col-lg-3 col-sm-6 col-12">
        <small class="text-light fw-medium">Hidden arrow</small>
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">Hidden arrow </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Hidden Arrow Dropdowns -->
      <!-- Dropdown with icon -->
      <div class="col-lg-3 col-sm-6 col-12">
        <small class="text-light fw-medium">With Icon</small>
        <div class="demo-inline-spacing">
          <div class="btn-group" id="dropdown-icon-demo">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-menu me-1"></i> With Icon</button>
            <ul class="dropdown-menu">
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Action</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Another action</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Separated link</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Dropdown with icon -->
      <!-- Icon Dropdown -->
      <div class="col-lg-3 col-sm-6 col-12">
        <small class="text-light fw-medium">Icon Dropdown</small>
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Icon Dropdown -->
    </div>
  </div>

</div>


<!-- Dropdown Variations -->
<div class="card" id="dropdown-variation-demo">
  <h5 class="card-header">Dropdown Variations</h5>

  <!-- Dropdown Menu Alignment -->
  <div class="card-body">
    <small class="text-light fw-medium">Menu Alignment</small>
    <div class="demo-inline-spacing">
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          End-aligned dropdown menu
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><button class="dropdown-item" type="button">Action</button></li>
          <li><button class="dropdown-item" type="button">Another action</button></li>
          <li><button class="dropdown-item" type="button">Something else here</button></li>
        </ul>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
          Start-aligned but end-aligned when lg screen
        </button>
        <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
          <li><button class="dropdown-item" type="button">Action</button></li>
          <li><button class="dropdown-item" type="button">Another action</button></li>
          <li><button class="dropdown-item" type="button">Something else here</button></li>
        </ul>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle overflow-hidden d-sm-inline-flex d-block text-truncate" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
          End-aligned but start-aligned when lg screen
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
          <li><button class="dropdown-item" type="button">Action</button></li>
          <li><button class="dropdown-item" type="button">Another action</button></li>
          <li><button class="dropdown-item" type="button">Something else here</button></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Dropdown Menu Alignment -->

  <hr class="m-0">
  <!-- Dropdown Sizes -->

  <div class="card-body">
    <small class="text-light fw-medium">Sizes</small>
    <div class="demo-inline-spacing">
      <div class="btn-group">
        <button class="btn btn-primary btn-xl dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Extra large
          button</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Large
          button</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Small
          button</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Extra small
          button</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Dropdown Sizes -->

  <hr class="m-0">
  <div class="card-body">
    <div class="row gy-3">
      <!-- Dropdown Directions -->
      <div class="col-xl-6">
        <small class="text-light fw-medium">Directions</small>
        <div class="row">
          <div class="col-md-6">
            <div class="demo-inline-spacing">
              <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="demo-inline-spacing">
              <div class="btn-group dropup">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropup
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="demo-inline-spacing">
              <div class="btn-group dropend">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropend</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="demo-inline-spacing">
              <div class="btn-group dropstart">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropstart</button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Dropdown Directions -->
      <!-- Dropdown menu content -->
      <div class="col-xl-6">
        <small class="text-light fw-medium">Menu Content</small>
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown Header
            </button>
            <ul class="dropdown-menu">
              <li>
                <h6 class="dropdown-header text-uppercase">Dropdown header</h6>
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Divider
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Text
            </button>
            <div class="dropdown-menu">
              <div class="px-3 py-2 text-muted">
                <p>
                  Some example text that's free-flowing within the dropdown menu.
                </p>
                <p class="mb-0">
                  And this is more example text.
                </p>
              </div>
            </div>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Forms
            </button>
            <div class="dropdown-menu dropdown-menu-end w-px-300">
              <form class="p-4" onsubmit="return false">
                <div class="mb-3">
                  <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                  <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                    <label class="form-check-label" for="dropdownCheck"> Remember me </label>
                  </div>
                </div>
                <button type="button" class="btn btn-primary">Sign in</button>
              </form>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void(0)">New around here? Sign up</a>
              <a class="dropdown-item" href="javascript:void(0)">Forgot password?</a>
            </div>
          </div>
        </div>
      </div>
      <!--/ Dropdown menu content -->
    </div>
  </div>

  <hr class="m-0">
  <div class="card-body">
    <div class="row gy-3">
      <!-- Dropdown options -->
      <div class="col-xl-6">
        <small class="text-light fw-medium">Options : Use <code>data-bs-offset</code> or <code>data-bs-reference</code> to change the location of the dropdown.</small>
        <div class="demo-inline-spacing">
          <div class="btn-group me-1">
            <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
              Offset
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
              <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-primary">Reference</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
              <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
              <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="javascript:void(0)">Separated link</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Dropdown options -->
      <!-- Auto close behavior -->
      <div class="col-xl-6">
        <small class="text-light fw-medium">Auto close behavior</small>
        <div class="demo-inline-spacing">
          <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"> Default </button>
            <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false"> Clickable outside </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"> Clickable inside </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false"> Manual close </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickable">
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
              <li><a class="dropdown-item" href="javascript:void(0)">Menu item</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Auto close behavior -->
    </div>
  </div>

</div>
<!--/ Dropdown Variations -->
@endsection
