<!DOCTYPE html>
<html>
<head>
    <title>GGC Soccer Club</title>
    <style>
        body {
            background-color: blue;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: green;
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

    <script>
        // Redirect to the previous page after 5 seconds
        setTimeout(function() {
            window.history.go(-1);
        }, 5000);
    </script>
</body>
</html>
