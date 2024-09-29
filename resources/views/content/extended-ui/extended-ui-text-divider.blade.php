@extends('layouts/contentNavbarLayout')

@section('title', 'Text Divider - Extended UI')

@section('content')
<div class="row">
  <!-- Basic -->
  <div class="col-md-12 mb-6">
    <div class="card">
      <h5 class="card-header">Basic</h5>
      <div class="card-body">
        <div class="divider">
          <div class="divider-text">Text</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Basic -->

  <!-- Text Alignment -->
  <div class="col-md-12 mb-6">
    <div class="card">
      <h5 class="card-header">Alignment</h5>
      <div class="card-body">
        <div class="divider text-start">
          <div class="divider-text">Start</div>
        </div>
        <div class="divider text-start-center">
          <div class="divider-text">Start-Center</div>
        </div>
        <div class="divider">
          <div class="divider-text">Center (Default)</div>
        </div>
        <div class="divider text-end-center">
          <div class="divider-text">End-Center</div>
        </div>
        <div class="divider text-end">
          <div class="divider-text">End</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Text Alignment -->

  <!-- Divider Colors -->
  <div class="col-md-12 mb-6">
    <div class="card">
      <h5 class="card-header">Colors</h5>
      <div class="card-body">
        <div class="divider divider-primary">
          <div class="divider-text">Primary</div>
        </div>
        <div class="divider divider-success">
          <div class="divider-text">Success</div>
        </div>
        <div class="divider divider-danger">
          <div class="divider-text">Danger</div>
        </div>
        <div class="divider divider-warning">
          <div class="divider-text">Warning</div>
        </div>
        <div class="divider divider-info">
          <div class="divider-text">Info</div>
        </div>
        <div class="divider divider-dark">
          <div class="divider-text">Dark</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Divider Colors -->

  <!-- Icons -->
  <div class="col-md-12 mb-6">
    <div class="card">
      <h5 class="card-header">Icons</h5>
      <div class="card-body">
        <div class="divider text-start">
          <div class="divider-text">
            <i class="bx bx-sun"></i>
          </div>
        </div>
        <div class="divider text-start-center">
          <div class="divider-text">
            <i class="bx bx-crown"></i>
          </div>
        </div>
        <div class="divider">
          <div class="divider-text">
            <i class="bx bx-star"></i>
          </div>
        </div>
        <div class="divider text-end-center">
          <div class="divider-text">
            <i class="bx bx-coffee-togo"></i>
          </div>
        </div>
        <div class="divider text-end">
          <div class="divider-text">
            <i class="bx bx-cut bx-rotate-180"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Icons -->

  <!-- Icons -->
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Styles</h5>
      <div class="card-body">
        <div class="divider">
          <div class="divider-text">
            Solid (Default)
          </div>
        </div>
        <div class="divider divider-dotted">
          <div class="divider-text">
            Dotted
          </div>
        </div>
        <div class="divider divider-dashed">
          <div class="divider-text">
            Dashed
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Icons -->
</div>
@endsection
