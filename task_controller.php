<?php
    require "./task.model.php";
    require "./task.service.php";
    require "./conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : $action;

    if($action == 'Insert'){
        $task = new Task();
        $task->__set('task', $_POST['tarefa']);

        $connection = new Connection();

        $taskService = new TaskService($connection, $task);

        $taskService->Insert();

        header('Location: index.php');
} else if ($action == 'toRecover'){
    $task = new Task();
    $connection = new Connection();

    $taskService = new TaskService($connection, $task);

    $tasks = $taskService->toRecover();
} else if($action == 'Update'){
    $task = new Task();
    $task->__set('id', $_POST['id']);
    $task->__set('task', $_POST['task']);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskService->Update();
} else if($action == 'Remove'){
    $task = new Task();
    $task->__set('id', $_GET['id']);

    $connection = new Connection();

    $taskService = new TaskService($connection, $task);
    $taskService->Remove();
}else if($action == 'markAccomplished'){
    $task = new Task();
    $task->__set('id', $_GET['id']);
    $task->__set('id_status', 1);
    
    $connection = new Connection();

    $taskService = new TaskService($connection, $task);
    $taskService->markAccomplished();
}
else if($action == 'recoverTaskPendants'){
    $task = new Task();
    $task->__set('id_status', 0);

    $connection = new Connection();

    $taskService = new TaskService($connection, $task);

    $tasks = $taskService->recoverTaskPendants();
}
?>