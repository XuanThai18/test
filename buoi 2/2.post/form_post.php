<?
    //Nhập data gửi từ index.php
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //hiển thị thông tin 
    echo $hoten. " - " . $email . " - " . $password;
?>