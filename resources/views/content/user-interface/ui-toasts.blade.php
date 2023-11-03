@extends('layouts/contentNavbarLayout')

@section('title', 'Toasts - UI elements')

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Toasts</h4>


<!-- Toast with Placements -->
<div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-medium">Bootstrap</div>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
  </div>
</div>
<!-- Toast with Placements -->

<!-- Bootstrap Toasts with Placement -->
<div class="card mb-4">
  <h5 class="card-header">Bootstrap Toasts Example With Placement</h5>
  <div class="card-body">
    <div class="row gx-3 gy-2 align-items-center">
      <div class="col-md-3">
        <label class="form-label" for="selectTypeOpt">Type</label>
        <select id="selectTypeOpt" class="form-select color-dropdown">
          <option value="bg-primary" selected>Primary</option>
          <option value="bg-secondary">Secondary</option>
          <option value="bg-success">Success</option>
          <option value="bg-danger">Danger</option>
          <option value="bg-warning">Warning</option>
          <option value="bg-info">Info</option>
          <option value="bg-dark">Dark</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="selectPlacement">Placement</label>
        <select class="form-select placement-dropdown" id="selectPlacement">
          <option value="top-0 start-0">Top left</option>
          <option value="top-0 start-50 translate-middle-x">Top center</option>
          <option value="top-0 end-0">Top right</option>
          <option value="top-50 start-0 translate-middle-y">Middle left</option>
          <option value="top-50 start-50 translate-middle">Middle center</option>
          <option value="top-50 end-0 translate-middle-y">Middle right</option>
          <option value="bottom-0 start-0">Bottom left</option>
          <option value="bottom-0 start-50 translate-middle-x">Bottom center</option>
          <option value="bottom-0 end-0">Bottom right</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="showToastPlacement">&nbsp;</label>
        <button id="showToastPlacement" class="btn btn-primary d-block">Show Toast</button>
      </div>
    </div>
  </div>
</div>
<!--/ Bootstrap Toasts with Placement -->

<!-- Bootstrap Toasts Styles -->
<div class="card mb-4">
  <h5 class="card-header">Bootstrap Toasts Styles</h5>
  <div class="row g-0">
    <div class="col-md-6 p-4">
      <div class="text-light small fw-medium mb-3">Default</div>
      <div class="toast-container position-relative">

        <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-info" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 ui-bg-overlay-container p-4">
      <div class="ui-bg-overlay bg-dark rounded-end-bottom"></div>
      <div class="text-white small fw-medium mb-3">Translucent</div>

      <div class="toast-container position-relative">
        <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-info" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>

        <div class="bs-toast toast fade show bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-medium">Bootstrap</div>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Bootstrap Toasts Styles -->
@endsection
