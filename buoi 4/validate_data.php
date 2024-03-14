<?
    $nameError = "";
    $emailError = "";
    $websiteError = "";
    if(isset($_POST["submit"])){ //user ấn submit, isset là có tồn tại hay k cái đồi tượng đó
        if(empty($_POST["name"])){ //nếu name empty
            $nameError = "need name";
        }else{
            $name = $_POST['name'];
            if(!preg_match("/^[A-Za-z ]*$/", $name)){ //so sánh name vs 1 cái biểu mẫu. Nếu k cho name k 
                //có khoảng trắng thì xóa cái blank(khoảng trắng)  trong preg_match
                $nameError = "Chỉ chấp nhận ký tự hoa, thường và blank";
            }
        }
        //ktr email
        if(empty($_POST["email"])){ //nếu name empty
            $emailError = "need email";
        }else{
            $email = $_POST["email"];
            if(!preg_match("", $email)){
                $emailError = "EMail is invalid";
            }
        }
        //website
        if(empty($_POST["website"])){ //nếu name empty
            $websiteError = "need website";
        }else{
            $website = $_POST["website"];
            if(!preg_match("", $website)){
                $websiteError = "website is invalid";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> .error {color: red;} </style>

</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>Pls fill out the following fields</legend>
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name"
                        id="name" placeholder="Your Name"/>
                <? echo "<span class='error'> $nameError </span>"?>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" name="email"
                        id="email" placeholder="test@gmail.com"/>
                <? echo "<span class='error'> $emailError </span>"?>
            </p>
            <p>
                <label for="website">Website:</label>
                <input name="email"
                        id="website" placeholder="https://yoursite.com"/>
                <? echo "<span class='error'> $websiteError </span>"?>
            </p>
            <p>              
                <input type="submit" name="submit" value="Submit"/>
                <input type="reset"/>
            </p>
        </fieldset>
    </form>
</body>
</html>