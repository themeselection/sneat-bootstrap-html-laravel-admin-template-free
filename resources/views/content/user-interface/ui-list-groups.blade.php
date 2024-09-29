@extends('layouts/contentNavbarLayout')

@section('title', 'List groups - UI elements')

@section('content')
<div class="card mb-6">
  <h5 class="card-header">List groups</h5>
  <div class="card-body">
    <div class="row">
      <!-- Basic List group -->
      <div class="col-lg-6 mb-6 mb-xl-0">
        <small class="text-light fw-medium">Basic</small>
        <div class="mt-4">
          <div class="list-group">
            <a href="javascript:void(0);" class="list-group-item list-group-item-action active">Bear claw cake biscuit</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Soufflé pastry pie ice</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action disabled">Tart tiramisu cake</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Bonbon toffee muffin</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Dragée tootsie roll</a>
          </div>
        </div>
      </div>
      <!--/ Basic List group -->
      <!-- List group with Badges & Pills -->
      <div class="col-lg-6">
        <small class="text-light fw-medium">With Bagdes & Pills</small>
        <div class="mt-4">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">Soufflé
              pastry pie ice
              <span class="badge badge-center bg-primary">5</span>
            </li>
            <li class="list-group-item disabled">Bear claw cake biscuit</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Tart
              tiramisu cake
              <span class="badge badge-center bg-success">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Bonbon
              toffee muffin
              <span class="badge badge-center bg-danger rounded-pill">3</span>
            </li>
            <li class="list-group-item">Dragée tootsie roll</li>
          </ul>
        </div>
      </div>
      <!--/ List group with Badges & Pills -->
    </div>
  </div>
  <hr class="m-0">
  <div class="card-body">
    <div class="row">
      <!-- List group Flush (Without main border) -->
      <div class="col-lg-6 mb-6 mb-xl-0">
        <small class="text-light fw-medium">Flush</small>
        <div class="mt-4">
          <div class="list-group list-group-flush">
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Bear claw cake biscuit</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Soufflé pastry pie ice</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Tart tiramisu cake</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Bonbon toffee muffin</a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action">Dragée tootsie roll</a>
          </div>
        </div>
      </div>
      <!--/ List group Flush (Without main border) -->
      <!-- List group Icons -->
      <div class="col-lg-6">
        <small class="text-light fw-medium">With Icons</small>
        <div class="mt-4">
          <ul class="list-group">
            <li class="list-group-item d-flex align-items-center">
              <i class="bx bx-tv me-3"></i>
              Soufflé pastry pie ice
            </li>
            <li class="list-group-item d-flex align-items-center">
              <i class="bx bx-bell me-3"></i>
              Bear claw cake biscuit
            </li>
            <li class="list-group-item d-flex align-items-center">
              <i class="bx bx-support me-3"></i>
              Tart tiramisu cake
            </li>
            <li class="list-group-item d-flex align-items-center">
              <i class="bx bx-purchase-tag-alt me-3"></i>
              Bonbon toffee muffin
            </li>
            <li class="list-group-item d-flex align-items-center">
              <i class="bx bx-closet me-3"></i>
              Dragée tootsie roll
            </li>
          </ul>
        </div>
      </div>
      <!--/ List group Icons -->
    </div>
  </div>
  <hr class="m-0">
  <div class="card-body">
    <div class="row">
      <!-- List group Numbered -->
      <div class="col-lg-6 mb-6 mb-xl-0">
        <small class="text-light fw-medium">Numbered</small>
        <div class="mt-4">
          <ol class="list-group list-group-numbered">
            <li class="list-group-item">Bear claw cake biscuit</li>
            <li class="list-group-item">Soufflé pastry pie ice</li>
            <li class="list-group-item">Tart tiramisu cake</li>
            <li class="list-group-item">Bonbon toffee muffin</li>
            <li class="list-group-item">Dragée tootsie roll</li>
          </ol>
        </div>
      </div>
      <!--/ List group Numbered -->
      <!-- List group checkbox -->
      <div class="col-lg-6">
        <small class="text-light fw-medium">List Group With Checkbox</small>
        <div class="mt-4">
          <div class="list-group">
            <label class="list-group-item">
              <input class="form-check-input me-3" type="checkbox" value="">
              Soufflé pastry pie ice
            </label>
            <label class="list-group-item">
              <input class="form-check-input me-3" type="checkbox" value="">
              Bear claw cake biscuit
            </label>
            <label class="list-group-item">
              <input class="form-check-input me-3" type="checkbox" value="">
              Tart tiramisu cake
            </label>
            <label class="list-group-item">
              <input class="form-check-input me-3" type="checkbox" value="">
              Bonbon toffee muffin
            </label>
            <label class="list-group-item">
              <input class="form-check-input me-3" type="checkbox" value="">
              Dragée tootsie roll
            </label>
          </div>
        </div>
      </div>
      <!--/ List group checkbox -->
    </div>
  </div>
  <hr class="m-0">
  <div class="card-body">
    <div class="row">
      <!-- Contextual List group -->
      <div class="col-lg-6 mb-6 mb-xl-0">
        <small class="text-light fw-medium">Contextual classes</small>
        <div class="mt-4">
          <ul class="list-group">
            <li class="list-group-item list-group-item-primary">Primary list group item</li>
            <li class="list-group-item list-group-item-secondary">Secondary list group item</li>
            <li class="list-group-item list-group-item-success">Success list group item</li>
            <li class="list-group-item list-group-item-danger">Danger list group item</li>
            <li class="list-group-item list-group-item-warning">Warning list group item</li>
            <li class="list-group-item list-group-item-info">Info list group item</li>
            <li class="list-group-item list-group-item-dark">Dark list group item</li>
          </ul>
        </div>
      </div>
      <!--/ Contextual List group -->
      <!-- Custom content with heading -->
      <div class="col-lg-6">
        <small class="text-light fw-medium">Custom content</small>
        <div class="mt-4">
          <div class="list-group">
            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start active">
              <div class="d-flex justify-content-between w-100">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
              </div>
              <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              <small>Donec id elit non mi porta.</small>
            </a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex justify-content-between w-100">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex justify-content-between w-100">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
              <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
          </div>
        </div>
      </div>
      <!--/ Custom content with heading -->
    </div>
  </div>
</div>

<div class="card mb-6">
  <h5 class="card-header">Javascript behavior</h5>
  <div class="card-body">
    <div class="row">
      <!-- Custom content with heading -->
      <div class="col-lg-6 mb-6 mb-xl-0">
        <small class="text-light fw-medium">Vertical</small>
        <div class="mt-4">
          <div class="row">
            <div class="col-md-4 col-12 mb-6 mb-md-0">
              <div class="list-group">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home">Home</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile">Profile</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages">Messages</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings">Settings</a>
              </div>
            </div>
            <div class="col-md-8 col-12">
              <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="list-home">
                  Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah gummi bears
                  cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread halvah marshmallow pudding
                  bear claw cheesecake. Bonbon dragée cookie gummies. Pudding marzipan liquorice. Sugar plum dragée
                  cupcake cupcake cake dessert chocolate bar. Pastry lollipop lemon drops lollipop halvah croissant.
                  Pastry sweet gingerbread lemon drops topping ice cream.
                </div>
                <div class="tab-pane fade" id="list-profile">
                  Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream
                  powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake
                  bonbon jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear
                  claw liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar
                  plum wafer gummi bears fruitcake.
                </div>
                <div class="tab-pane fade" id="list-messages">
                  Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate chupa chups
                  tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake chocolate macaroon. Halvah
                  jelly jelly beans cake macaroon jelly-o. Danish pastry dessert gingerbread powder halvah. Muffin bonbon
                  fruitcake dragée sweet sesame snaps oat cake marshmallow cheesecake. Cupcake donut sweet bonbon
                  cheesecake soufflé chocolate bar.
                </div>
                <div class="tab-pane fade" id="list-settings">
                  Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o
                  muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping
                  chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart
                  bonbon sweet roll soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee
                  pudding. Tiramisu powder macaroon tiramisu cake halvah.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <small class="text-light fw-medium">Horizontal</small>
        <div class="mt-4">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Home</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Profile</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Messages</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-settings">Settings</a>
          </div>
          <div class="tab-content px-0 mt-0">
            <div class="tab-pane fade show active" id="horizontal-home">
              Donut sugar plum sweet roll biscuit. Cake oat cake gummi bears. Tart wafer wafer halvah gummi bears
              cheesecake. Topping croissant cake sweet roll. Dessert fruitcake gingerbread halvah marshmallow pudding bear
              claw cheesecake. Bonbon dragée cookie gummies. Pudding marzipan liquorice. Sugar plum dragée cupcake cupcake
              cake dessert chocolate bar. Pastry lollipop lemon drops lollipop halvah croissant. Pastry sweet gingerbread
              lemon drops topping ice cream.
            </div>
            <div class="tab-pane fade" id="horizontal-profile">
              Muffin lemon drops chocolate chupa chups jelly beans dessert jelly-o. Soufflé gummies gummies. Ice cream
              powder marshmallow cotton candy oat cake wafer. Marshmallow gingerbread tootsie roll. Chocolate cake bonbon
              jelly beans lollipop jelly beans halvah marzipan danish pie. Oat cake chocolate cake pudding bear claw
              liquorice gingerbread icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum
              wafer gummi bears fruitcake.
            </div>
            <div class="tab-pane fade" id="horizontal-messages">
              Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate chupa chups
              tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake chocolate macaroon. Halvah jelly
              jelly beans cake macaroon jelly-o. Danish pastry dessert gingerbread powder halvah. Muffin bonbon fruitcake
              dragée sweet sesame snaps oat cake marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé
              chocolate bar.
            </div>
            <div class="tab-pane fade" id="horizontal-settings">
              Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o. Jelly-o muffin
              macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie cake topping chocolate. Pie
              oat cake jelly. Lemon drops halvah jelly cookie bonbon cake cupcake ice cream. Donut tart bonbon sweet roll
              soufflé gummies biscuit. Wafer toffee topping jelly beans icing pie apple pie toffee pudding. Tiramisu
              powder macaroon tiramisu cake halvah.
            </div>
          </div>
        </div>
      </div>
      <!--/ Custom content with heading -->
    </div>
  </div>
</div>

@endsection
