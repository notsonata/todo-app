<?php
// delete_task.php
require_once 'config.php';

if (isset($_GET['task_id']) && is_numeric($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']);
    
    // Prepare the statement
    $stmt = mysqli_prepare($db, "DELETE FROM `task` WHERE `task_id` = ?");
    mysqli_stmt_bind_param($stmt, 'i', $task_id);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("location: index.php");
        exit();
    } else {
        die("Error deleting task: " . mysqli_error($db));
    }
} else {
    die("Invalid task ID");
}
?>