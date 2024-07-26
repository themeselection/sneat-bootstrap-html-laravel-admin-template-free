@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Pages')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6">
        <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-account')}}"><i class="bx bx-user bx-sm me-1_5"></i> Account</a></li>
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell bx-sm me-1_5"></i> Notifications</a></li>
        <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt bx-sm me-1_5"></i> Connections</a></li>
      </ul>
    </div>
    <div class="card">
      <!-- Notifications -->
      <div class="card-body">
        <h5 class="mb-1">Recent Devices</h5>
        <span class="card-subtitle">We need permission from your browser to show notifications. <span class="notificationRequest"><span class="text-primary">Request Permission</span></span></span>
        <div class="error"></div>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="text-nowrap">Type</th>
              <th class="text-nowrap text-center">Email</th>
              <th class="text-nowrap text-center">Browser</th>
              <th class="text-nowrap text-center">App</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-nowrap text-heading">New for you</td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck1" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck2" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck3" checked />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-nowrap text-heading">Account activity</td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck4" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck5" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck6" checked />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-nowrap text-heading">A new browser used to sign in</td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck7" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck8" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck9" />
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-nowrap text-heading">A new device is linked</td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck10" checked />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck11" />
                </div>
              </td>
              <td>
                <div class="form-check mb-0 d-flex justify-content-center align-items-center">
                  <input class="form-check-input" type="checkbox" id="defaultCheck12" />
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-body">
        <h6 class="text-body mb-6">When should we send you notifications?</h6>
        <form action="javascript:void(0);">
          <div class="row">
            <div class="col-sm-6">
              <select id="sendNotification" class="form-select" name="sendNotification">
                <option selected>Only when I'm online</option>
                <option>Anytime</option>
              </select>
            </div>
            <div class="mt-6">
              <button type="submit" class="btn btn-primary me-3">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Discard</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /Notifications -->
    </div>
  </div>
</div>
@endsection
