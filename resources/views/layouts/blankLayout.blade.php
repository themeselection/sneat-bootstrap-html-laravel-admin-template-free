@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset


@extends('layouts/commonMaster')

@section('layoutContent')
<!-- Content -->
@yield('content')
<!--/ Content -->
@endsection
