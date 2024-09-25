<?php require_once 'config.php'; ?> 

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="<?php echo BASE_URL; ?>admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">admin 2024</span>
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo BASE_URL; ?>admin/dist/img/user2-160x160.jpg" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo BASE_URL; ?>admin" class="d-block">Adel Noaman</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <!-- New Parent Nav Item: Blogs -->
<li class="nav-item menu-open">
  <a href="#" class="nav-link active">
    <i class="nav-icon fas fa-blog"></i> <!-- Add a blog icon -->
    <p>
      Blogs
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="<?php echo BASE_URL; ?>admin/views/add_blogs.php" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Add Blogs</p>
      </a>
    </li>
  </ul>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="<?php echo BASE_URL; ?>admin/views/manage_blogs.php" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage Blogs</p>
      </a>
    </li>
  </ul>
</li>

        <!-- New Parent Nav Item: Products -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Products
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/add_products.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/manage_products.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Products</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- New Parent Nav Item: Orders -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Orders
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/manage_orders.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Orders</p>
              </a>
            </li>
          </ul>
        </li>

                <!-- New Parent Nav Item: Slider -->

        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
              Slider
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/add_slider.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/manage_slider.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Slider</p>
              </a>
            </li>
          </ul>
        </li>

        
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/add_settings.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Site Links</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/manage_settings.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Site Links</p>
              </a>
            </li>
 


          </ul>
        </li>

        
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-sliders-h"></i>
            <p>
              Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/add_user.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo BASE_URL; ?>admin/views/manage_user.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage User</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- ... Rest of the menu items ... -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<style>
  .nav-sidebar .nav-treeview > .nav-item > .nav-link.active,
  .nav-sidebar .nav-treeview > .nav-item > .nav-link.active:hover {
    background-color: #ffffff !important;
    color: #343a40 !important;
  }
  .nav-sidebar .nav-treeview > .nav-item > .nav-link.active .nav-icon,
  .nav-sidebar .nav-treeview > .nav-item > .nav-link.active:hover .nav-icon {
    color: #007bff !important;
  }

  /* Highlight the current page based on URL */
  .nav-sidebar .nav-treeview > .nav-item > .nav-link[href$="<?php echo basename($_SERVER['PHP_SELF']); ?>"] {
    background-color: #ffffff !important;
    color: #343a40 !important;
  }
  .nav-sidebar .nav-treeview > .nav-item > .nav-link[href$="<?php echo basename($_SERVER['PHP_SELF']); ?>"] .nav-icon {
    color: #007bff !important;
  }
</style>