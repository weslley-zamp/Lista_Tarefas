<?php
class Task{
    private $id;
    private $id_status;
    private $tarefa;
    private $data_cadastrado; 

    public function __get($attribute){
        return $this->$attribute;
    }

    public function __set($attribute,$value){
        if(property_exists($this, $attribute)){
            $this->$attribute = $value;
        }
        return $this;
    }
}
?>