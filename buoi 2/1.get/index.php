<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minh hoa ve GET</title>
</head>
<body>
    <h1>Phương thức GET <h1>
    <form name="frmGET" action="form_get.php" method="get">        
        <fieldset>
            <legend>Nhập thông tin</legend>
            <p>
                <label for="hoten">Họ tên:</label>
                <input name="hoten" id="hoten"
                    type="text"
                    placeholder="Nhập họ tên" />
            </p>
            <p>
                <label for="email">Email:</label>
                <input name="email" id="email"
                    type="email"
                    placeholder="Nhập email" />
            </p>
            <p>
                <label for="password">Password:</label>
                <input name="password" id="password"
                    type="password"
                    placeholder="Nhập password" />
            </p>
            <p>
                <input type="submit" value="Login" />
                <input type="reset" value="Cancel" />
            </p>
        </fieldset>
    </form>
</body>
</html>