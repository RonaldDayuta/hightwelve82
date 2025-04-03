<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header("Location: index.php"); // Redirect if already logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        async function login() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            // Send login request to PHP backend
            const response = await fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ username, password })
            });

            // Parse the JSON response
            const result = await response.json();
            
            // Check if login was successful
            if (result.success) {
                sessionStorage.setItem("loggedIn", "true");
                window.location.href = "index.php"; // Redirect to the homepage
            } else {
                // Show error message if login fails
                document.getElementById("error-msg").innerText = result.message;
                document.getElementById("error-msg").classList.remove("d-none");
            }
        }
    </script>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card p-4 shadow" style="width: 350px;">
        <h2 class="text-center">Login</h2>
        <div id="error-msg" class="alert alert-danger d-none text-center"></div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" placeholder="Enter your username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Enter your password">
        </div>
        <button class="btn btn-primary w-100" onclick="login()">Login</button>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
