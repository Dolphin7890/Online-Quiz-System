<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>assets/css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>index.php">QuizSys Admin/Student</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><span class="nav-link text-white">Hello, <?php echo htmlspecialchars($_SESSION['name']); ?></span></li>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>admin/dashboard.php">Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>student/dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link btn btn-danger text-white btn-sm px-3 ms-2" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo isset($path_prefix) ? $path_prefix : ''; ?>register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container my-5 flex-grow-1">