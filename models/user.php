<?php 

class User extends Common {

    function getUser() {
        $sql = "SELECT * FROM users";
        return $this->get($sql);
    }

    function insertUser($name, $email, $pass, $phone_number){
        $sql = "INSERT INTO users (name, email, password, phone_number) VALUES ('$name', '$email', '$pass', '$phone_number')";
        return $this->insert($sql);
    }

    function deleteUser($id){
        $sql = "DELETE FROM users WHERE id = $id";
        return $this->delete($sql);    
    }


    function updateUser($id, $name, $email, $phone_number ){

        $sql = "UPDATE users SET name = '$name', email = '$email', phone_number = '$phone_number'";
        
        return $this->update($sql);
    }
    
}


?>