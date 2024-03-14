<?
    // session_start();
    
    // require "config.php";
    // require "classes/database.php";
    // require "classes/user.php";
    //cách viết k cần nhìu lệnh require = cách tự động gọi các lớp tương ứng
    require "inc/init.php";
    $conn = require "inc/db.php";
    
    //kiểm tra connect
    if($conn){
        //echo "Kết nối thành công.";
        $username = "abcdef";
        $password = "abc123";
        //chứng thực user
        $rs = User::authenticate($conn, $username, $password);
        if($rs){
            echo "Login success.";
            //tạo session
            $_SESSION['id'] = "????";
            $_SESSION['user'] = $username;
            //thay đổi id session ???
        }
        else{
            echo "Login fail. Sai pass or user.";
        }
    }else{

    }
?>