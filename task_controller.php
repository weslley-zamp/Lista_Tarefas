<?php
    require "task.model.php";
    require "task.service.php";
    require "conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : $action;

    if($action == 'Insert'){
        $task = new Task();
        $task->__set('task', $_POST['task']);

        $connection = new Connection();

        $taskService = new TaskService($conexao, $task);

        $taskService->Insert();

        header('Location: (próximos passos)');
} else if ($action == 'toRecover'){
    $task = new Task();
    $connection = new Connection();

    $taskService = new TaskService($conexao, $tarefa);

    $tasks = $taskService->toRecover();
} else if($action == 'Update'){
    $task = new Task();
    $task->__set('id', $_POST['id']);
    $task->__set('task', $_POST['task']);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskService->Update();
} else if($task == 'Remove'){
    $task = new Task();
    $task->__set('id', $_GET['id']);

    $connection = new Connection();

    $taskService = new TaskService($connection, $task);
    $taskService->Remove();
}else if($task == 'markAccomplished'){
    $task = new Task();
    $task->__set('id',$_GET['id']->__set('id_status',1));
    
    $connection = new Connection();

    $taskService = new TaskService($connection, $task);
    $taskService->markAccomplished();
}
else if($task == 'recoverTaskPendants'){
    $task = new Task();
    $task->__set('id_status', 0);

    $connection = new Connection();

    $taskService = new TaskService($connection, $task);

    $tasks = $taskService->recoverTaskPendants();
}
?>