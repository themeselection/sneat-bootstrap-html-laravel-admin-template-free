@extends('layouts/contentNavbarLayout')

@section('title', 'Input groups - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Input groups</h4>

<div class="row">
  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Basic</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group">
          <span class="input-group-text" id="basic-addon11">@</span>
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon11" />
        </div>

        <div class="form-password-toggle">
          <label class="form-label" for="basic-default-password12">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="basic-default-password12" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password2" />
            <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon13" />
          <span class="input-group-text" id="basic-addon13">@example.com</span>
        </div>

        <div class="input-group">
          <span class="input-group-text" id="basic-addon14">https://example.com/users/</span>
          <input type="text" class="form-control" placeholder="URL" id="basic-url1" aria-describedby="basic-addon14" />
        </div>

        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="text" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)" />
          <span class="input-group-text">.00</span>
        </div>

        <div class="input-group">
          <span class="input-group-text">With textarea</span>
          <textarea class="form-control" aria-label="With textarea" placeholder="Comment"></textarea>
        </div>

      </div>
    </div>
  </div>

  <!-- Merged -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Merged</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group input-group-merge">
          <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
          <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>

        <div class="form-password-toggle">
          <label class="form-label" for="basic-default-password32">Password</label>
          <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="basic-default-password32" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password" />
            <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
          </div>
        </div>

        <div class="input-group input-group-merge">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon33" />
          <span class="input-group-text" id="basic-addon33">@example.com</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text" id="basic-addon34">https://example.com/users/</span>
          <input type="text" class="form-control" id="basic-url3" aria-describedby="basic-addon34" />
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">$</span>
          <input type="text" class="form-control" placeholder="100" aria-label="Amount (to the nearest dollar)" />
          <span class="input-group-text">.00</span>
        </div>

        <div class="input-group input-group-merge">
          <span class="input-group-text">With textarea</span>
          <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>

      </div>
    </div>
  </div>

  <!-- Sizing -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Sizing</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group input-group-lg">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

        <div class="input-group input-group-sm">
          <span class="input-group-text">@</span>
          <input type="text" class="form-control" placeholder="Username" />
        </div>

      </div>
    </div>
  </div>
  <!-- Checkbox and radio addons -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Checkbox and radio addons</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group">
          <div class="input-group-text">
            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
          </div>
          <input type="text" class="form-control" aria-label="Text input with checkbox">
        </div>

        <div class="input-group">
          <div class="input-group-text">
            <input class="form-check-input mt-0" type="radio" value="" aria-label="Radio button for following text input">
          </div>
          <input type="text" class="form-control" aria-label="Text input with radio button">
        </div>

      </div>
    </div>

  </div>
</div>


<div class="row">
  <!-- Multiple inputs & addon -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Multiple inputs & addon</h5>

      <div class="card-body demo-vertical-spacing demo-only-element">
        <small class="text-light fw-semibold d-block">Multiple inputs</small>
        <div class="input-group">
          <span class="input-group-text">First and last name</span>
          <input type="text" aria-label="First name" class="form-control">
          <input type="text" aria-label="Last name" class="form-control">
        </div>

        <small class="text-light fw-semibold d-block pt-3">Multiple addons</small>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <span class="input-group-text">0.00</span>
          <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
          <span class="input-group-text">$</span>
          <span class="input-group-text">0.00</span>
        </div>
      </div>

    </div>
  </div>
  <!-- Speech To Text -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Speech To Text</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <small class="text-light fw-semibold d-block">Input Group</small>

        <div class="input-group input-group-merge speech-to-text">
          <input type="text" class="form-control" placeholder="Say it" aria-describedby="text-to-speech-addon">
          <span class="input-group-text" id="text-to-speech-addon">
            <i class='bx bx-microphone cursor-pointer text-to-speech-toggle'></i>
          </span>
        </div>

        <small class="text-light fw-semibold d-block pt-3">Textarea</small>

        <div class="input-group input-group-merge speech-to-text">
          <textarea class="form-control" placeholder="Say it" rows="2"></textarea>
          <span class="input-group-text">
            <i class='bx bx-microphone cursor-pointer text-to-speech-toggle'></i>
          </span>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Button with dropdowns & addons -->
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Button with dropdowns & addons</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <small class="text-light fw-semibold d-block">Button addons</small>
        <div class="input-group">
          <button class="btn btn-outline-primary" type="button" id="button-addon1">Button</button>
          <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-primary" type="button" id="button-addon2">Button</button>
        </div>

        <div class="input-group">
          <button class="btn btn-outline-primary" type="button">Button</button>
          <button class="btn btn-outline-primary" type="button">Button</button>
          <input type="text" class="form-control" placeholder="" aria-label="Example text with two button addons">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">
          <button class="btn btn-outline-primary" type="button">Button</button>
          <button class="btn btn-outline-primary" type="button">Button</button>
        </div>

        <small class="text-light fw-semibold d-block pt-3">Button with dropdowns</small>
        <div class="input-group">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
        </div>

        <div class="input-group">
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
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

        <div class="input-group">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);">Action before</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Another action before</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
          </ul>
          <input type="text" class="form-control" aria-label="Text input with 2 dropdown buttons">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
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
  </div>

  <div class="col-md-6">

    <!-- Segmented buttons -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Segmented buttons</h5>
          <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="input-group">
              <button type="button" class="btn btn-outline-primary">Action</button>
              <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
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
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
            </div>

            <div class="input-group">
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
              <button type="button" class="btn btn-outline-primary">Action</button>
              <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
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
      </div>
    </div>

    <!-- Custom select -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Custom select</h5>
          <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="input-group">
              <label class="input-group-text" for="inputGroupSelect01">Options</label>
              <select class="form-select" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="input-group">
              <select class="form-select" id="inputGroupSelect02">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <label class="input-group-text" for="inputGroupSelect02">Options</label>
            </div>

            <div class="input-group">
              <button class="btn btn-outline-primary" type="button">Button</button>
              <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="input-group">
              <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <button class="btn btn-outline-primary" type="button">Button</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Custom file input -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">Custom file input</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <label class="input-group-text" for="inputGroupFile01">Upload</label>
          <input type="file" class="form-control" id="inputGroupFile01">
        </div>

        <div class="input-group">
          <input type="file" class="form-control" id="inputGroupFile02">
          <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>

        <div class="input-group">
          <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon03">Button</button>
          <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        </div>

        <div class="input-group">
          <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
          <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Button</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
