<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Plan Zadań</title>
</head>
<body>
    <div class="container">
        <h1>Plan Zadań</h1>
        
        <div class="tabs">
            <?php
            for ($day = 1; $day <= 7; $day++) {
                echo "<a href='day.php?day=$day' " . ($_GET['day'] == $day ? 'class="active"' : '') . ">Dzień $day</a>";
            }
            ?>
        </div>
        
        <div class="content">
            <?php
            if (isset($_GET['day'])) {
                $selectedDay = $_GET['day'];
                echo "<h2>Zadania na Dzień $selectedDay</h2>";
                // Tutaj możesz dodać kod do wczytania i wyświetlenia zadań dla danego dnia
            }
            ?>
        </div>
    </div>
</body>
</html>

