<?
    require "inc/init.php";
    $conn = require "inc/db.php";
    $page = $_GET['page'] ?? 1;
    $limit = 2;
    $offset = ($page - 1) * $limit;
    $books = Book::getPagging($conn, $limit, $offset);
    echo json_encode($books); // trả về dạng json
?>