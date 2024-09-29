@extends('layouts/contentNavbarLayout')

@section('title', 'Badges - UI elements')

@section('content')
<div class="row g-6 mb-6">
  <!-- Basic Badges -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Basic Badges</h5>
      <div class="card-body">
        <div class="text-light small fw-medium">Default</div>
        <div class="demo-inline-spacing">
          <span class="badge bg-primary">Primary</span>
          <span class="badge bg-secondary">Secondary</span>
          <span class="badge bg-success">Success</span>
          <span class="badge bg-danger">Danger</span>
          <span class="badge bg-warning">Warning</span>
          <span class="badge bg-info">Info</span>
          <span class="badge bg-dark">Dark</span>
        </div>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <div class="text-light small fw-medium">Pills</div>

        <div class="demo-inline-spacing">
          <span class="badge rounded-pill bg-primary">Primary</span>
          <span class="badge rounded-pill bg-secondary">Secondary</span>
          <span class="badge rounded-pill bg-success">Success</span>
          <span class="badge rounded-pill bg-danger">Danger</span>
          <span class="badge rounded-pill bg-warning">Warning</span>
          <span class="badge rounded-pill bg-info">Info</span>
          <span class="badge rounded-pill bg-dark">Dark</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Label Badges -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header">Label Badges</h5>
      <div class="card-body">
        <div class="text-light small fw-medium">Label Default</div>

        <div class="demo-inline-spacing">
          <span class="badge bg-label-primary">Primary</span>
          <span class="badge bg-label-secondary">Secondary</span>
          <span class="badge bg-label-success">Success</span>
          <span class="badge bg-label-danger">Danger</span>
          <span class="badge bg-label-warning">Warning</span>
          <span class="badge bg-label-info">Info</span>
          <span class="badge bg-label-dark">Dark</span>
        </div>
      </div>
      <hr class="m-0" />
      <div class="card-body">
        <div class="text-light small fw-medium">Label Pills</div>

        <div class="demo-inline-spacing">
          <span class="badge rounded-pill bg-label-primary">Primary</span>
          <span class="badge rounded-pill bg-label-secondary">Secondary</span>
          <span class="badge rounded-pill bg-label-success">Success</span>
          <span class="badge rounded-pill bg-label-danger">Danger</span>
          <span class="badge rounded-pill bg-label-warning">Warning</span>
          <span class="badge rounded-pill bg-label-info">Info</span>
          <span class="badge rounded-pill bg-label-dark">Dark</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-6">
  <!-- Button with Badges -->
  <div class="col-lg">
    <div class="card">
      <h5 class="card-header"> Button with Badges</h5>
      <div class="card-body">
        <div class="row gy-3">
          <div class="col-sm-4">
            <small class="text-light fw-medium">Default</small>
            <div class="demo-inline-spacing">
              <button type="button" class="btn btn-primary">
                Text
                <span class="badge bg-white text-primary ms-1">4</span>
              </button>
              <button type="button" class="btn btn-secondary">
                Text
                <span class="badge bg-white text-secondary rounded-pill ms-1">4</span>
              </button>
            </div>
          </div>
          <div class="col-sm-4">
            <small class="text-light fw-medium">Outline</small>
            <div class="demo-inline-spacing">
              <button type="button" class="btn btn-outline-primary">
                Text
                <span class="badge ms-1">4</span>
              </button>
              <button type="button" class="btn btn-outline-secondary">
                Text
                <span class="badge rounded-pill ms-1">4</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row gap-6">
  <!-- Badge Circle -->
  <div class="col-12">
    <div class="card">
      <h5 class="card-header"> Badge Circle & Square Style</h5>
      <div class="card-body">
        <div class="row gy-3">
          <div class="col-xl-6">
            <h6>Basic</h6>
            <div class="text-light small fw-medium mb-2">Default</div>
            <div class="demo-inline-spacing">
              <p>
                <span class="badge badge-center rounded-pill bg-primary">1</span>
                <span class="badge badge-center rounded-pill bg-secondary">2</span>
                <span class="badge badge-center rounded-pill bg-success">3</span>
                <span class="badge badge-center rounded-pill bg-danger">4</span>
                <span class="badge badge-center rounded-pill bg-warning">5</span>
                <span class="badge badge-center rounded-pill bg-info">6</span>
              </p>
              <p>
                <span class="badge badge-center bg-primary">1</span>
                <span class="badge badge-center bg-secondary">2</span>
                <span class="badge badge-center bg-success">3</span>
                <span class="badge badge-center bg-danger">4</span>
                <span class="badge badge-center bg-warning">5</span>
                <span class="badge badge-center bg-info">6</span>
              </p>
            </div>
          </div>
          <div class="col-xl-6">
            <h6>Label</h6>
            <div class="text-light small fw-medium mb-2">Default</div>
            <div class="demo-inline-spacing">
              <p>
                <span class="badge badge-center rounded-pill bg-label-primary">1</span>
                <span class="badge badge-center rounded-pill bg-label-secondary">2</span>
                <span class="badge badge-center rounded-pill bg-label-success">3</span>
                <span class="badge badge-center rounded-pill bg-label-danger">4</span>
                <span class="badge badge-center rounded-pill bg-label-warning">5</span>
                <span class="badge badge-center rounded-pill bg-label-info">6</span>
              </p>
              <p>
                <span class="badge badge-center bg-label-primary">1</span>
                <span class="badge badge-center bg-label-secondary">2</span>
                <span class="badge badge-center bg-label-success">3</span>
                <span class="badge badge-center bg-label-danger">4</span>
                <span class="badge badge-center bg-label-warning">5</span>
                <span class="badge badge-center bg-label-info">6</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
