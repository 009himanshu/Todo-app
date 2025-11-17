<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $task_id = intval($_POST['task_id']);

    $sql = "DELETE FROM tasks WHERE id = $task_id";
    mysqli_query($conn, $sql);
}

header('Location: index.php');
exit();
?>
