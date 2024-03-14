<?
    require "inc/init.php";
    //Auth::requireLogin();
    if(isset($_GET['id'])){
        $conn = require ("inc/db.php");
        $book = Book::getById($conn, $_GET['id']);
        if(!$book){
            Dialog::show('Book not found');
            return;
        }
    }else{
        Dialog::show('Input id, pls');
        return;
    }
    ////////////////////xử lý xóa book////////////////////////////
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            //upload file lên server
            $fullname = Uploadfile::process();
            if(!empty($fullname)){
                //lấy tên file hình cũ
                $oldimage = $book->imagefile;
                //gán tên file hình mới
                $book->imagefile = $fullname;
                $book->id = $_GET['id'];
                if($oldimage){
                    unlink("uploads/$oldimage");
                }
                header("Location: index.php");
            }
        }catch(PDOException $e){
            //throw new Exception($e->getMessage());
            Dialog::show($e->getMessage());
        }
    }
?>

<? require "inc/header.php";?>
<div class="content">
    <form method="post" enctype="multipart/form-data"> <!-- Có xử lý upload file lên server nên có dòng này-->
        <fieldset>
            <legend>Edit Image</legend>
            <? if($book->imagefile): ?>
                <div class="row">
                    <img src="uploads/<?=$book->imagefile?>"
                        width="180" height="180">
                </div>
            <?else:?>
                <img src="images/noimage.png"
                    width="180" height="180">
            <? endif;?>
            <div class="row">
                <label for="file">File hình ảnh</label>
                <input type="file" name="file" id="file"/>
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Update" />
                <input class="btn" type="button" value="Cancel" 
                        onclick="parent.location='index.php'"/>
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php"; ?>