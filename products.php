<?
    require "inc/init.php";
    //đọc từ BOOKS trong DB
    // $conn = require "inc/db.php";
    // $books = Book::getAll($conn);
    // require "inc/header.php";

     // Bây giờ sẽ đọc từ Book trong DB
     $conn = require "inc/db.php";

     $total = Book::count($conn);
     $limit = 3; //hard code
     $currentpage = $_GET['page'] ?? 1;
     // thông tin cấu hình cho việc phân trang
     $config = [
         'total' => $total,
         'limit' => $limit,
         'full' => false,
     ];

     $books = Book::getPagging($conn, $limit, ($currentpage - 1) * $limit);

 //$books = Book::getAll($conn);

 require "inc/header.php"   

?>
<!-- Trình bày sản phẩm theo dạng card -->
<div class="content">
    <? foreach($books as $b):?>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="uploads/<? echo $b->imagefile ?>" alt="<? echo $b->title?>">
                </div>
                <div class="flip-card-back">
                    <h2><? echo $b->title?></h2>
                    <p><? echo $b->description?></p>
                    <p><? echo $b->author?></p>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>

<div class="content">
    <?
        // khởi tạo thanh chuyển trang với tham số config
        $page = new Pagination($config);
        // hiển thị thanh chuyển trang
        echo $page->getPagination();
    ?>
</div>

<?
    require "inc/footer.php";
?>