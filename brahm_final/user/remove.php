<?php
    include('../layout/header.php');
    $uri = $_SERVER['QUERY_STRING'];
    $uri_arr = explode('=', $uri);
    $redirect = '';
    if(count($uri_arr) > 1){
        if($uri_arr[0] == 'user'){
            $usrId = $uri_arr[1];
            $res = $userModel->removeUser($usrId);
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
		window.location.href = "<?php echo $base_url; ?>"+"user/list.php";
	}
</script>