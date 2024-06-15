<?php
class ReceiptModel{
    function __construct($conn){
        $this->connection = $conn;
    }

    function familyHeadList(){
        $sql = "select CONCAT_WS(' ', Surname, FirstName, MiddleName) as Name, familyid1 from tblmembers where relation='HEAD' order by Surname, firstname, middlename";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function createReceipt($data){
        $key_arr = array_keys($data);
        $val_arr = array_values($data);
        $key_list = implode(',', $key_arr);
        $val_list = "'".implode("','", $val_arr)."'";
        $insertSql = "INSERT INTO tblreceipts (".$key_list.") VALUES(".$val_list.")";
        if($this->connection->query($insertSql) === TRUE){
            return 'success';
        }else{
            return 'fail';
        }
    }

    function familyMember($familyid){
        $sql = "SELECT * FROM tblmembers WHERE familyid1='".$familyid."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function receiptMemberAdd($RecNo, $MemNo, $YrID){
        $sql = "INSERT INTO tblrecmem(RecNo, MemNo, YrID) VALUES('".$RecNo."', '".$MemNo."', '".$YrID."')";
        if($this->connection->query($sql) === TRUE){
            return 'success';
        }else{
            return 'fail';
        }
    }

    function checkReceiptNo($RecNo){
        $sql = "SELECT * FROM tblreceipts WHERE RecNo='".$RecNo."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function singleReceipt($RecNo){
        $sql = "SELECT * FROM tblreceipts WHERE RecNo='".$RecNo."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function receiptMemberandYear($RecNo){
        $sql = "SELECT trm.*, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, ty.yearName FROM tblrecmem as trm LEFT JOIN tblmembers as tm ON tm.memberid=trm.MemNo LEFT JOIN tblyear as ty ON ty.yearID=trm.YrID WHERE trm.RecNo='".$RecNo."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function receiptFamilyHeadID($RecNo){
        $sql = "SELECT tm.familyid1 FROM tblrecmem as trm LEFT JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE trm.RecNo='".$RecNo."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function updateReceipt($InsertArr, $RecNo){
        $sql = "UPDATE tblreceipts SET RecNo='".$InsertArr['RecNo']."', RecDate='".$InsertArr['RecDate']."', RecAmt='".$InsertArr['RecAmt']."', RecDescription='".$InsertArr['RecDescription']."', Cash_Cheque='".$InsertArr['Cash_Cheque']."', Cheque_Number='".$InsertArr['Cheque_Number']."', Bank='".$InsertArr['Bank']."', Cheque_Date='".$InsertArr['Cheque_Date']."', Remarks='".$InsertArr['Remarks']."' WHERE RecNo='".$RecNo."'";
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail', 'msg' => 'Receipt not updated, please try again.'];
        }
    }

    function deleteAllReceiptMember($RecNo){
        $sql = "DELETE FROM tblrecmem WHERE RecNo='".$RecNo."'";
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail'];
        }
    }

    function checkReceiptNoIgnoreCurrernt($newRecNo, $RecNo){
        $sql = "SELECT * FROM tblreceipts WHERE RecNo='".$newRecNo."' AND RecNo!='".$RecNo."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }
}
?>