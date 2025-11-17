<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['completed'])) {
    $task_id = intval($_POST['task_id']);
    $completed = intval($_POST['completed']);

    $sql = "UPDATE tasks SET is_completed = $completed WHERE id = $task_id";
    mysqli_query($conn, $sql);
}

header('Location: index.php');
exit();
?>
