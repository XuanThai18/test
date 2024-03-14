<?
    require "init_session.php";
    unset($_SESSION['id']);       //hủy session id
    unset($_SESSION['name']);      //hủy session name
    unset($_SESSION['counter']);
    //không hủy session['counter]

    //session_destroy(); --> hủy toàn bộ session.
    header("Location: index.php");
?>