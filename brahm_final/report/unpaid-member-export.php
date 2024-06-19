<?php
$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/brahm_final/';
include('../common/common.php');

$page_uri = $_SERVER['QUERY_STRING'];
$yearArr = explode('=', $page_uri);

$errMsg = '';
$currentYear = date('Y');
$list = $reportModel->currentYearUnpaidMemberAll($yearArr[1]);
//echo "<pre>";print_r($list);exit;
$export_header = ["MemberID", "FamilyID", "Salulation", "Surname", "First Name", "Middle Name", "Relation", "Date of Birth", "Marital Status", "Mosal", "Qualification", "Occupation", "Email", "Status", "Deleted1", "Created Year", "Native", "Add1", "Add2", "Add3", "Add4", "County", "City", "Zip", "Phone1", "Phone2", "Mobile1",  "Mobile2", "Remarks"];
$export_val = [];
if ($list['status'] == 'success') {
    $data = $list['data'];
    if (count($data) > 0) {
        foreach ($data as $list) {
            $export_val[] = [$list['memberid'], $list['familyid1'], $list['preFix'], $list['SurName'], $list['FirstName'], $list['MiddleName'], $list['Relation'], $list['DOB'], $list['M_Status'], $list['Mosal'], $list['Qualification'], $list['Occupation'], $list['Email'], $list['Status_'], $list['Deleted1'], $list['Created_Year'], $list['native'], $list['add1'], $list['add2'], $list['add3'], $list['add4'], $list['county'], $list['city'], $list['zipcode'], $list['phone1'], $list['phone2'], $list['mobile1'], $list['mobile2'], $list['remarks']];
        }
    }
} else {
    $errMsg = 'fail';
}

$export_file_name = 'current-unpaid-member-' . date('Ymd') . '.xls';
$excelObj = new ExportExcel($export_file_name);
$excelObj->setHeadersAndValues($export_header, $export_val);
$excelObj->GenerateExcelFile();
