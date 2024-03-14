<?
    $error = $_GET['error'];
    //đã test trong catch trong addbook.php. Dòng 121
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My book store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center row">
            <div class="col-md-6">
                <img src="images/error-2129569__340.jpg" class="img-fluid">
            </div>
            <div class="col-md-6 mt-5">
                <p class="fs-3">
                    <span class="text-danger">Rất tiếc!</span>
                    Có lỗi xảy ra.
                </p>
                <p class="lead"><? echo $error ?></p>
                <a href="index.php" class="btn btn-primary">
                    Về Trang Chủ
                </a>
            </div>
        </div>
    </div>
</body>
</html>