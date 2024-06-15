<?php
class CheckLoginModel{
    public function __construct($conn, $base_url, $index_uri){
        $this->connection = $conn;
        $this->base_url = $base_url;
        $this->index_uri = $index_uri;
    }
    function checkLogin($token){
        $sql = "SELECT * FROM tblusers WHERE token='".$token."'";
        $check = $this->connection->query($sql);
        if($check->num_rows <= 0){
            header('Location: '.$this->base_url.'index.php');
        }else{
            if($this->index_uri == $_SERVER['REQUEST_URI']){
                header('Location: '.$this->base_url.'dashboard.php');
            }
        }
    }
}
?>