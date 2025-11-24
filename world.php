<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$host = 'localhost';
$username = 'dazzy69';
$password = 'dazzy69';
$database = 'world';

$country = $_GET['country'] ?? '';
$type = $_GET['lookup'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);

if ($type === "cities") {
    $stmt = $conn->prepare(
        "SELECT cities.name, cities.district, cities.population
         FROM cities
         JOIN countries ON cities.country_code = countries.code
         WHERE countries.name LIKE :country"
    );
} else {
    $stmt = $conn->prepare(
        "SELECT name, continent, independence_year, head_of_state
         FROM countries
         WHERE name LIKE :country"
    );
}

$stmt->execute(['country' => "%$country%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    echo "<table border='1' cellpadding='8'>";
    foreach ($results as $row) {
        echo "<tr>";
        foreach ($row as $v) echo "<td>$v</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}
?>
