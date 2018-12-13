@extends('layouts.dashboard-app')

@section('content')

<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ url('/farmers') }}">Add Community Price</a>
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
              <h3 class="mb-0">Add price</h3>
            </div>

            <div>
              <form id="community_price_forms">
                <div class="pl-lg-4">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Price (GHC)</label>
                        <input type="number" id="current_price" name="current_price" class="form-control form-control-alternative" placeholder="Enter current price">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="display:none;">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="companiescompany_id">Company ID</label>
                        <input type="text" id="companiescompany_id" name="companiescompany_id" class="form-control form-control-alternative" value="1">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="display:none;">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="Community ID">Community ID</label>
                        <input type="number" id="communitiescommunity_id" name="communitiescommunity_id" class="form-control form-control-alternative" >
                      </div>
                    </div>
                  </div>
                </div>

              </form>
            </div>

            <div class="card-footer py-4">
              <a><button type="button" class="btn btn-success" id="add_community_price">Submit</button></a>
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