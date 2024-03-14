<?
    require "init_session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
</head>
<body>
    <h2>
        Bạn đã login:
        <?
            echo $_SESSION['counter'];
        ?>
        lần.
    </h2>
    <!--kiểm tra session để yêu cầu login nếu chưa hoặc logout nếu đang login -->
    <? if(isset($_SESSION['name'])): ?>
        <h2>
            Welcome
            <? echo $_SESSION['name'];?>
        </h2>
        Click here to <a href="logout.php">Logout</a>
    <? else :?>
        <h2>
            Pleas login first
        </h2>
        Click here to <a href="login.php">Login</a>
    <? endif ;?>
</body>
</html>