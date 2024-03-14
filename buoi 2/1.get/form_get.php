<?
    //Nhập data gửi từ index.php
    $hoten = $_GET['hoten'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    //hiển thị thông tin 
    echo $hoten. " - " . $email . " - " . $password;
?>