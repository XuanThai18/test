<?
    require "init_session.php";
    $message = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        //kiểm tra
        if($username == "admin" && $password == "admin1"){
            $_SESSION['id'] = "1";
            $_SESSION['name'] = $username;
        }else{
            echo $message = "Sai Username hoặc Pass";
        }
    }
    //nếu tạo đc session (user và pass đúng) -> chuyển về trang index
    if(isset($_SESSION['id'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login (Session)</title>
</head>
<body>
    <form name="frmLOGIN" method="post">
        <div>
            <?
                if($message!="") { echo $message; }
            ?>
        </div>
    
    
        <h3>Enter Login Details</h3>
        Username:<br>
        <input type="text" name="username"><br>
        Password:<br>
        <input type="password" name="password"><br>
        <br>
        <input type="submit" value="Login">
        <input type="reset" value="Cancel">
    </form>
</body>
</html>