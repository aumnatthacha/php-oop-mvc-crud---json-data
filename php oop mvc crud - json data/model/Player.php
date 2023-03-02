<?php
class Player
{
    private $ConDB;
    public function __construct()
    {
        $con = new ConDB();
        $con->connect();
        $this->ConDB = $con->conn;
    }

    public function getPlayer()
    {
        $sql = "SELECT * FROM playerlist";
        $query = $this->ConDB->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function getPlayerDetail($identifier)
    {
        $sql = "SELECT * FROM playerlist where identifier = " . $identifier;
        $query = $this->ConDB->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }

    public function addPlayer($data_Player)
    {
        $sql = "INSERT INTO `playerlist` (`identifier`, `first_name`, `last_name`, `team`, `position`, `image`)";
        $sql .= " VALUES ('', :first_name, :last_name, :team, :position , :image );";
        $query = $this->ConDB->prepare($sql);
        if ($query->execute($data_Player)) {
            return true;
        } else {
            return false;
        }
    }

    public function delPlayer($identifier)
    {
        $sql = "DELETE FROM `playerlist` WHERE `identifier`='" . $identifier . "'";
        $query = $this->ConDB->prepare($sql);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editPlayereditPlayer($identifier,
        $first_name,
        $last_name,
        $team,
        $position,
        $image) {
        $sql = "UPDATE playerlist SET first_name='$first_name',
        last_name='$last_name',
        team='$team',
        position='$position',
        image='$image'
        WHERE identifier='$identifier'";
        $query = $this->ConDB->prepare($sql);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
        mysqli_close($this->ConDB);
    }

    public function getPlayerJsonDB()
    {
        $sql = "SELECT * FROM playerlist";
        $query = $this->ConDB->prepare($sql);
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $obj = json_encode($result); //แปลงค่า $result ให้เป็นค่า json แล้วเก็บไว้ในตัวแปร $obj
            return ($obj); //ส่งค่าข้อมูลในรูปแบบ json กลับคืน

        } else {
            return false;
        }
    }
}
