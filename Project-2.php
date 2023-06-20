<!DOCTYPE html>
<html>
<head>
    <title>GGC Soccer Club</title>
    <style>
        body {
            background-color: #15a9ed;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #07f269;
            font-weight: bold;
        }

        .response {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .response p {
            font-size: 18px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <h1>GGC Soccer Club</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $grade = $_POST['grade'];
        $q1 = $_POST['q1'];
        $q2 = $_POST['q2'];
        $q3 = $_POST['q3'];
        $q4 = $_POST['q4'];
        $q5 = $_POST['q5'];

        $score = 0;

        if ($q1 === 'a') {
            $score += 20;
        }

        if ($q2 === 'a') {
            $score += 20;
        }

        if ($q3 === 'a') {
            $score += 20;
        }

        if ($q4 === 'c') {
            $score += 20;
        }

        if ($q5 === 'a') {
            $score += 20;
        }
       // Save user's information and answers to a text file
    $data = "Name: $name\nEmail: $email\nGrade Level: $grade\nScore: $score\n\n";
    file_put_contents('responses.txt', $data, FILE_APPEND);

        echo '<div class="response">';
        echo '<p>Thank you, ' . $name . ', for submitting your response!</p>';
        echo '<p>Email: ' . $email . '</p>';
        echo '<p>Grade Level: ' . $grade . '</p>';
        echo '<p>Your Score: ' . $score . ' / 100</p>';
        echo '</div>';
    } else {
        echo '<div class="response">';
        echo '<p>No response submitted.</p>';
        echo '</div>';
    }
    ?>
    <a href="project-stat.php">View Statistics</a>

</body>
</html>
