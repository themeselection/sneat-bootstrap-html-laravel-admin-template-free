@extends('layouts/contentNavbarLayout')

@section('title', 'Perfect Scrollbar - Extended UI')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Extended UI /</span> Perfect
  Scrollbar
</h4>

<div class="row">
  <!-- Vertical Scrollbar -->
  <div class="col-md-6 col-sm-12">
    <div class="card overflow-hidden mb-4" style="height: 300px;">
      <h5 class="card-header">Vertical Scrollbar</h5>
      <div class="card-body" id="vertical-example">
        <p>
          Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll
          cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé
          jelly gummi bears lemon drops. Chocolate bar I love macaroon danish
          candy pudding. Jelly carrot cake I love tart cake bear claw macaroon
          candy candy canes. Muffin gingerbread sweet jujubes croissant sweet
          roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love
          croissant. Donut carrot cake ice cream ice cream. Wafer I love pie
          danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate
          marzipan jelly ice cream cake.
        </p>
        <p>
          Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly
          beans sweet icing pudding croissant. Donut candy canes carrot cake
          soufflé. Croissant candy wafer pie I love oat cake lemon drops
          caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet
          roll pudding cookie sweet roll I love. Jelly cake I love bear claw
          jujubes dragée gingerbread. I love cotton candy carrot cake halvah
          biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton
          candy biscuit I love fruitcake cotton candy biscuit tart gingerbread.
          Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I
          love sweet roll ice cream. Toffee cookie macaroon lemon drops tart
          candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.
        </p>
        <p>
          Marzipan oat cake caramels chocolate. Lemon drops cheesecake jelly
          beans sweet icing pudding croissant. Donut candy canes carrot cake
          soufflé. Croissant candy wafer pie I love oat cake lemon drops
          caramels jujubes. I love macaroon halvah liquorice cake. Danish sweet
          roll pudding cookie sweet roll I love. Jelly cake I love bear claw
          jujubes dragée gingerbread. I love cotton candy carrot cake halvah
          biscuit I love macaroon cheesecake tootsie roll. Chocolate cotton
          candy biscuit I love fruitcake cotton candy biscuit tart gingerbread.
          Powder oat cake I love. Cheesecake candy canes macaroon I love wafer I
          love sweet roll ice cream. Toffee cookie macaroon lemon drops tart
          candy canes. Gummies gummies pie tiramisu I love bear claw cheesecake.
        </p>
        <p>
          Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll
          cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé
          jelly gummi bears lemon drops. Chocolate bar I love macaroon danish
          candy pudding. Jelly carrot cake I love tart cake bear claw macaroon
          candy candy canes. Muffin gingerbread sweet jujubes croissant sweet
          roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love
          croissant. Donut carrot cake ice cream ice cream. Wafer I love pie
          danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate
          marzipan jelly ice cream cake.
        </p>
        <p>
          Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll
          cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé
          jelly gummi bears lemon drops. Chocolate bar I love macaroon danish
          candy pudding. Jelly carrot cake I love tart cake bear claw macaroon
          candy candy canes. Muffin gingerbread sweet jujubes croissant sweet
          roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love
          croissant. Donut carrot cake ice cream ice cream. Wafer I love pie
          danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate
          marzipan jelly ice cream cake.
        </p>
        <p>
          Sweet roll I love I love. Tiramisu I love soufflé cake tart sweet roll
          cotton candy cookie. Macaroon biscuit dessert. Bonbon cake soufflé
          jelly gummi bears lemon drops. Chocolate bar I love macaroon danish
          candy pudding. Jelly carrot cake I love tart cake bear claw macaroon
          candy candy canes. Muffin gingerbread sweet jujubes croissant sweet
          roll. Topping muffin carrot cake sweet. Toffee chocolate muffin I love
          croissant. Donut carrot cake ice cream ice cream. Wafer I love pie
          danish marshmallow cheesecake oat cake pie I love. Icing pie chocolate
          marzipan jelly ice cream cake.
        </p>
      </div>
    </div>
  </div>
  <!--/ Vertical Scrollbar -->

  <!-- Horizontal Scrollbar -->
  <div class="col-md-6 col-sm-12">
    <div class="card overflow-hidden mb-4" style="height: 300px;">
      <h5 class="card-header">Horizontal Scrollbar</h5>
      <div class="card-body" id="horizontal-example">
        <img src="{{asset('assets/img/backgrounds/18.jpg')}}" alt="scrollbar-image" />
      </div>
    </div>
  </div>
  <!--/ Horizontal Scrollbar -->

  <!-- Vertical & Horizontal Scrollbars -->
  <div class="col-12">
    <div class="card overflow-hidden" style="height: 500px;">
      <h5 class="card-header">Vertical & Horizontal Scrollbars</h5>
      <div class="card-body" id="both-scrollbars-example">
        <img src="{{asset('assets/img/backgrounds/18.jpg')}}" alt="scrollbar-image" />
      </div>
    </div>
  </div>
  <!--/ Vertical & Horizontal Scrollbars -->
</div>
@endsection
