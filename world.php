<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'world';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$type = isset($_GET['lookup']) ? $_GET['lookup'] : 'countries';

if ($type === 'cities') {
    $stmt = $pdo->prepare("
        SELECT cities.name, cities.district, cities.population 
        FROM cities 
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        echo "<table>
                <tr><th>City</th><th>District</th><th>Population</th></tr>";
        foreach ($rows as $r) {
            echo "<tr>
                    <td>".htmlspecialchars($r['name'])."</td>
                    <td>".htmlspecialchars($r['district'])."</td>
                    <td>".htmlspecialchars($r['population'])."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No cities found.";
    }

} else {
    $stmt = $pdo->prepare("
        SELECT name, continent, indepyear, headofstate
        FROM countries
        WHERE name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        echo "<table>
                <tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
        foreach ($rows as $r) {
            echo "<tr>
                    <td>".htmlspecialchars($r['name'])."</td>
                    <td>".htmlspecialchars($r['continent'])."</td>
                    <td>".htmlspecialchars($r['indepyear'])."</td>
                    <td>".htmlspecialchars($r['headofstate'])."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No countries found.";
    }
}
?>
