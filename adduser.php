<? 
    require "inc/init.php";
    Auth::requireLogin(); //bắt buộc login
    //validation data
    $usernameError = "";
    $passwordError = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $user_pattern = "/^[A-Za-z]*$/";
        if(!preg_match($user_pattern, $username)){
            $usernameError = "Only characters are allowed";
        }
        //validation password
        $password = $_POST['password'];
        $password_pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(!preg_match($password_pattern, $password)){
            $passwordError = "Has minimum 8 characters in length, At least 1 upper characters";
        }
        if($usernameError == "" && $passwordError = ""){
            $conn = require "inc/db.php";
            //tạo ms user
            $user = new User($username, $password);
            try{
                if($user->addUser($conn)){ //hàm addUser trong classes/user.php
                    Dialog::show('Added user successfull');
                }else{
                    Dialog::show('Cannot add user');
                }
            }catch(PDOException $e){
                Dialog::show($e->getMessage());
                //có thể xử lý trang 404 ở đây...
            }
        }else{
            Dialog::show('Error!!');
            //có thể xử lý trang 404 ở đây...
        }
    }
?>
<? require "inc/header.php";?>

<!-- Tạo form nhập user -->
<div class="content">
    <form name="frmADDUSER" method="post" id="frmADDUSER">
        <fieldset>
            <legend>Add User Infor</legend>
            <div class="row">
                <label for="username">User name:</label>
                <input name="username"
                        id="username"
                        type="text" placeholder="User name"/>
                        <? echo "<span class='error'> $usernameError </span>"?>
            </div>
            <div class="row">
                <label for="password">Password:</label>
                <input name="password"
                        id="password"
                        type="password" placeholder="Password"/>
                        <? echo "<span class='error'> $passwordError </span>"?>
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Save"/>
                <input class="btn" type="reset" value="Cancel"/>
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php";?>