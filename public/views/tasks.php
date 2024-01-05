<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/global.css">
    <title>Task Manager</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #F5FBFF;
        }

        .top-bar {
            caret-color: transparent;
            height: 84px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #DBF0FF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
            backdrop-filter: blur(2px);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .bottom-bar {
            caret-color: transparent;
            height: 84px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #24A7FF;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .menu-btns {
            display: flex;
            justify-content: space-around;
            width: 85%; /* Ustaw dowolną szerokość przycisków */
            margin-top: 180px;
        }

        .menu-btn {
            padding: 35px;
            background: #24A7FF;
            color: #fff;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 18px;
        }

        .menu-btn:hover {
            background: #007BFF;
        }

        .menu {
            display: flex;
            flex-direction: column;
            background: #fff;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 42px;
            padding: 24px;
            width: 320px; /* Ustaw dowolną szerokość menu */
            overflow-y: auto; /* Dodaj scroll, jeśli jest więcej zadań niż zmieści się w obszarze menu */
            max-height: 400px; /* Ustaw dowolną maksymalną wysokość menu */
        }

        .menu-item {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .menu-item.in-progress {
            background-color: #FFECB3;
        }

        .menu-item.completed {
            background-color: #C8E6C9;
        }

        .details-available:hover {
            background-color: #E3F2FD; /* Kolor tła po najechaniu kursorem */
        }

        .selected-task {
            border: 2px solid #007BFF;
        }

        .task-details-container {
            display: none;
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .task-description {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }

        .delete-button {
            background-color: #ff6961;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e63946;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="bottom-bar"></div>
    <div class="menu-btns">
        <button class="menu-btn" onclick="showTasks('all')">Wszystkie</button>
        <button class="menu-btn" onclick="showTasks('menu-item')">Do zrobienia</button>
        <button class="menu-btn" onclick="showTasks('in-progress')">W trakcie</button>
        <button class="menu-btn" onclick="showTasks('completed')">Zakończone</button>
        <button class="menu-btn" onclick="changeUrl('/addTask')">Dodaj Zadanie</button>
        <script>
            function changeUrl(newUrl) {
                window.location.href = newUrl;
            }
        </script>
    </div>
</div>

<div class="menu" id="taskMenu">
    <div class="menu-item details-available" data-category="menu-item" data-id="1" data-description="spaceglidowac" data-due-date="2023-01-01">Zadanie 1</div>
    <div class="menu-item in-progress details-available" data-category="in-progress" data-id="2" data-description="programowac" data-due-date="2023-02-15">Zadanie 2 (W trakcie)</div>
    <div class="menu-item completed details-available" data-category="completed" data-id="3" data-description="pojsc do sklepu" data-due-date="2023-03-31">Zadanie 3 (Zakończone)</div>
    <!-- Dodaj więcej zadań według potrzeb -->
</div>

<!-- Dodatkowe miejsce na opis i datę zadania -->
<div id="taskDetails" class="task-details-container">
    <h3>Opis zadania:</h3>
    <div id="taskDescription"></div>
    <h3>Data wykonania:</h3>
    <p id="taskDueDate"></p>
    <button class="delete-button" onclick="deleteTask()">Usuń zadanie</button>
</div>

<script>
    var menuItems = document.querySelectorAll('.menu-item.details-available');
    var taskDetails = document.getElementById('taskDetails');
    var taskDescription = document.getElementById('taskDescription');
    var taskDueDate = document.getElementById('taskDueDate');
    var selectedTask = null;

    function hideAllTasks() {
        menuItems.forEach(function (item) {
            item.style.display = 'none';
        });
    }

    function showTaskDetails(description, dueDate) {
        taskDetails.style.display = 'block';
        taskDescription.innerHTML = `<div class="task-description">${description}</div>`;
        taskDueDate.textContent = dueDate;
    }

    function hideTaskDetails() {
        taskDetails.style.display = 'none';
    }

    function toggleTask(item) {
        if (selectedTask === item) {
            selectedTask.classList.remove('selected-task');
            selectedTask = null;
            hideTaskDetails();
        } else {
            if (selectedTask) {
                selectedTask.classList.remove('selected-task');
            }
            item.classList.add('selected-task');
            selectedTask = item;
            showTaskDetails(item.dataset.description || 'Brak opisu', item.dataset.dueDate || 'Brak daty wykonania');
        }
    }

    function deleteTask() {
        if (selectedTask) {
            // Tutaj dodaj kod do usuwania zadania (np. wysłanie żądania do serwera)
            // Poniżej znajdziesz przykładową funkcję usuwającą zadanie z interfejsu użytkownika
            selectedTask.style.display = 'none';
            hideTaskDetails();
            selectedTask = null;
        }
    }

    function showTasks(category) {
        hideAllTasks();
        hideTaskDetails();

        menuItems.forEach(function (item) {
            if (category === 'all' || (category === item.dataset.category)) {
                item.style.display = 'flex';

                item.addEventListener('click', function () {
                    toggleTask(item);
                });
            }
        });
    }

    // Domyślnie pokaż wszystkie zadania po załadowaniu strony
    showTasks('all');
</script>
</body>
</html>
