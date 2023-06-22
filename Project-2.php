<!DOCTYPE html>
<html>
<head>
    <title>GGC Soccer Club</title>
    <style>
        body {
            background-image: url('/Images/back.jpg');
            background-repeat: no-repeat;
            background-size: cover;
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
    // Function to save user's information and answers to a text file
    function saveResponseToFile($data)
    {
        file_put_contents('responses.txt', $data, FILE_APPEND);
    }

    // Function to read all responses from the text file
    function getAllResponses()
    {
        return file_get_contents('responses.txt');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $grade = $_POST['grade'];
        $q1 = $_POST['q1'];
        $q2 = $_POST['q2'];
        $q3 = $_POST['q3'];
        $q4 = $_POST['q4'];
        $q5 = $_POST['q5'];
        $gender = $_POST['gender'];

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

        // Save user's information and answers to the shared data file
        $data = "Name: $name\nEmail: $email\nGrade Level: $grade\nScore: $score\n\n";
        saveResponseToFile($data);

        echo '<div class="response">';
        echo '<p>Thank you, ' . $name . ', for submitting your response!</p>';
        echo '<p>Email: ' . $email . '</p>';
        echo '<p>Grade Level: ' . $grade . '</p>';
        echo '<p>Your Score: ' . $score . ' / 100</p>';
        if ($gender == "male") {
            echo "<p>You selected Male.</p>";
        } elseif ($gender == "female") {
            echo "<p>You selected Female.</p>";
        } else {
            echo "<p>Please select a gender.</p>";
        }
        if ($score >= 80) {
            echo "<img src='/Images/soccer.jpg' width=100px height=100px>";
        } elseif ($score >= 50) {
            echo "<img src='/Images/missed.jpg' width=100px height=100px>";
        } else {
            echo "<img src='/Images/missed.jpg' width=100px height=100px>";
        }
        if ($score >= 80) {
    echo '<p style="color: green;">Your Level: Expert</p>';
} else {
    echo '<p style="color: red;">Your Level: Beginner</p>';
}

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
