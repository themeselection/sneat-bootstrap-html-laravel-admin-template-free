@extends('layouts/contentNavbarLayout')

@section('title', 'Alerts - UI elements')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">UI elements /</span> Alerts
</h4>
<div class="row mb-4">
  <!-- Basic Alerts -->
  <div class="col-md mb-4 mb-md-0">
    <div class="card">
      <h5 class="card-header">Basic Alerts</h5>
      <div class="card-body">
        <div class="alert alert-primary" role="alert">
          This is a primary alert — check it out!
        </div>

        <div class="alert alert-secondary" role="alert">
          This is a secondary alert — check it out!
        </div>

        <div class="alert alert-success" role="alert">
          This is a success alert — check it out!
        </div>

        <div class="alert alert-danger" role="alert">
          This is a danger alert — check it out!
        </div>

        <div class="alert alert-warning" role="alert">
          This is a warning alert — check it out!
        </div>

        <div class="alert alert-info" role="alert">
          This is an info alert — check it out!
        </div>

        <div class="alert alert-dark mb-0" role="alert">
          This is a dark alert — check it out!
        </div>
      </div>
    </div>
  </div>
  <!--/ Basic Alerts -->
  <!-- Dismissible Alerts -->
  <div class="col-md">
    <div class="card">
      <h5 class="card-header">Dismissible Alerts</h5>
      <div class="card-body">
        <div class="alert alert-primary alert-dismissible" role="alert">
          This is a primary dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-secondary alert-dismissible" role="alert">
          This is a secondary dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-success alert-dismissible" role="alert">
          This is a success dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-danger alert-dismissible" role="alert">
          This is a danger dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-warning alert-dismissible" role="alert">
          This is a warning dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-info alert-dismissible" role="alert">
          This is an info dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>

        <div class="alert alert-dark alert-dismissible mb-0" role="alert">
          This is a dark dismissible alert — check it out!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>
      </div>
    </div>
  </div>
  <!--/ Dismissible Alerts -->
</div>
@endsection
