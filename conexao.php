<?php

class Connection{
    private $host = 'localhost';

    private $db_name = 'php_com_pdo';

    private $user = 'root';

    private $password = '';


    public function connect(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->db_name",
                "$this->user", 
                "$this->password"
            );

            return $conexao;
        }
        catch(PDOException $e){
            echo '<p>' . $e ->getMessage(). '</p>';
        }
    }
}



?>