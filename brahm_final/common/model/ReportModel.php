<?php 
class ReportModel{
    function __construct($conn){
        $this->connection = $conn;
    }

    function currentYearPaidMember($year, $offset){
        $sql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='".$year."' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1 LIMIT 10 OFFSET ".$offset;
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $totalSql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='".$year."' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL)";
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function currentYearPaidMemberAll($year){
        $sql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.DOB, tm.M_Status, tm.Mosal, tm.Qualification, tm.Occupation, tm.Email, tm.Status_, tm.Deleted1, tm.Created_Year, tf.familyid, tf.native, tf.add1, tf.add2, tf.add3, tf.add4, tf.county, tf.city, tf.zipcode, tf.phone1, tf.phone2, tf.mobile1, tf.mobile2, tf.remarks FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo left JOIN tblfamily as tf ON  tf.familyid=tm.familyid1 WHERE ty.year='".$year."' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function lifetimePaidMember($offset){
        $sql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='LIFETIME' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1 LIMIT 10 OFFSET ".$offset;
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $totalSql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='LIFETIME' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL)";
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function lifetimePaidMemberAll(){
        $sql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.DOB, tm.M_Status, tm.Mosal, tm.Qualification, tm.Occupation, tm.Email, tm.Status_, tm.Deleted1, tm.Created_Year, tf.familyid, tf.native, tf.add1, tf.add2, tf.add3, tf.add4, tf.county, tf.city, tf.zipcode, tf.phone1, tf.phone2, tf.mobile1, tf.mobile2, tf.remarks FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo left JOIN tblfamily as tf ON  tf.familyid=tm.familyid1 WHERE ty.year='LIFETIME' AND tr.RecAmt!=0.00 AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function currentYearUnpaidMember($currentYear, $offset){
        //$sql = "SELECT trm.*, tr.RecAmt, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblrecmem as trm LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo left JOIN tblyear as ty ON ty.yearID=trm.YrID left JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='".$year."' AND tr.RecAmt=0.00 ORDER BY trm.RecMemID DESC LIMIT 10 OFFSET ".$offset;
        $sql = "SELECT tm.memberid, tm.familyid1, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblmembers as tm INNER JOIN tblyear as ty ON ty.yearID=tm.Created_Year WHERE (tm.memberid NOT IN (select trm.MemNo FROM tblrecmem as trm WHERE trm.YrID='".$currentYear."')) AND (tm.Status_ is NULL OR tm.Status_ = '' OR tm.Status_ = 'Active' OR tm.Status_ = 'Left Family') AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1 LIMIT 10 OFFSET ".$offset;
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $totalSql = "SELECT tm.memberid, tm.familyid1, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.Email FROM tblmembers as tm INNER JOIN tblyear as ty ON ty.yearID=tm.Created_Year WHERE (tm.memberid NOT IN (select trm.MemNo FROM tblrecmem as trm WHERE trm.YrID='".$currentYear."')) AND (tm.Status_ is NULL OR tm.Status_ = '' OR tm.Status_ = 'Active' OR tm.Status_ = 'Left Family') AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.familyid1";
            $row = $this->connection->query($totalSql);
            $total_rows = $row->num_rows;
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data, 'total_rows' => $total_rows];
        }else{
            return ['status' => 'fail'];
        }
    }

    function currentYearUnpaidMemberAll($currentYear){
        $sql = "SELECT tm.memberid, tm.familyid1, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tm.Relation, tm.DOB, tm.M_Status, tm.Mosal, tm.Qualification, tm.Occupation, tm.Email, tm.Status_, tm.Deleted1, tm.Created_Year, tf.native, tf.add1, tf.add2, tf.add3, tf.add4, tf.county, tf.city, tf.zipcode, tf.phone1, tf.phone2, tf.mobile1, tf.mobile2, tf.remarks FROM tblmembers as tm INNER JOIN tblfamily as tf ON tf.familyid=tm.familyid1 INNER JOIN tblyear as ty ON ty.yearID=tm.Created_Year WHERE (tm.memberid NOT IN (select trm.MemNo FROM tblrecmem as trm WHERE trm.YrID='".$currentYear."')) AND (tm.Status_ is NULL OR tm.Status_ = '' OR tm.Status_ = 'Active' OR tm.Status_ = 'Left Family') AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL) ORDER BY tm.memberid, tm.familyid1";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }


    function AllHeadMembersNotDeleted(){
        $sql = "SELECT tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tf.add1, tf.add2, tf.add3, tf.add4, tf.city, tf.county, tf.zipcode FROM tblmembers as tm LEFT JOIN tblfamily as tf ON tf.familyid=tm.familyid1 WHERE tm.Relation='HEAD'  AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL)";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function AllHeadMembersPaidNotDeleted($currentYear){
        $sql = "SELECT tm.Deleted1, tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tf.add1, tf.add2, tf.add3, tf.add4, tf.city, tf.county, tf.zipcode FROM tblmembers as tm INNER JOIN tblrecmem as trm ON tm.memberid=trm.MemNo INNER JOIN tblyear as ty ON trm.YrID=ty.yearID INNER JOIN tblreceipts as tr ON trm.RecNo=tr.RecNo INNER JOIN tblfamily as tf ON tm.familyid1=tf.familyid WHERE tm.Relation='HEAD' AND ty.year='".$currentYear."' AND tr.RecAmt!='0.00' AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL)";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function AllHeadMembersUnPaidNotDeleted($currentYear){
        //$sql = "SELECT tm.familyid1 FROM tblrecmem as trm LEFT JOIN tblyear as ty ON ty.yearID=trm.YrID LEFT JOIN tblreceipts as tr ON tr.RecNo=trm.RecNo LEFT JOIN tblmembers as tm ON tm.memberid=trm.MemNo WHERE ty.year='".$currentYear."' AND tr.RecAmt=0.00 GROUP BY tm.familyid1";
        $sql = "SELECT tm.preFix, tm.SurName, tm.FirstName, tm.MiddleName, tf.add1, tf.add2, tf.add3, tf.add4, tf.city, tf.county, tf.zipcode FROM tblmembers as tm INNER JOIN tblrecmem as trm ON tm.memberid=trm.MemNo INNER JOIN tblyear as ty ON trm.YrID=ty.yearID INNER JOIN tblreceipts as tr ON trm.RecNo=tr.RecNo INNER JOIN tblfamily as tf ON tm.familyid1=tf.familyid WHERE tm.Relation='HEAD' AND ty.year='".$currentYear."' AND tr.RecAmt='0.00' AND (tm.Deleted1!='Y' OR tm.Deleted1 IS NULL)";
        if($res->num_rows > 0){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return ['status' => 'success', 'data' => $data];
        }else{
            return ['status' => 'fail'];
        }
    }

    function last6YearList($yearArr){
        $sql = "SELECT * FROM tblyear WHERE year IN (".implode(',',$yearArr).")";
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