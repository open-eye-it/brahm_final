<?php
    include('../layout/header.php');
    $uri = $_SERVER['QUERY_STRING'];
    $query_uri_arr = explode('&', $uri);
    $family_arr = explode('=', $query_uri_arr[0]);
    $member_arr = explode('=', $query_uri_arr[1]);  
    $redirect = '';
    if(count($query_uri_arr) > 1){
        if(isset($family_arr) && isset($member_arr) && $family_arr[1] != '' && $member_arr[1] != ''){
            $familyid = $family_arr[1];
            $memberid = $member_arr[1];
            $res = $membershipModel->removeMember($familyid, $memberid);
            $redirect = 'confirm';
        }else{
            $redirect = 'confirm';
        }
    }else{
        $redirect = 'confirm';
    }
?>
<script>
    let redirect = "<?php echo $redirect; ?>";
	if(redirect === 'confirm'){
		window.location.href = "<?php echo $base_url; ?>"+"membership/member-list.php?family=<?php echo $family_arr['1']; ?>";
	}
</script>