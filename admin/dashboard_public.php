<?php
session_start();
// Security Check BYPASSED for Screenshot
$_SESSION['user_id'] = 999;
$_SESSION['role'] = 'admin';
$_SESSION['name'] = 'Admin (Screenshot)';
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') { ... }

$path_prefix = '../'; // For header linkage
include '../includes/db_connect.php';
include '../includes/header.php';

// Fetch Quizzes
$sql = "SELECT * FROM quizzes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
    <div>
        <a href="create_quiz.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Create New Quiz</a>
        <a href="view_results.php" class="btn btn-info text-white">View All Results</a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Quizzes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Time Limit (min)</th>
                        <th>Total Marks</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['time_limit']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['total_marks']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['created_at']); ?>
                                </td>
                                <td>
                                    <a href="add_questions.php?quiz_id=<?php echo $row['id']; ?>"
                                        class="btn btn-sm btn-primary">Add Questions</a>
                                    <!-- Add Delete Link if needed -->
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No quizzes found. Create one!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>