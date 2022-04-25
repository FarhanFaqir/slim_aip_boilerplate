<?php

class Database{
    private $conn = null;
    private $result = array();

    function Database() {
        // $this->conn = new mysqli("localhost", "root", "", "api");
        // $this->conn = new mysqli("localhost", "root", "", "api") or die("Unable to connect...");
    }

    protected function get($sql){
        $this->conn = new mysqli("localhost", "root", "", "api_crud");
        $res = $this->conn->query($sql);    
        if($res && $res->num_rows > 0) {
            $index = 0;
            while($row = $res->fetch_object()) {
                $result[$index] = $row;
                $index++;
            }
        }

        return $result;

    }

    protected function insert($sql) {
        try{
            $this->conn = new mysqli("localhost", "root", "", "api_crud");
            if($this->conn->query($sql) === TRUE) 
                return $this->conn->insert_id;
                
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        return 0;
    }

    protected function delete($sql){
        $status = 0;
        $this->conn = new mysqli("localhost", "root", "", "api_crud");
        $res = $this->conn->query($sql);    
        if($res) return $status = 1;
        return $status;

  
    }

    protected function update($sql){
        $status = 0;
        $this->conn = new mysqli("localhost", "root", "", "api_crud");
        $res = $this->conn->query($sql);    
        if($res) return $status = 1;
        return $status;

  
    }
}


?>  