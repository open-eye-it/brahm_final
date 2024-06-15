<?php
include('../common/common.php');

$query = $_SERVER['QUERY_STRING'];
$queryArr = explode('=', $query);
$data = $receiptModel->familyMember($queryArr[1]);

if($data['status'] == 'success'){
    $res = $data['data'];
    $output = "<option value=''>-Select-</option>";
    if(count($res) > 0){
        foreach($res as $list){
            $name = $list['preFix'].' '.$list['SurName'].' '.$list['FirstName'].' '.$list['MiddleName'];
            $output .= "<option value=".$list['memberid'].">".$name."</option>";
        }
    }
    echo $output;exit;
}
?>