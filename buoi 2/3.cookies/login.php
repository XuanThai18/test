<?
    //kiểm tra form có phải là phương thức POST hay khong
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == "timduongdi" && $password == "abc123"){
            //tạo cookies
            $cookie_name = "user";
            $cookie_value = $username;
            //cookie có thời gian 1 phút
            setcookie($cookie_name, $cookie_value, time() + 60,"/");
        }
        //quay về trang chủ
        header("Location: index.php");
    }
    //dòng code này exe khi user ấn submit vì cái biến username chưa có khi chưa ấn submit
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form name="frmLOGIN" method="post">
        <fieldset>
            <legend>Thông tin đăng nhập</legend>
            <p>
                <label for="username">User name:</label>
                <input name="username"
                        id="username"
                        type="text" placeholder="User name"/>
            </p>
            <p>
                <label for="password">User name:</label>
                <input name="password"
                        id="password"
                        type="password" placeholder="Password"/>
            </p>
            <p>
                <input type="submit" value="Login" />
                <input type="reset" value="Cancel" />
            </p>
        </fieldset>
    </form>
</body>
</html>
