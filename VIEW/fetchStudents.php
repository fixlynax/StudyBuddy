<?php
include "./MODEL/connect.php";

// Fetch list of students based on pointRating
$sql = "SELECT s.stdID, s.stdName, r.pointRating 
        FROM student s 
        INNER JOIN rating r ON s.stdID = r.studentID 
        ORDER BY r.pointRating DESC 
        LIMIT 15";
$result = $conn->query($sql);

// Get current user's SessionID (stdID) if available
$stdID = $_SESSION['stdID'] ?? null;
$currentRank = "N/A";

// If stdID is set, determine the current rank of the user
if ($stdID) {
    $rank_sql = "SELECT COUNT(*) AS rank FROM rating WHERE pointRating > (SELECT pointRating FROM rating WHERE studentID = $stdID)";
    $rank_result = $conn->query($rank_sql);
    $row = $rank_result->fetch_assoc();
    $currentRank = $row['rank'] + 1; // Add 1 to start rank from 1
}

// Display the list of students and their ranks
echo "<table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Rating Points</th>
            </tr>
        </thead>
        <tbody>";

$rank = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td class='td-$rank'>$rank</td>
            <td class='td-$rank'>{$row['stdName']}</td>
            <td class='td-$rank'>{$row['pointRating']}</td>
          </tr>";
    $rank++;
}

echo "</tbody></table>";

// Display the current rank of the user
$conn->close();
?>
