<?php
session_start(); // Start the session to handle success/error messages
include('header.php'); // Include your header if necessary
include('Data.php'); // Include your database connection

// Handle the update request for editing the branch
if (isset($_POST['update'])) {
    $branch_id = $_POST['branch_id'];
    $branch_name = $_POST['branch_name'];
    $update_query = "UPDATE branches SET branch = '$branch_name' WHERE Id = $branch_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Branch updated successfully');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle the delete request
if (isset($_POST['dlt-btn'])) {
    $branch_id = $_POST['branch_id'];
    $delete_query = "DELETE FROM branches WHERE Id = $branch_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Branch deleted successfully');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle the add request for a new branch
if (isset($_POST['save_data'])) {
    $branch_name = $_POST['branch_name'];
    $sql = "INSERT INTO branches (branch) VALUES ('$branch_name')";
    $insert_branches = mysqli_query($conn, $sql);
    if ($insert_branches) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Fetch the branches to display in the table
$sql_query = "SELECT * FROM branches";
$check_result = mysqli_query($conn, $sql_query);
$branches = [];
if (mysqli_num_rows($check_result) > 0) {
    while ($row = mysqli_fetch_assoc($check_result)) {
        $branches[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="theme-color" content="#7952b3">
    <link href="sidebars.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
        /* Custom styles for action buttons */
        .btn-transparent {
            background-color: transparent;
            border: 1px solid transparent; /* Optional: Add border if needed */
            color: #007bff; /* Change text color to match your theme */
        }
        .btn-transparent:hover {
            background-color: rgba(0, 123, 255, 0.1); /* Light blue background on hover */
            border: 1px solid #007bff; /* Optional: Add border on hover */
            color: #0056b3; /* Darker text color on hover */
        }
    </style>
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
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">+</button>
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

            <!-- Branch Section -->
            <div id="branch" class="content-section" style="display: none;">
                <h2>Branch
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addBranchModal">+</button>
                </h2>
                <!-- Table -->
                <table class="table" id="branchTable">
                    <thead>
                        <tr>
                            <th>ID (Primary)</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($branches)): ?>
                            <tr>
                                <td colspan="3">No records found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($branches as $branch): ?>
                                <tr>
                                    <td><?php echo $branch['Id']; ?></td>
                                    <td contenteditable="false" class="editable" data-id="<?php echo $branch['Id']; ?>"><?php echo $branch['branch']; ?></td>
                                    <td>
                                        <button class="btn btn-transparent btn-sm edit-btn" data-id="<?php echo $branch['Id']; ?>">🖊️</button>
                                        <form action="#" method="POST" style="display:inline;">
                                            <input type="hidden" name="branch_id" value="<?php echo $branch['Id']; ?>">
                                            <button class="btn btn-transparent btn-sm" name="dlt-btn">❌</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal for adding new branch -->
            <div class="modal fade" id="addBranchModal" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBranchModalLabel">Add Branch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Name of Branch:</label>
                                    <input type="text" class="form-control" id="branch" name="branch_name" required>
                                </div>
                                <button type="submit" name="save_data" class="btn btn-primary">Add Branch</button>
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
                        localStorage.setItem('activeSection', section); // Store the active section in localStorage
                    }
                }

                // Default to show the last active section or "Dashboard" if none
                document.addEventListener('DOMContentLoaded', function () {
                    const activeSection = localStorage.getItem('activeSection') || 'dashboard';
                    showContent(activeSection);
                });

                // Toggle the display of Maintenance links
                function toggleMaintenance() {
                    const maintenanceLinks = document.getElementById('maintenance-links');
                    const isVisible = maintenanceLinks.style.display === 'block';
                    maintenanceLinks.style.display = isVisible ? 'none' : 'block';
                }

                // Handle edit button
                document.querySelectorAll('.edit-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const branchId = this.getAttribute('data-id');
                        const branchCell = this.closest('tr').querySelector('.editable');

                        const isEditable = branchCell.isContentEditable;
                        if (isEditable) {
                            const updatedName = branchCell.innerText;
                            const formData = new FormData();
                            formData.append('update', true);
                            formData.append('branch_id', branchId);
                            formData.append('branch_name', updatedName);

                            fetch('', {
                                method: 'POST',
                                body: formData
                            }).then(response => response.json())
                              .then(data => {
                                  if (data.status === 'success') {
                                      alert('Branch updated successfully');
                                  } else {
                                      alert('Error: ' + data.message);
                                  }
                              });

                            branchCell.contentEditable = false;
                            this.innerText = 'Edit';
                        } else {
                            branchCell.contentEditable = true;
                            branchCell.focus();
                            this.innerText = '💾';
                        }
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>
