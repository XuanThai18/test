<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JQuery Demo</title>
    <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/script.js"></script>

</head>
<body>
    <div class="container">
        <form class="form" id="frmRegForm" method="get" action="" name="frmRegForm">          
            <fieldset>
                <legend>Registration Form</legend>
                <div class="row">
                    <label for="firstname">First Name</label>
                    <input id="firstname" name="firstname" type="text" minlength="2">
                </div>
                <div class="row">
                    <label for="lastname">Last Name</label>
                    <input id="lastname" name="lastname"minlength="2"  type="text">
                </div>
                <div class="row">
                    <label for="email">E-Mail</label>
                    <input id="email" name="email" type="email">
                </div>
                <div class="row">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password">
                </div>
                <div class="row">
                    <label for="repassword">Confirm Password</label>
                    <input id="repassword" name="repassword" type="password">
                </div>
                <div class="row">
                    <label for="comment">Comment</label>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div class="row">                 
                    <input class="btn" type="submit" value="Register">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>