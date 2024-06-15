<?php
class LoginModel{
    
    public function __construct($conn){
        $this->connection = $conn;
    }
    function Login($username, $password){
        
        $pass = hash('sha512', $password);
        $sql = "SELECT * FROM tblusers WHERE usrLogin='".$username."' AND usrPass='".$pass."'";
        $res = $this->connection->query($sql);
        if($res->num_rows > 0){
            $token = hash('sha512',$this->randomString(6));
            $data = $res->fetch_assoc();
            $updateSql = "UPDATE tblusers SET token='".$token."' WHERE usrLogin='".$username."' AND usrPass='".$pass."'";
            if($this->connection->query($updateSql)){
                $permission = [];
                if($data['permission'] != ''){
                    $permission = explode(',', $data['permission']);
                }
                $admin_type = $data['super_admin'];
                $_SESSION['token'] = $token;
                $_SESSION['admin_type'] = $admin_type;
                $_SESSION['username'] = $data['usrName'];
                $_SESSION['session_time'] = time();
                $_SESSION['permission'] = $permission;
                return 'success';
            }else{
                return 'fail';    
            }
        }else{
            return 'fail';
        }
        

    }

    function randomString($length=6){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>