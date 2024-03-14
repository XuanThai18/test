<?
    if(session_id() === '')
        session_start();
    //tạo session đếm số lần login vào web
    if(isset($_SESSION['counter'])){
        $_SESSION['counter'] += 1;
    }else{
        $_SESSION['counter'] = 1;
        echo "Welcome yr first time in web";
    }
?>