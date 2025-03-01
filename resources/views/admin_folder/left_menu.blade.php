<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="/admin_index" class="logo">
        <img src="backend/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>

  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        @if (!empty(Auth::user()->usertype == 'Admin'))
        <li class="nav-item active">
          <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="dashboard">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('admin_index')}}">
                  <span class="sub-item">Index</span>
                </a>
              </li>
              <li>
                <a href="{{route('authentication')}}">
                  <span class="sub-item">Authentication</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Forms</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li class="">
                <a href="{{route('category')}}">
                  <span class="sub-item">Add Category</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('sub_category')}}">
                  <span class="sub-item">Add Sub Category</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('measurment')}}">
                  <span class="sub-item">Add Measurment</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('product')}}">
                  <span class="sub-item">Add Product</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('stock')}}">
                  <span class="sub-item">Add Stock</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('user_details')}}">
                  <span class="sub-item">User Details</span>
                </a>
              </li>
              <li>
                <a href="{{route('order_details')}}">
                  <span class="sub-item">Order Table</span>
                </a>
              </li>
              <li>
                <a href="{{route('order_details')}}">
                  <span class="sub-item">Deliver Details</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @elseif (!empty(Auth::user()->usertype == 'Employee'))
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Forms</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
          <ul class="nav nav-collapse">
              <li class="">
                <a href="{{route('category')}}">
                  <span class="sub-item">Add Category</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('sub_category')}}">
                  <span class="sub-item">Add Sub Category</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('measurment')}}">
                  <span class="sub-item">Add Measurment</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('product')}}">
                  <span class="sub-item">Add Product</span>
                </a>
              </li>
              <li class="">
                <a href="{{route('stock')}}">
                  <span class="sub-item">Add Stock</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @elseif (!empty(Auth::user()->usertype == 'Store Keeper'))
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('order_details')}}">
                  <span class="sub-item">Order Table</span>
                </a>
              </li>
              <!-- <li>
                            <a href="#">
                                <span class="sub-item">Stock Table</span>
                            </a>
                        </li> -->
            </ul>
          </div>
        </li>
        @elseif (!empty(Auth::user()->usertype == 'Security'))
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#tables">
            <i class="fas fa-table"></i>
            <p>Tables</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('order_details')}}">
                  <span class="sub-item">Deliver Details</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>