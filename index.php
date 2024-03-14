<?
    require "inc/init.php"; //auto load
    //sau này sẽ đọc từ BOOK trong DB (database)
    // $books = [
    //     ['title' => '1',
    //     'description' => '1',
    //     'author' => '1',
    //     'imagefile' => 'php.jpg'],
    //     ['title' => '2',
    //     'description' => '2',
    //     'author' => '2',
    //     'imagefile' => 'php.jpg'],
    //     ['title' => '3',
    //     'description' => '3',
    //     'author' => '3',
    //     'imagefile' => 'php.jpg'],
    // ];

        //Bây giờ sẽ đọc từ Book trong DB
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

<!-- Thiết kế trang index ở đây -->

<div class="content">
    <table>
        <thead> 
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Image</th>
            </tr>
        </thead>       
        
        <? static $i = 1;?>
        <? foreach($books as $b):
            
        ?>
        <tr>
            <td align="center"><? echo $i++ ?></td>
            <td><? echo $b->title ?></td>
            <td><? echo $b->description ?></td>
            <td><? echo $b->author ?></td>            
            <td align="center">
                <? if(Auth::isLoggedIn()): ?>                                            
                    <div class="row">
                            <? 
                                if($b->imagefile):
                            ?>
                                <img src="uploads/<? echo $b->imagefile?>"
                                        width="80" height="80">
                            <?else:?>
                                <img src="images/noimage.png"
                                    width="80" height="80">
                            <? endif;?>
                        <br>
                        <a href="editbook.php?id=<?=htmlspecialchars($b->id)?>">Sửa book</a>
                        <br>
                        <a href="delbook.php?id=<?=htmlspecialchars($b->id)?>">Xóa book</a>
                        <br>
                        <a href="editimage.php?id=<?=htmlspecialchars($b->id)?>">Sửa hình</a>
                    </div>
                <? endif; ?>
            </td>
        </tr>
        <? endforeach;?>

        <tfoot>
            <tr>
                <th colspan="2">Totals:</th>
                <th colspan="3"><? echo count($books)?></th>
            </tr>
        </tfoot>
    </table>
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
    require "inc/footer.php"
?>