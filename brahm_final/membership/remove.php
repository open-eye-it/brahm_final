<?php
    include('../layout/header.php');
    $uri = $_SERVER['QUERY_STRING'];
    $uri_arr = explode('=', $uri);
    $redirect = '';
    if(count($uri_arr) > 1){
        if($uri_arr[0] == 'member'){
            $familyid = $uri_arr[1];
            $res = $membershipModel->removeFamily($familyid);
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
		window.location.href = "<?php echo $base_url; ?>"+"membership/list.php";
	}
</script>