<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link addL" style="">
    <img src="{{ getShopLogo() }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 addH" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ getShopName() }}</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-item ">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>																
        </li>
        <li class="nav-item">
          <a href="{{ route('categories.index') }}" class="nav-link {{ (Request::segment(2) == 'categories') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('sub-categories.index') }}" class="nav-link {{ (Request::segment(2) == 'sub-categories') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Sub Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('brands.index') }}" class="nav-link {{ (Request::segment(2) == 'brands') ? 'active' : '' }}">
            <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            <p>Brands</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('colors.index') }}" class="nav-link {{ (Request::segment(2) == 'colors') ? 'active' : '' }}">
            <i class="nav-icon  fa fa-copyright" aria-hidden="true"></i>
            <p>Color</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('sizes.index') }}" class="nav-link {{ (Request::segment(2) == 'sizes') ? 'active' : '' }}">
            <i class="nav-icon  fa fa-strikethrough" aria-hidden="true"></i>
            <p>Size</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link {{ (Request::segment(2) == 'products') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tag"></i>
            <p>Products</p>
          </a>
        </li>

        @if(Request::segment(2) == 'product-variations')
        <li class="nav-item">
          <a href="{{ route('product-variations.index',Request::segment(3)) }}" class="nav-link {{ (Request::segment(2) == 'product-variations') ? 'active' : '' }}">
            <i class="nav-icon fas fa-edit"></i>
            <p>Product Variations</p>
          </a>
        </li>
        @endif
        
        <li class="nav-item">
          <a href="{{ route('shipping.create') }}" class="nav-link {{ (Request::segment(2) == 'shipping') ? 'active' : '' }}">
            <!-- <i class="nav-icon fas fa-tag"></i> -->
            <i class="fas fa-truck nav-icon"></i>
            <p>Shipping</p>
          </a>
        </li>							
        <li class="nav-item">
          <a href="{{ route('orders.index') }}" class="nav-link {{ (Request::segment(2) == 'orders') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>Orders</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('coupons.index') }}" class="nav-link {{ (Request::segment(2) == 'coupons') ? 'active' : '' }}">
            <i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
            <p>Discount</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('reviews.index') }}" class="nav-link {{ (Request::segment(2) == 'reviews') ? 'active' : '' }}">
            <i class="nav-icon  fa fa-user-circle" aria-hidden="true"></i>
            <p>Reviews</p>
          </a>
        </li>
        
        @if(Auth::user()->main_role == 2)
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ (Request::segment(2) == 'users') ? 'active' : '' }}">
              <i class="nav-icon  fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>
        @endif


        <li class="nav-item">
          <a href="{{ route('pages.index') }}" class="nav-link {{ (Request::segment(2) == 'pages') ? 'active' : '' }}">
            <i class="nav-icon  far fa-file-alt"></i>
            <p>Pages</p>
          </a>
        </li>							
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>