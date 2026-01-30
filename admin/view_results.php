<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$path_prefix = '../';
include '../includes/db_connect.php';
include '../includes/header.php';

$sql = "SELECT attempts.*, users.name as student_name, quizzes.title as quiz_title 
        FROM attempts 
        JOIN users ON attempts.user_id = users.id 
        JOIN quizzes ON attempts.quiz_id = quizzes.id 
        ORDER BY attempts.attempt_time DESC";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Student Results</h2>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Quiz Title</th>
                        <th>Score</th>
                        <th>Total Marks</th>
                        <th>Attempt Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['quiz_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['score']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_marks']); ?></td>
                                <td><?php echo htmlspecialchars($row['attempt_time']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">No results found yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
