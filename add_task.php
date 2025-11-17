<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = trim($_POST['task']);

    $task = mysqli_real_escape_string($conn, $task);

    $sql = "INSERT INTO tasks (task_text) VALUES ('$task')";
    mysqli_query($conn, $sql);
}

header('Location: index.php');
exit();
?>
