<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie (Trang chào)</title>
</head>
<body>
    <h2>Minh họa Cookie</h2>
    <!--cách cmt của hmtl
    Nhúng php ở đây-->
    <?
        //lệnh php
        try{
            if(isset($_COOKIE["user"])){      //cái biến user đã tạo trong index.php, cái này giống gọi mảng ví dụ a[2] lấy phần tử 2 trong array
                $username = $_COOKIE["user"];
                echo "Welcome ! " . $username;
            }
            else{
                die('You a not logged - in');
            }
        }
        catch(Exception $e){
            echo $e->getMessage(); //xuất lỗi ra
        }
    ?>
</body>
</html>