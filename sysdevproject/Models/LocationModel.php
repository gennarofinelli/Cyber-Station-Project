<?php

include_once "db.php";
// Temp before adding multiple locations should client wish to.
class LocationModel
{
    public $id;
    public $name;
    public $code;
    public $details;
    public $status;
    public $hours;

    function __construct($id = -1)
    {
        $this->id = $id;
        if ($id >= 0) {
            $this->loadLocation($id);
        }
    }

    private function loadLocation($id)
    {
        $sql = "SELECT * FROM locations WHERE id = " . intval($id);
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $this->name = $data['name'];
            $this->code = $data['code'];
            $this->details = $data['details'];
            $this->status = $data['status'];
            $this->hours = $data['hours'];
        }
    }

    public static function getAllLocations()
    {
        $list = [];
        $sql = "SELECT id, name, code FROM locations";
        $result = (new self())->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $location = new self($row['id']);
            $location->name = $row['name'];
            $location->code = $row['code'];
            $list[] = $location;
        }

        return $list;
    }

    public static function getLocationById($id)
    {
        $location = new self($id);
        if ($location->id >= 0) {
            return $location;
        }
        return null; 
    }
}
?>
