<?php
session_start(); // Start the session to handle success/error messages
include('Data.php'); // Include your database connection

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