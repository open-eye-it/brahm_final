<?php
class UserModel
{
    function __construct($conn)
    {
        $this->connection = $conn;
    }

    function createUser($usrName, $usrLogin, $usrPass)
    {
        $pass = hash('sha512', $usrPass);
        $sql = "SELECT * FROM tblusers WHERE usrLogin='" . $usrLogin . "'";
        $res = $this->connection->query($sql);
        if ($res->num_rows <= 0) {
            $insertSql = "INSERT INTO tblusers (usrLogin, usrPass, usrName) VALUES('" . $usrLogin . "', '" . $pass . "', '" . $usrName . "')";
            if ($this->connection->query($insertSql) === TRUE) {
                return 'success';
            } else {
                return 'fail';
            }
        } else {
            return 'fail';
        }
    }

    function listUser($page_offset)
    {
        $sql = "SELECT * FROM tblusers WHERE super_admin != 1 ORDER BY usrId DESC LIMIT 10 OFFSET " . $page_offset;
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            $totalSql = "SELECT * FROM tblusers";
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        } else {
            return ['status' => 'fail'];
        }
    }

    function removeUser($usrId)
    {
        $sql = "DELETE FROM tblusers WHERE usrId='" . $usrId . "'";
        if ($this->connection->query($sql) === TRUE) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'fail'];
        }
    }

    function singleUser($usrId)
    {
        $sql = "SELECT * FROM tblusers WHERE usrId='" . $usrId . "'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        } else {
            return ['status' => 'fail'];
        }
    }

    function updateUser($usrName, $usrLogin, $usrId)
    {
        $selectSql = "SELECT * FROM tblusers WHERE usrLogin='" . $usrLogin . "' AND usrId!='" . $usrId . "'";
        $selectRes = $this->connection->query($selectSql);
        if ($selectRes->num_rows == 0) {
            $sql = "UPDATE tblusers SET usrName='" . $usrName . "', usrLogin='" . $usrLogin . "' WHERE usrId='" . $usrId . "'";
            if ($this->connection->query($sql) === TRUE) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'fail', 'msg' => 'User no updated, please rty again.'];
            }
        } else {
            return ['status' => 'fail', 'msg' => 'User Login already exist, please add another one.'];
        }
    }

    function userPermission($usrId)
    {
        $sql = "SELECT permission FROM tblusers WHERE usrID='" . $usrId . "'";
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        } else {
            return ['status' => 'fail'];
        }
    }

    function updatePermission($permissionData, $usrId)
    {
        $sql = "UPDATE tblusers SET permission='" . $permissionData . "' WHERE usrID='" . $usrId . "'";
        if ($this->connection->query($sql) === TRUE) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'fail'];
        }
    }
}
