<?php
class MembershipModel{
    function __construct($conn){
        $this->connection = $conn;
    }

    function createFamily($data){
        $key_arr = array_keys($data);
        $val_arr = array_values($data);
        $key_list = implode(',', $key_arr);
        $val_list = "'".implode("','", $val_arr)."'";
        $insertSql = "INSERT INTO tblfamily (".$key_list.") VALUES(".$val_list.")";
        if($this->connection->query($insertSql) === TRUE){
            return 'success';
        }else{
            return 'fail';
        }
    }

    function listFamily($page_offset, $search=''){
        $like_string = "native LIKE '%".$search."%' OR add1 LIKE '%".$search."%' OR add2 LIKE '%".$search."%' OR add3 LIKE '%".$search."%' OR add4 LIKE '%".$search."%' OR county LIKE '%".$search."%' OR city LIKE '%".$search."%' OR zipcode LIKE '%".$search."%' OR phone1 LIKE '%".$search."%' OR phone2 LIKE '%".$search."%' OR mobile1 LIKE '%".$search."%' OR mobile2 LIKE '%".$search."%'";
        if($search != ''){
            $sql = "SELECT * FROM tblfamily WHERE ".$like_string." ORDER BY familyid DESC LIMIT 10 OFFSET ".$page_offset;
        }else{
            $sql = "SELECT * FROM tblfamily ORDER BY familyid DESC LIMIT 10 OFFSET ".$page_offset;
        }
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            if($search != ''){
                $totalSql = "SELECT * FROM tblfamily WHERE ".$like_string;
            }else{
                $totalSql = "SELECT * FROM tblfamily";
            }
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function removeFamily($familyid){
        $sql = "DELETE FROM tblfamily WHERE familyid='".$familyid."'";
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail'];
        }
    }

    function singleFamily($familyid){
        $sql = "SELECT * FROM tblfamily WHERE familyid='".$familyid."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function updateFamily($data, $familyid){
        $sql = "UPDATE tblfamily SET native='".$data['native']."', add1='".$data['add1']."', add2='".$data['add2']."', add3='".$data['add3']."', add4='".$data['add4']."', county='".$data['county']."', city='".$data['city']."', zipcode='".$data['zipcode']."', phone1='".$data['phone1']."', phone2='".$data['phone2']."', mobile1='".$data['mobile1']."', mobile2='".$data['mobile2']."', remarks='".$data['remarks']."' WHERE familyid='".$familyid."'";
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail', 'msg' => 'Family no updated, please rty again.'];
        }
    }

    function listMember($familyId, $page_offset){
        $sql = "SELECT * FROM tblmembers WHERE familyid1='".$familyId."' ORDER BY memberid DESC LIMIT 10 OFFSET ".$page_offset;
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $totalSql = "SELECT * FROM tblmembers WHERE familyid1='".$familyId."'";
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function YearList(){
        $sql = "SELECT * FROM tblyear ORDER BY yearID DESC";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function createMember($data){
        $key_arr = array_keys($data);
        $val_arr = array_values($data);
        $key_list = implode(',', $key_arr);
        $val_list = "'".implode("','", $val_arr)."'";
        $insertSql = "INSERT INTO tblmembers (".$key_list.") VALUES(".$val_list.")";
        if($this->connection->query($insertSql) === TRUE){
            return 'success';
        }else{
            return 'fail';
        }
    }

    function singleMember($familyId, $memberId){
        $sql = "SELECT * FROM tblmembers WHERE memberid='".$memberId."' AND familyid1='".$familyId."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_assoc();
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function updateMember($data, $memberId, $familyId){
        $sql = "UPDATE tblmembers SET preFix='".$data['preFix']."', SurName='".$data['SurName']."', FirstName='".$data['FirstName']."', MiddleName='".$data['MiddleName']."', Relation='".$data['Relation']."', DOB='".$data['DOB']."', M_Status='".$data['M_Status']."', Mosal='".$data['Mosal']."', Qualification='".$data['Qualification']."', Occupation='".$data['Occupation']."', Email='".$data['Email']."', Created_Year='".$data['Created_Year']."', Status_='".$data['Status_']."' WHERE familyid1=".$familyId." AND memberid=".$memberId;
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail', 'msg' => 'Member not updated, please try again.'];
        }
    }

    function removeMember($familyId, $memberId){
        $sql = "DELETE FROM tblmembers WHERE familyid1=".$familyId." AND memberid=".$memberId;
        if($this->connection->query($sql) === TRUE){
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail'];
        }
    }

    function SearchMember($search_name){
        $sql = "SELECT tm.memberid, tm.familyid1, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tf.add1, tf.add2, tf.add3, tf.add4 FROM tblmembers as tm INNER JOIN tblfamily as tf ON tf.familyid=tm.familyid1 WHERE (tm.Deleted1 != 'Y' OR tm.Deleted1 IS NULL ) AND (tm.SurName LIKE '%".$search_name."%' OR tm.FirstName LIKE '%".$search_name."%' OR tm.MiddleName LIKE '%".$search_name."%')";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }
}
?>