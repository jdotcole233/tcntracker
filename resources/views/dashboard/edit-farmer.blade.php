@extends('layouts.dashboard-app')

@section('content')

<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ url('/farmers') }}">Edit Precious Profile</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Company Admin</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Edit Farmer</h3>
            </div>

            <div>
              <form id="edit_farmer_forms">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="First Name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control form-control-alternative" value="{{$farmer->first_name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control form-control-alternative" value="{{$farmer->last_name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="other_name">Other Names</label>
                        <input type="text" id="other_name" name="other_name" class="form-control form-control-alternative"  value="{{$farmer->other_name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="Location">Location</label>
                        <input type="text" id="location" name="location" class="form-control form-control-alternative" value="{{$farmer->location}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="gender">Gender</label>

                        <select name="gender" class="form-control form-control-alternative">
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="Phone Number">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" class="form-control form-control-alternative" value="{{$farmer->phone_number}}">
                      </div>
                    </div>
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="Farmer ID">Farmer ID</label>
                        <input type="hidden" id="farmer_editted_id" name="farmer_id" class="form-control form-control-alternative" >
                      </div>
                    </div>
                  </div>
                </div>

              </form>
            </div>

            <div class="card-footer py-4">
              <a><button type="button" class="btn btn-success" id="save_editted_farmer">Save</button></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="{{ url('/') }}" class="font-weight-bold ml-1" target="_blank">TcnTracker</a>
            </div>
          </div>

        </div>
      </footer>
    </div>
  </div>

  @endsection
