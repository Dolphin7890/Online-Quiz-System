<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$path_prefix = '../';
include '../includes/db_connect.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $time_limit = (int) $_POST['time_limit'];
    $total_marks = (int) $_POST['total_marks'];

    $sql = "INSERT INTO quizzes (title, description, time_limit, total_marks) VALUES ('$title', '$description', $time_limit, $total_marks)";

    if ($conn->query($sql) === TRUE) {
        $success = "Quiz created successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

include '../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">Create New Quiz</div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Quiz Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Time Limit (Minutes)</label>
                            <input type="number" class="form-control" name="time_limit" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Marks</label>
                            <input type="number" class="form-control" name="total_marks" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Create Quiz</button>
                    <a href="dashboard.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>