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
        //lấy info
        $book->id = $_GET['id']; //do index đẩy vô nên là $_GET
        $oldimage = $book->imagefile; // phải xóa ảnh trong server nên phải gọi lại cái ảnh (chính xác là tên )
        if($book->deleteById($conn)){
            if($oldimage){
                unlink("uploads/$oldimage");
            }
            header("Location: index.php");
            return;
        }
    }

?>
<? require "inc/header.php";?>

<!-- màn hình Del Book-->
<div class="content">
    <h1 align="center">Trang Delete Book</h1>
    <form method="post" id="frmDELBOOK">
        <fieldset>
            <legend>Delete Book</legend>
                <div class="row">
                    <label for="title">Title:</label>
                    <input name="title"
                            id="title"
                            type="text"
                            value="<?=htmlspecialchars($book->title)?>"/>
                </div>
                <div class="row">
                    <label for="description">Description:</label>
                    <input name="description"
                            id="description"
                            type="text"
                            value="<?=htmlspecialchars($book->description)?>"/>
                </div>
                <div class="row">
                    <label for="author">Author:</label>
                    <input name="author"
                            id="author"
                            type="text"
                            value="<?=htmlspecialchars($book->author)?>"/>
                </div>
                <? if($book->imagefile):?>
                    <div class="row">
                        <label for="author">Hình ảnh:</label>
                    </div>
                    <div class="row">
                        <img src="uploads/<?=$book->imagefile?>"
                                width="120" height="120"/>
                    </div>
                <? endif;?>
                <div class="row">
                    <input class="btn" type="submit" value="Delete" />
                    <input class="btn" type="button" value="Cancel" 
                            onclick="parent.location='index.php'"/>
                </div>
        </fieldset>
    </form>
</div>

<? require "inc/footer.php";?>

<script>
    $(document)
        .ready(function(){
            $('#frmDELBOOK')
                .submit(function(e){
                    e.preventDefault();
                    if(confirm("A u sure u want to xóa ?")){
                        var frm = $('<form>');
                        frm.attr('method', 'post');
                        frm.attr('action', $(this).attr('href'));
                        frm.appendTo('body');
                        frm.submit();
                    }
                });
        })
</script>