<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
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
$user_id = $_SESSION['user_id'];

// Check validity and previous attempts
$check_sql = "SELECT * FROM attempts WHERE quiz_id = $quiz_id AND user_id = $user_id";
if ($conn->query($check_sql)->num_rows > 0) {
    die("You have already attempted this quiz.");
}

$quiz_sql = "SELECT * FROM quizzes WHERE id = $quiz_id";
$quiz_result = $conn->query($quiz_sql);
$quiz = $quiz_result->fetch_assoc();

if (!$quiz) {
    die("Quiz not found!");
}

// Fetch Questions
$q_sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
$q_result = $conn->query($q_sql);
$questions = [];
while ($row = $q_result->fetch_assoc()) {
    $questions[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attempt Quiz -
        <?php echo htmlspecialchars($quiz['title']); ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        #timer {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e74a3b;
        }

        .question-card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container my-5">
        <div
            class="d-flex justify-content-between align-items-center mb-4 sticky-top bg-light py-2 shadow-sm px-3 rounded">
            <h4>
                <?php echo htmlspecialchars($quiz['title']); ?>
            </h4>
            <div id="timer">Time Left: <span id="time">00:00</span></div>
        </div>

        <form id="quizForm" method="POST" action="result.php">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">

            <?php foreach ($questions as $index => $q): ?>
                <div class="card question-card shadow-sm">
                    <div class="card-header">
                        <strong>Q
                            <?php echo $index + 1; ?>:
                        </strong>
                        <?php echo htmlspecialchars($q['question_text']); ?>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q_<?php echo $q['id']; ?>" value="a"
                                id="q<?php echo $q['id']; ?>_a">
                            <label class="form-check-label" for="q<?php echo $q['id']; ?>_a">
                                <?php echo htmlspecialchars($q['option_a']); ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q_<?php echo $q['id']; ?>" value="b"
                                id="q<?php echo $q['id']; ?>_b">
                            <label class="form-check-label" for="q<?php echo $q['id']; ?>_b">
                                <?php echo htmlspecialchars($q['option_b']); ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q_<?php echo $q['id']; ?>" value="c"
                                id="q<?php echo $q['id']; ?>_c">
                            <label class="form-check-label" for="q<?php echo $q['id']; ?>_c">
                                <?php echo htmlspecialchars($q['option_c']); ?>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q_<?php echo $q['id']; ?>" value="d"
                                id="q<?php echo $q['id']; ?>_d">
                            <label class="form-check-label" for="q<?php echo $q['id']; ?>_d">
                                <?php echo htmlspecialchars($q['option_d']); ?>
                            </label>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-4 mb-5">
                <button type="submit" class="btn btn-success btn-lg px-5">Submit Quiz</button>
            </div>
        </form>
    </div>

    <script>
        // Timer Logic
        let limitMinutes = <?php echo $quiz['time_limit']; ?>;
        let timeInSeconds = limitMinutes * 60;
        const timerElement = document.getElementById('time');
        const quizForm = document.getElementById('quizForm');

        function updateTimer() {
            const minutes = Math.floor(timeInSeconds / 60);
            let seconds = timeInSeconds % 60;

            seconds = seconds < 10 ? '0' + seconds : seconds;
            timerElement.innerText = `${minutes}:${seconds}`;

            if (timeInSeconds > 0) {
                timeInSeconds--;
            } else {
                // Auto submit
                alert("Time is up! Submitting your quiz.");
                quizForm.submit();
            }
        }

        setInterval(updateTimer, 1000);

        // Disable back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>

</body>

</html>