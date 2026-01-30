<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$path_prefix = '../';
include '../includes/db_connect.php';

if (!isset($_GET['quiz_id'])) {
    header("Location: dashboard.php");
    exit();
}

$quiz_id = (int) $_GET['quiz_id'];
$quiz_sql = "SELECT * FROM quizzes WHERE id = $quiz_id";
$quiz_result = $conn->query($quiz_sql);
$quiz = $quiz_result->fetch_assoc();

if (!$quiz) {
    die("Quiz not found!");
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_text = $conn->real_escape_string($_POST['question_text']);
    $option_a = $conn->real_escape_string($_POST['option_a']);
    $option_b = $conn->real_escape_string($_POST['option_b']);
    $option_c = $conn->real_escape_string($_POST['option_c']);
    $option_d = $conn->real_escape_string($_POST['option_d']);
    $correct_option = $_POST['correct_option'];

    $sql = "INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option) 
            VALUES ($quiz_id, '$question_text', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";

    if ($conn->query($sql) === TRUE) {
        $success = "Question added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

include '../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header">
                Add Questions to: <strong>
                    <?php echo htmlspecialchars($quiz['title']); ?>
                </strong>
            </div>
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
                        <label class="form-label">Question Text</label>
                        <textarea class="form-control" name="question_text" rows="2" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Option A</label>
                            <input type="text" class="form-control" name="option_a" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Option B</label>
                            <input type="text" class="form-control" name="option_b" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Option C</label>
                            <input type="text" class="form-control" name="option_c" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Option D</label>
                            <input type="text" class="form-control" name="option_d" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correct Option</label>
                        <select class="form-select" name="correct_option" required>
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                    <a href="dashboard.php" class="btn btn-secondary">Done / Back</a>
                </form>

                <hr>
                <h5>Existing Questions</h5>
                <?php
                $q_sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
                $q_result = $conn->query($q_sql);
                if ($q_result->num_rows > 0) {
                    echo "<ul class='list-group'>";
                    while ($q = $q_result->fetch_assoc()) {
                        echo "<li class='list-group-item'>" . htmlspecialchars($q['question_text']) . " <span class='badge bg-success float-end'>Ans: " . strtoupper($q['correct_option']) . "</span></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='text-muted'>No questions added yet.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>