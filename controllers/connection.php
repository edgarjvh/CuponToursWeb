<?php
class connection
{
    private $server;
    private $user;
    private $pass;
    private $database;
    public  $command;

    public function __construct(){
        $this->server       = "localhost";
        $this->user         = "cupontou_user";
        $this->pass         = "cupontou_pass";
        $this->database     = "cupontou_db";
    }

    function connect(){
        $this->command= new mysqli($this->server,$this->user,$this->pass,$this->database);
    }

    function close(){
        $this->command->close();
    }
}
?>