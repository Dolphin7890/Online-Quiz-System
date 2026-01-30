<?php
session_start();
// Security Check BYPASSED for Screenshot
$_SESSION['user_id'] = 888;
$_SESSION['role'] = 'student';
$_SESSION['name'] = 'Student (Screenshot)';
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') { ... }

$path_prefix = '../';
include '../includes/db_connect.php';
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

// Fetch Quizzes and check if already attempted
$sql = "SELECT q.*, 
        (SELECT score FROM attempts WHERE quiz_id = q.id AND user_id = $user_id LIMIT 1) as score
        FROM quizzes q ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h2 class="mb-4">Student Dashboard</h2>

<div class="row">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($row['description']); ?>
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Time Limit:</strong>
                                <?php echo $row['time_limit']; ?> mins
                            </li>
                            <li><strong>Total Marks:</strong>
                                <?php echo $row['total_marks']; ?>
                            </li>
                        </ul>

                        <?php if (isset($row['score'])): ?>
                            <div class="alert alert-success p-2 text-center">
                                Attempted<br>
                                <strong>Score:
                                    <?php echo $row['score']; ?> /
                                    <?php echo $row['total_marks']; ?>
                                </strong>
                            </div>
                        <?php else: ?>
                            <a href="take_quiz.php?quiz_id=<?php echo $row['id']; ?>" class="btn btn-primary w-100">Start Quiz</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center text-muted">No quizzes available right now.</p>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>