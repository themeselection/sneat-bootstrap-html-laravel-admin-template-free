@extends('layouts/blankLayout')

@section('title', 'Error - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection


@section('content')
<!-- Error -->
<div class="container-xxl container-p-y">
  <div class="misc-wrapper">
    <h2 class="mb-2 mx-2">Page Not Found :(</h2>
    <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
    <a href="{{url('/')}}" class="btn btn-primary">Back to home</a>
    <div class="mt-3">
      <img src="{{asset('assets/img/illustrations/page-misc-error-light.png')}}" alt="page-misc-error-light" width="500" class="img-fluid">
    </div>
  </div>
</div>
<!-- /Error -->
@endsection
