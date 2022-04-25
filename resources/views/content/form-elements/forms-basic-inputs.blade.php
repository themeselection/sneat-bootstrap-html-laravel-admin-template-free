@extends('layouts/contentNavbarLayout')

@section('title', 'Basic Inputs - Forms')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Forms /</span> Basic Inputs
</h4>

<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Default</h5>
      <div class="card-body">
        <div>
          <label for="defaultFormControlInput" class="form-label">Name</label>
          <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
          <div id="defaultFormControlHelp" class="form-text">We'll never share your details with anyone else.</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Float label</h5>
      <div class="card-body">
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInput" placeholder="John Doe" aria-describedby="floatingInputHelp" />
          <label for="floatingInput">Name</label>
          <div id="floatingInputHelp" class="form-text">We'll never share your details with anyone else.</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Form controls -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Form Controls</h5>
      <div class="card-body">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInput1" class="form-label">Read only</label>
          <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Readonly input here..." readonly />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Read plain</label>
          <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1" value="email@example.com" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect1" class="form-label">Example select</label>
          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleDataList" class="form-label">Datalist example</label>
          <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
          <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
            <option value="Los Angeles">
            <option value="Chicago">
          </datalist>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect2" class="form-label">Example multiple select</label>
          <select multiple class="form-select" id="exampleFormControlSelect2" aria-label="Multiple select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div>
          <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- Input Sizing -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Input Sizing</h5>
      <div class="card-body">
        <small class="text-light fw-semibold">Input text</small>

        <div class="mt-2 mb-3">
          <label for="largeInput" class="form-label">Large input</label>
          <input id="largeInput" class="form-control form-control-lg" type="text" placeholder=".form-control-lg" />
        </div>
        <div class="mb-3">
          <label for="defaultInput" class="form-label">Default input</label>
          <input id="defaultInput" class="form-control" type="text" placeholder="Default input" />
        </div>
        <div>
          <label for="smallInput" class="form-label">Small input</label>
          <input id="smallInput" class="form-control form-control-sm" type="text" placeholder=".form-control-sm" />
        </div>

      </div>
      <hr class="m-0" />
      <div class="card-body">
        <small class="text-light fw-semibold">Input select</small>
        <div class="mt-2 mb-3">
          <label for="largeSelect" class="form-label">Large select</label>
          <select id="largeSelect" class="form-select form-select-lg">
            <option>Large select</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="defaultSelect" class="form-label">Default select</label>
          <select id="defaultSelect" class="form-select">
            <option>Default select</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div>
          <label for="smallSelect" class="form-label">Small select</label>
          <select id="smallSelect" class="form-select form-select-sm">
            <option>Small select</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Default Checkboxes and radios & Default checkboxes and radios -->
  <div class="col-xl-6">

    <div class="card mb-4">
      <h5 class="card-header">Checkboxes and Radios</h5>
      <!-- Checkboxes and Radios -->
      <div class="card-body">
        <div class="row gy-3">
          <div class="col-md">
            <small class="text-light fw-semibold">Checkboxes</small>
            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
              <label class="form-check-label" for="defaultCheck1">
                Unchecked
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" checked />
              <label class="form-check-label" for="defaultCheck2">
                Indeterminate
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked />
              <label class="form-check-label" for="defaultCheck3">
                Checked
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="disabledCheck1" disabled />
              <label class="form-check-label" for="disabledCheck1">
                Disabled Unchecked
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="disabledCheck2" disabled checked />
              <label class="form-check-label" for="disabledCheck2">
                Disabled Checked
              </label>
            </div>
          </div>
          <div class="col-md">
            <small class="text-light fw-semibold">Radio</small>
            <div class="form-check mt-3">
              <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio1" />
              <label class="form-check-label" for="defaultRadio1">
                Unchecked
              </label>
            </div>
            <div class="form-check">
              <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2" checked />
              <label class="form-check-label" for="defaultRadio2">
                Checked
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="" id="disabledRadio1" disabled />
              <label class="form-check-label" for="disabledRadio1">
                Disabled unchecked
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="" id="disabledRadio2" disabled checked />
              <label class="form-check-label" for="disabledRadio2">
                Disabled checkbox
              </label>
            </div>
          </div>
        </div>
      </div>
      <hr class="m-0" />
      <!-- Inline Checkboxes -->
      <div class="card-body">
        <div class="row gy-3">
          <div class="col-md">
            <small class="text-light fw-semibold d-block">Inline Checkboxes</small>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
              <label class="form-check-label" for="inlineCheckbox1">1</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
              <label class="form-check-label" for="inlineCheckbox2">2</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled />
              <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
            </div>
          </div>
          <div class="col-md">
            <small class="text-light fw-semibold d-block">Inline Radio</small>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
              <label class="form-check-label" for="inlineRadio1">1</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
              <label class="form-check-label" for="inlineRadio2">2</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled />
              <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Switches -->
    <div class="card mb-4">
      <h5 class="card-header">Switches</h5>
      <div class="card-body">
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
        </div>
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
          <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
        </div>
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
          <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
          <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
        </div>
      </div>
    </div>

    <!-- Range -->
    <div class="card mb-4 mb-xl-0">
      <h5 class="card-header">Range</h5>
      <div class="card-body">
        <div class="mb-3">
          <label for="formRange1" class="form-label">Example range</label>
          <input type="range" class="form-range" id="formRange1">
        </div>
        <div class="mb-3">
          <label for="disabledRange" class="form-label">Disabled range</label>
          <input type="range" class="form-range" id="disabledRange" disabled>
        </div>
        <div class="mb-3">
          <label for="formRange2" class="form-label">Min and max</label>
          <input type="range" class="form-range" min="0" max="5" id="formRange2">
        </div>
        <div>
          <label for="formRange3" class="form-label">Steps</label>
          <input type="range" class="form-range" min="0" max="5" step="0.5" id="formRange3">
        </div>
      </div>
    </div>

  </div>

  <div class="col-xl-6">
    <!-- HTML5 Inputs -->
    <div class="card mb-4">
      <h5 class="card-header">HTML5 Inputs</h5>
      <div class="card-body">
        <div class="mb-3 row">
          <label for="html5-text-input" class="col-md-2 col-form-label">Text</label>
          <div class="col-md-10">
            <input class="form-control" type="text" value="{{ config('variables.templateName') }}" id="html5-text-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-search-input" class="col-md-2 col-form-label">Search</label>
          <div class="col-md-10">
            <input class="form-control" type="search" value="Search ..." id="html5-search-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-email-input" class="col-md-2 col-form-label">Email</label>
          <div class="col-md-10">
            <input class="form-control" type="email" value="john@example.com" id="html5-email-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-url-input" class="col-md-2 col-form-label">URL</label>
          <div class="col-md-10">
            <input class="form-control" type="url" value="{{ config('variables.creatorUrl') }}" id="html5-url-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-tel-input" class="col-md-2 col-form-label">Phone</label>
          <div class="col-md-10">
            <input class="form-control" type="tel" value="90-(164)-188-556" id="html5-tel-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-password-input" class="col-md-2 col-form-label">Password</label>
          <div class="col-md-10">
            <input class="form-control" type="password" value="password" id="html5-password-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-number-input" class="col-md-2 col-form-label">Number</label>
          <div class="col-md-10">
            <input class="form-control" type="number" value="18" id="html5-number-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Datetime</label>
          <div class="col-md-10">
            <input class="form-control" type="datetime-local" value="2021-06-18T12:30:00" id="html5-datetime-local-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
          <div class="col-md-10">
            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-month-input" class="col-md-2 col-form-label">Month</label>
          <div class="col-md-10">
            <input class="form-control" type="month" value="2021-06" id="html5-month-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-week-input" class="col-md-2 col-form-label">Week</label>
          <div class="col-md-10">
            <input class="form-control" type="week" value="2021-W25" id="html5-week-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-time-input" class="col-md-2 col-form-label">Time</label>
          <div class="col-md-10">
            <input class="form-control" type="time" value="12:30:00" id="html5-time-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-color-input" class="col-md-2 col-form-label">Color</label>
          <div class="col-md-10">
            <input class="form-control" type="color" value="#666EE8" id="html5-color-input" />
          </div>
        </div>
        <div class="row">
          <label for="html5-range" class="col-md-2 col-form-label">Range</label>
          <div class="col-md-10">
            <input type="range" class="form-range mt-3" id="html5-range" />
          </div>
        </div>
      </div>
    </div>

    <!-- File input -->
    <div class="card">
      <h5 class="card-header">File input</h5>
      <div class="card-body">
        <div class="mb-3">
          <label for="formFile" class="form-label">Default file input example</label>
          <input class="form-control" type="file" id="formFile">
        </div>
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Multiple files input example</label>
          <input class="form-control" type="file" id="formFileMultiple" multiple>
        </div>
        <div>
          <label for="formFileDisabled" class="form-label">Disabled file input example</label>
          <input class="form-control" type="file" id="formFileDisabled" disabled>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
