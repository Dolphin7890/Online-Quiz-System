<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$path_prefix = '../';
include '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_id = (int) $_POST['quiz_id'];
    $user_id = $_SESSION['user_id'];

    // Double check attempt
    $check_sql = "SELECT * FROM attempts WHERE quiz_id = $quiz_id AND user_id = $user_id";
    if ($conn->query($check_sql)->num_rows > 0) {
        // Already attempted, maybe redirect to dashboard
        header("Location: dashboard.php");
        exit();
    }

    // Fetch Quiz Details
    $quiz_sql = "SELECT * FROM quizzes WHERE id = $quiz_id";
    $quiz = $conn->query($quiz_sql)->fetch_assoc();
    $total_marks = $quiz['total_marks'];

    // Fetch Questions
    $q_sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
    $q_result = $conn->query($q_sql);

    $score = 0;
    $total_questions = $q_result->num_rows;
    $marks_per_question = ($total_questions > 0) ? ($total_marks / $total_questions) : 0;

    $user_answers = [];

    while ($q = $q_result->fetch_assoc()) {
        $q_id = $q['id'];
        $correct_opt = $q['correct_option'];

        if (isset($_POST['q_' . $q_id])) {
            $user_opt = $_POST['q_' . $q_id];
            if ($user_opt == $correct_opt) {
                $score += $marks_per_question;
            }
        }
    }

    $score = round($score); // Round to nearest integer

    // Save Attempt
    $insert_sql = "INSERT INTO attempts (user_id, quiz_id, score, total_marks) VALUES ($user_id, $quiz_id, $score, $total_marks)";
    $conn->query($insert_sql);

} else {
    header("Location: dashboard.php");
    exit();
}

include '../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card shadow mt-5">
            <div class="card-body p-5">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                <h2 class="mt-3">Quiz Submitted!</h2>
                <p class="lead">You have successfully completed the quiz: <strong>
                        <?php echo htmlspecialchars($quiz['title']); ?>
                    </strong></p>

                <hr>

                <div class="display-4 font-weight-bold text-primary mb-3">
                    <?php echo $score; ?> /
                    <?php echo $total_marks; ?>
                </div>
                <h5>Your Score</h5>

                <div class="mt-4">
                    <a href="dashboard.php" class="btn btn-primary px-4">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>