<!DOCTYPE html>
<html>
<head>
    <title>GGC Soccer Club - Statistics</title>
    <style>
        body {
            background-image: url('/Images/goal.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .red {
            color: red;
        }

        .blue {
            color: blue;
        }

        .orange {
            color: orange;
        }

        .pink {
            color: pink;
        }
    </style>
</head>
<body>
<h1>GGC Soccer Club - Statistics</h1>

<?php
// Function to read all responses from the shared data file
function getAllResponsesFromFile()
{
    return file_get_contents('responses.txt');
}

if (!empty(getAllResponsesFromFile())) {
    // Split responses by new line
    $responsesArray = explode("\n\n", getAllResponsesFromFile());

    // Calculate average score of all users
    $totalUsers = count($responsesArray);
    $totalScores = 0;

    // Calculate average scores for male and female users
    $maleCount = 0;
    $maleTotalScores = 0;
    $femaleCount = 0;
    $femaleTotalScores = 0;

    // Calculate average scores for each grade level
    $grades = array('Freshman', 'Sophomore', 'Junior', 'Senior');
    $gradeCounts = array_fill(0, count($grades), 0);
    $gradeTotalScores = array_fill(0, count($grades), 0);

    // Process each response
    foreach ($responsesArray as $response) {
        $responseArray = explode("\n", $response);

        // Extract score from the response
        $scoreLine = end($responseArray);
        $score = intval(substr($scoreLine, strrpos($scoreLine, 'Score: ') + 7));

        $totalScores += $score;

        // Extract demographic information from the response
        $nameLine = reset($responseArray);
        $emailLine = next($responseArray);
        $gradeLine = next($responseArray);

        // Extract gender from the email address (assuming it contains the gender)
        $emailParts = explode('@', $emailLine);
        $gender = 'Other';
        if (count($emailParts) === 2) {
            $domain = $emailParts[1];
            if (stripos($domain, 'male') !== false) {
                $gender = 'Male';
            } elseif (stripos($domain, 'female') !== false) {
                $gender = 'Female';
            }
        }

        // Extract grade level from the response
        $grade = substr($gradeLine, strrpos($gradeLine, 'Grade Level: ') + 13);

        // Update statistics based on gender and grade level
        if ($gender === 'Male') {
            $maleCount++;
            $maleTotalScores += $score;
        } elseif ($gender === 'Female') {
            $femaleCount++;
            $femaleTotalScores += $score;
        }

        $gradeIndex = array_search($grade, $grades);
        if ($gradeIndex !== false) {
            $gradeCounts[$gradeIndex]++;
            $gradeTotalScores[$gradeIndex] += $score;
        }
    }

    // Calculate averages
    $averageScoreAll = $totalScores / $totalUsers;
    $averageScoreMale = $maleCount > 0 ? $maleTotalScores / $maleCount : 0;
    $averageScoreFemale = $femaleCount > 0 ? $femaleTotalScores / $femaleCount : 0;
    $averageScores = array();
    for ($i = 0; $i < count($grades); $i++) {
        $averageScores[$grades[$i]] = $gradeCounts[$i] > 0 ? $gradeTotalScores[$i] / $gradeCounts[$i] : 0;
    }

    // Display statistics
    echo '<h2>Overall Statistics</h2>';
    echo "<p><span class=\"red\">Total Users: $totalUsers</span></p>";
    echo "<p><span class=\"blue\">Average Score of All Users: " . round($averageScoreAll, 2) . "/100</span></p>";

    echo '<h2>Gender Statistics</h2>';
    echo "<p><span class=\"orange\">Total Male Users: $maleCount</span></p>";
    echo "<p><span class=\"orange\">Average Score of Male Users: " . round($averageScoreMale, 2) . "/100</span></p>";

    echo "<p><span class=\"pink\">Total Female Users: $femaleCount</span></p>";
    echo "<p><span class=\"pink\">Average Score of Female Users: " . round($averageScoreFemale, 2) . "/100</span></p>";

    echo '<h2>Grade Level Statistics</h2>';
    echo '<table>';
    echo '<tr>
            <th>Level</th>
            <th>Number of Students</th>
            <th>Percentage of Students</th>
            <th>Average Score</th>
          </tr>';
    foreach ($grades as $grade) {
        $gradeIndex = array_search($grade, $grades);
        $numStudents = $gradeCounts[$gradeIndex];
        $percentage = round(($numStudents / $totalUsers) * 100, 2);
        $averageScore = round($averageScores[$grade], 2);

        echo "<tr>";
        echo "<td>$grade</td>";
        echo "<td style=\"text-align: center;\">$numStudents</td>";
        echo "<td><meter value=\"$numStudents\" max=\"$totalUsers\"></meter>$percentage%</td>";
        echo "<td><progress value=\"$averageScore\" max=\"150\"></progress>$averageScore</td>";
        echo "</tr>";
    }
    echo '</table>';

    echo '<h2>All Submitted Information</h2>';
    echo '<table>';
    echo '<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Grade Level</th>
            <th>Score</th>
          </tr>';

    foreach ($responsesArray as $response) {
        $responseArray = explode("\n", $response);
        $nameLine = reset($responseArray);
        $emailLine = next($responseArray);
        $gradeLine = next($responseArray);
        $scoreLine = end($responseArray);

        $name = substr($nameLine, strpos($nameLine, ':') + 2);
        $email = substr($emailLine, strpos($emailLine, ':') + 2);
        $grade = substr($gradeLine, strpos($gradeLine, ':') + 2);
        $score = substr($scoreLine, strrpos($scoreLine, 'Score: ') + 7);

        echo "<tr>";
        echo "<td>$name</td>";
        echo "<td>$email</td>";
        echo "<td>$grade</td>";
        echo "<td>$score</td>";
        echo "</tr>";
    }

    echo '</table>';
} else {
    echo '<p>No response submitted.</p>';
}
?>
</body>
</html>
