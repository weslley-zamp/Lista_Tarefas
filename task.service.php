<?php
class TaskService{
    private $connection;

    private $task;

    public function __construct(Connection $connection, Task $task){
        $this->$connection = $connection->connect();
        $this->$task = $task;
    }

    public function inserir(){
        //C - CREATE
        $query = 'insert into tb_tarefas(task) values(:task)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':task',$this->task->__get('task'));
        $stmt->execute();
    }

    public function toRecover(){
        // R- read
        $query = '
            select 
                t.id, s.status, t.tarefa
            from
                tb_tarefas as t
                left join tb_status as s on (t.id_status = s.id)
        ';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>