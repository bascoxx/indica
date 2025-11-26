<!-- Sidebar.php -->
<nav class="col-md-3 col-lg-2 d-md-block bg-brown sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav nav-pills nav-brown flex-column">
      <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : ''; ?>" href="main.php">
          <i class="bi bi-house-heart"></i> Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] == 'Product') ? 'active' : ''; ?>" href="main.php?page=Product">
          <i class="bi bi-layout-text-window-reverse"></i> Product Order
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="main.php?page=Report">
          <i class="bi bi-clipboard-heart"></i> Report
        </a>
      </li>
    </ul>
  </div>
</nav>