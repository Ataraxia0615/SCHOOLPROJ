<?php
session_start(); // Make sure to start the session to handle success/error messages
include('header.php'); // Include your header if necessary
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <meta name="theme-color" content="#7952b3">
  
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <link href="sidebars.css" rel="stylesheet">
</head>

<body>
  <div class="d-flex" style="height: 100vh;">
    <!-- Sidebar/Navbar -->
    <div class="flex-shrink-0 p-3 bg-white" style="width: 280px; height: 100vh; overflow-y: auto;">
      <a href="/logo" class="d-flex justify-content-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold">Business Name</span>
      </a>
      <ul class="list-unstyled ps-0">
        <li class="mb-1">
          <a href="#" class="btn btn-toggle align-items-center rounded m-3" onclick="showContent('dashboard')" id="dashboard-link">
            <span class="btn-toggle-text">Dashboard</span>
          </a>
        </li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded m-3" onclick="toggleMaintenance()">
            <span class="btn-toggle-text">Maintenance</span>
          </button>
          <ul id="maintenance-links" class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="display: none;">
            <li><a href="#" class="link-dark rounded" onclick="showContent('customer')">Customer</a></li>
            <li><a href="#" class="link-dark rounded" onclick="showContent('branch')">Branch</a></li>
            <li><a href="#" class="link-dark rounded" onclick="showContent('users')">Users</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Main Content Area -->
    <div class="flex-grow-1 p-3" style="overflow-y: auto; height: 100vh;">
      <!-- Dashboard Section -->
      <div id="dashboard" class="content-section" style="display: none;">
        <h2>Welcome to the Dashboard</h2>
        <p>This is your dashboard. Select an option from the left menu to view more details.</p>
      </div>

      <!-- Customer Section -->
      <div id="customer" class="content-section" style="display: none;">
        <h2>Customer 
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
  + 
</button>
        </h2>

        <!-- Table -->
        <table class="table" id="customerTable">
          <thead>
            <tr>
              <th>ID (Primary)</th>
              
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>

      <!-- Modal for adding new customer -->
      <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <!-- Form Fields -->
          <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <button type="submit" name="save_data" class="btn btn-primary">Add Customer</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- BranchSection -->
<div id="branch" class="content-section" style="display: none;">
        <h2>Branch
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal1">
  + 
</button>
        </h2>

<!-- Table -->
<table class="table" id="customerTable">
          <thead>
            <tr>
              <th>ID (Primary)</th>
              <th>User</th>
              <th>Name</th>

            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>

<!-- Modal for adding new branch -->
<div class="modal fade" id="addCustomerModal1" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Add Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <!-- Form Fields -->
          <div class="mb-3">
            <label for="name" class="form-label">Branch</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <button type="submit" name="save_data" class="btn btn-primary">Add Branch</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- UserSection -->
<div id="users" class="content-section" style="display: none;">
        <h2>Users
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal2">
  + 
</button>
        </h2>
<!-- Table -->
<table class="table" id="customerTable">
          <thead>
            <tr>
              <th>ID (Primary)</th>
              <th>User</th>
              <th>Name</th>

            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>

<!-- Modal for adding new branch -->
<div class="modal fade" id="addCustomerModal2" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCustomerModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <!-- Form Fields -->
          <div class="mb-3">
            <label for="name" class="form-label">User</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <button type="submit" name="save_data" class="btn btn-primary">Add User</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <script>
    // Show the selected content (either Dashboard, Customer, Branch, or Users)
    function showContent(section) {
      const sections = document.querySelectorAll('.content-section');
      sections.forEach(function (section) {
        section.style.display = 'none';
      });

      const selectedSection = document.getElementById(section);
      if (selectedSection) {
        selectedSection.style.display = 'block';
      }
    }

    // Default to show "Dashboard" content
    document.addEventListener('DOMContentLoaded', function () {
      showContent('dashboard');
    });

    // Toggle the display of Maintenance links
    function toggleMaintenance() {
      const maintenanceLinks = document.getElementById('maintenance-links');
      const isVisible = maintenanceLinks.style.display === 'block';
      maintenanceLinks.style.display = isVisible ? 'none' : 'block';
    }
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
