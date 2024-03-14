<?
    require "inc/init.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = require "inc/db.php";
        $username = $_POST['username'];
        $password = $_POST['password'];


        //timduongdi && 123. Trong users của DB db_ct07 
        if(User::authenticate($conn, $username, $password)){
            Auth::login();
            header("Location: index.php");
        }else{
            Dialog::show('Invalid Username & Pass');
        }
        // if($username == "db_ct07" && $password == "123"){
        //     Auth::login();
        //     header("Location: index.php");
        // }else{
        //     Dialog::show('Invalid Username & Pass');
        // }
    }
?>
<?require "inc/header.php";?>

<!-- Tạo form login-->
<div class="content">
    <form method="post" action="" id="frmLOGIN">
        <fieldset>
            <legend>Login System</legend>
            <div class="row">
                <label for="username">User Name:</label>
                <span class='error'>*</span>
                <input name="username"
                    id="username"
                    type="text" placeholder="User name"/>
            </div>
            <div class="row">
                <label for="password">Password:</label>
                <span class='error'>*</span>
                <input name="password"
                    id="password"
                    type="password" placeholder="Password"/>
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Login"/>
                <input class="btn" type="reset" value="Cancel"/>
            </div>
        </fieldset>
    </form>
</div>

<? require "inc/footer.php";?>