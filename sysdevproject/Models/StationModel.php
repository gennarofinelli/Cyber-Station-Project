<?php

include_once "db.php";

class Station {
    public $stationId;
    public $status;

    function __construct($id = -1) {
        if ($id < 0) {
            $this->status = "";
        } else {
            global $conn;
            $sql = "SELECT * FROM `station` WHERE `stationId` = " . $id;

            $result = $conn->query($sql);

            $data = Station::castToStation($result->fetch_object()); // Updated to StationModel

            $this->stationId = $data->stationId;
            $this->status = $data->status;
        }
    }

    static function castToStation($obj) {
        $station = new Station(); // Updated to StationModel

        $station->stationId = $obj->stationId;
        $station->status = $obj->status;

        return $station;
    }

    static function list() {
        global $conn;
        $list = array();

        $sql = "SELECT * FROM `station`";
        $result = $conn->query($sql);

        while ($row = $result->fetch_object()) {
            $station = Station::castToStation($row); // Updated to StationModel

            array_push($list, $station);
        }

        return $list;
    }
}
?>
