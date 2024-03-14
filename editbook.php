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
    ////////////////////xử lý cập nhật book////////////////////////////
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //lấy info
        $book->id = $_GET['id']; //do index đẩy vô nên là $_GET
        $book->title = $_POST['title']; //do form post lên nên là $_POST
        $book->description = $_POST['description'];
        $book->author = $_POST['author'];
        if($book->update($conn)){
            header("Location: index.php");
        }


    }
?>
<? require "inc/header.php";?>

<!-- màn hình edit book-->
<div class="content">
    <h1 align="center">Trang Edit Book</h1>
    <form method="post" id="frmEDITBOOK">
        <fieldset>
            <legend>Edit Book</legend>
                <div class="row">
                    <label for="title">Title:</label>
                    <span class='error'>*</span>
                    <input name="title"
                            id="title"
                            type="text"
                            value="<?=htmlspecialchars($book->title)?>"/>
                </div>
                <div class="row">
                    <label for="description">Description:</label>
                    <span class='error'>*</span>
                    <input name="description"
                            id="description"
                            type="text"
                            value="<?=htmlspecialchars($book->description)?>"/>
                </div>
                <div class="row">
                    <label for="author">Author:</label>
                    <span class='error'>*</span>
                    <input name="author"
                            id="author"
                            type="text"
                            value="<?=htmlspecialchars($book->author)?>"/>
                </div>
                <div class="row">
                    <input class="btn" type="submit" value="Update" />
                    <input class="btn" type="button" value="Cancel" onclick="parent.location='index.php'"/>
                </div>
        </fieldset>
    </form>
</div>

<? require "inc/footer.php";?>
