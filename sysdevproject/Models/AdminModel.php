<?php

include_once "db.php";

class Admin {
    public $username;
    public $password;
    public $role;

    function __construct($id = -1)
    {
        if($id < 0){
            $this->status = "";
        }
        else{
            global $conn;
            $sql = "SELECT * FROM `admin` WHERE `adminId` = " . $id;

            $result = $conn->query($sql);

            $data = Admin::castToAdmin($result->fetch_object());

            $this->username = $data->username;
            $this->password = $data->password;
            $this->role = $data->role;
        }
    }

    static function castToAdmin($obj){
        $admin = new Admin();

        $admin->username = $obj->username;
        $admin->password = $obj->password;
        $admin->role = $obj->role;
        return $admin;
    }

    static function list(){
        global $conn;
        $list = array();

        $sql = "SELECT * FROM `admin`";
        $result = $conn->query($sql);

        while($row = $result->fetch_object()){
            $admin = Admin::castToAdmin($row);

            array_push($list, $admin);
        }

        return $list;
    }

    static function validateAdmin($data){
        global $conn;
        $sql = "SELECT * FROM `admin` WHERE `username` LIKE ? AND `password` LIKE ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $data['username'], $data['password']);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $admin = $result->fetch_object();
            return Admin::castToAdmin($admin);
        } else {
            echo "<script>alert('Incorrect Admin Username or Password.');</script>";
            return false;
        }
    }

    static function getRoleFromUserRights($username) {
        global $conn;
        $sql = "SELECT ur.role 
                FROM user_rights ur 
                JOIN admin a ON ur.userId = a.adminId
                WHERE a.username = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            return $row->role;  // Return the role (1 or 2)
        } else {
            return null;  // No role found, return null or handle as needed
        }
    }
}

?>
