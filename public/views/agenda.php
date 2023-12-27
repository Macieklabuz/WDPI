<?php
$tasksByHour = getTasksByHour();

function getTasksByHour() {
    // Tutaj możesz dodać kod do wczytania i zwrócenia struktury danych z zadaniami
    // na przykład z pliku, bazy danych, itp.
    // np. return json_decode(file_get_contents('tasks_data.json'), true);
    return [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDay = htmlspecialchars($_POST['day']);
    $selectedHour = (int)$_POST['hour'];
    $newTask = htmlspecialchars($_POST['task']);

    // Sprawdź, czy godzina jest już w strukturze danych
    if (!isset($tasksByHour[$selectedDay][$selectedHour])) {
        $tasksByHour[$selectedDay][$selectedHour] = [];
    }

    // Dodawanie zadań do struktury danych
    $tasksByHour[$selectedDay][$selectedHour][] = $newTask;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalendarz z Zadaniami</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5FBFF; /* Kolor w tle na środku */
        }

        .calendar-container {
            width: 80%;
            margin: 20px auto;
            background-color: #F5FBFF; /* Kolor w tle na środku */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            background-color: #DBF0FF; /* Kolor na gorze */
            color: #333;
            text-align: center;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(6, 1fr); /* Zmniejszyłem do 6 dni */
            gap: 5px;
        }

        .day {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background-color: #F5FBFF; /* Kolor w tle na środku */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tasks-panel {
            width: 80%;
            margin: 20px auto;
            background-color: #F5FBFF; /* Kolor w tle na środku */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bottom-bar {
            background-color: #24A7FF; /* Kolor na dole */
            height: 5px;
            width: 100%;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .tasks-panel h2 {
            color: #24A7FF; /* Kolor na dole */
        }

        .add-task-form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .add-task-form label {
            margin-bottom: 10px;
        }

        .add-task-form select, .add-task-form input[type="text"], .add-task-form input[type="submit"] {
            width: 70%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-task-form input[type="submit"] {
            background-color: #24A7FF; /* Kolor na dole */
            color: #fff;
            border: none;
            cursor: pointer;
        }

    </style>
</head>
<body>
<div class="calendar-container">
    <div class="calendar-header">
        <h2>Kalendarz Zadań</h2>
    </div>
    <div class="calendar">
        <?php
        $today = new DateTime();
        for ($i = 0; $i <= 5; $i++) {
            $day = clone $today;
            $day->modify("+$i days");
            $dayNumber = $day->format('N');
            echo "<div class='day' onclick='toggleTasks(\"day$i\")'>";
            echo "<h3>{$day->format('l')}</h3>";
            echo "<p>{$day->format('Y-m-d')}</p>";
            echo "<ul id='day$i' style='display:none;'>";
            for ($hour = 0; $hour <= 23; $hour++) {
                echo "<li><strong>$hour:00</strong>";
                if (isset($tasksByHour[$day->format('Y-m-d')][$hour])) {
                    foreach ($tasksByHour[$day->format('Y-m-d')][$hour] as $task) {
                        echo "<p>$task</p>";
                    }
                }
                echo "</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<div class="tasks-panel">
    <?php
    $currentHour = (int)date('G');
    echo "<h2>Dodaj zadanie</h2>";
    echo "<form class='add-task-form' action='' method='post'>";
    echo "<label for='day'>Wybierz dzień:</label>";
    echo "<input type='date' name='day' required>";
    echo "<label for='hour'>Wybierz godzinę:</label>";
    echo "<select name='hour' required>";
    for ($i = 0; $i <= 23; $i++) {
        echo "<option value='$i'>$i:00</option>";
    }
    echo "</select>";
    echo "<label for='tasks'>Dodaj nowe zadanie:</label>";
    echo "<input type='text' name='task' required>";
    echo "<input type='submit' value='Dodaj zadanie'>";
    echo "</form>";
    ?>
</div>
<div class="bottom-bar"></div>

<script>
    function toggleTasks(dayId) {
        var tasksList = document.getElementById(dayId);
        tasksList.style.display = tasksList.style.display === 'none' ? 'block' : 'none';
    }
</script>
</body>
</html>
