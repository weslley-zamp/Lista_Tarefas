<?php
class TaskService{
    private $connection;

    private $task;

    public function __construct(Connection $connection, Task $task){
        $this->connection = $connection->connect();
        $this->task = $task;
    }

    public function Insert(){
        //C - CREATE
        $query = 'insert into tb_tarefas(tarefa) values(:tarefa)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':tarefa',$this->task->__get('task'));
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

    public function Update(){
        //U - update
        $query = 'update tb_tarefas set tarefa = ? where id = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(1, $this->task->__get('tarefa'));
        $stmt->bindValue(2, $this->task->__get('id'));
        return $stmt->execute();
    }

    public function Remove(){
        //D - delete
        $query = 'delete from tb_tarefas where id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id',$this->task->__get('id'));
        $stmt->execute();
    }

    public function markAccomplished(){
         //U - update
         $query = 'update tb_tarefas id_status = ? where id = ?';
         $stmt = $this->connection->prepare($query);
         $stmt->bindValue(1, $this->task->__get('id_status'));
         $stmt->bindValue(2, $this->task->__get('id'));
         return $stmt->execute();
    }
    public function recoverTaskPendants(){
        $query = '
            select t.id, s.status, t.tarefa
            from
                tb_tarefas as t
                left join tb_status as s on (t.id_status = s.id)
                where
                    t.id_status = :id_status
        ';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id_status',$this->task->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>