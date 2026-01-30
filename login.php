<?php
session_start();
include 'includes/db_connect.php';

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $email = $conn->real_escape_string($email);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password (Modified to allow PLAIN TEXT for debugging)
        $is_valid = false;
        if (password_verify($password, $row['password'])) {
            $is_valid = true;
        } elseif ($password == $row['password']) {
            $is_valid = true; // Fallback for plain text
        }

        if ($is_valid) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: student/dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-body p-5">
                <h3 class="text-center mb-4">Login</h3>
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>