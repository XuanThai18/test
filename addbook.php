<? 
    require "inc/init.php";
    //Auth::requireLogin(); //force login


    /*
        xử lý upload
        return: 
            null ==> failed
            tên file ==> thành công
    */
    function upload_file(){
        // try{
        //     if(empty($_FILES)){
        //         //nếu đang debug thì thả cmt của dòng throw ra. khi đã debug xong thì đóng dòng 
        //         //throw lại và thả dòng Dialog ra
        //         //throw new Exception('k thể upload file')
        //         Dialog::show('K thể upload file');
        //         return null;
        //     }
        //     $rs = Errorfileupload::error($_FILES['file']['error']);
        //     if($rs != 'OK'){
        //         //nếu đang debug thì thả cmt của dòng throw ra. khi đã debug xong thì đóng dòng 
        //         //throw lại và thả dòng Dialog ra
        //         //throw new Exception($rs);
        //         Dialog::show($rs);
        //         return null;
        //     }

        //     //lim size <=2MB
        //     $filemaxsize = FILE_MAX_SIZE;
        //     if($_FILES['file']['size'] > $filemaxsize){
        //         //throw new Exception('Size file phải <= ' . $filesize);
        //         Dialog::show('Size file phải <= ' . $filemaxsize);
        //         return null;
        //     }

        //     //lim loại file hình ảnh
        //     $mime_types = FILE_TYPE;
        //     //check info file để sure là file hình ảnh
        //     $fileinfo = finfo_open(FILEINFO_MIME_TYPE); //giúp đọc metadata (nơi chứa định dạng của file dù
        //     //có chỉnh file thành .png, .jpeg) của 1 file
            
        //     /*
        //         File upload sẽ lưu trong tmp_name. 
        //         Vì file sẽ từ 
        //         Đĩa -> memory (nơi có tmp) -> host
        //     */
        //     $file_mime_type = finfo_file($fileinfo, $_FILES['file']['tmp_name']);
        //     if(! in_array($file_mime_type, $mime_types)){
        //         //nếu đang debug thì thả cmt của dòng throw ra. khi đã debug xong thì đóng dòng 
        //         //throw lại và thả dòng Dialog ra
        //         //throw new Exception('Kiểu file phải là hình ảnh');
        //         Dialog::show('Kiểu file phải là hình ảnh');
        //         return null;
        //     }
        //     /**
        //         * thực hiện upload file lên thư mục uploads trên server
        //     */

        //     //chuẩn hóa tên file trước khi lên server (như là chứa khoảng trắng, ký tự đặc biệt, ...)
        //     $pathinfo = pathinfo($_FILES['file']['name']);
        //     $filename = $pathinfo['filename'];
        //     $filename = preg_replace('/[^a-zA-Z0-9_-]/','_', $filename);
            
        //     //xử lý k ghi đè nếu đã có file trùng tên trong uploads
        //     $fullname = $filename . '.' . $pathinfo['extension'];
        //     //tạo đường dẫn đến thư mục uploads trên server
        //     $fileToHost = "uploads/" . $fullname;
        //     $i = 1;
        //     while(file_exists($fileToHost)){
        //         $fullname = $filename . "-$i." . $pathinfo['extension'];
        //         $fileToHost = "uploads/" . $fullname;
        //         $i++;
        //     }
        //     $fileTmp = $_FILES['file']['tmp_name']; 
        //     //đưa file tạm trong bộ nhớ lên host
        //     $fileTmp = $_FILES['file']['tmp_name'];
        //     if(move_uploaded_file($fileTmp, $fileToHost)){
        //         return $fullname;
        //     }else{
        //         return null;
        //     }


        // }catch(Exception $e){
        //     Dialog::show($e->getMessage());
        // }
    }
    /*
       1. gọi process ==> nhận kết quả 
       2. nếu thành công ==> insert record vào books
            2.1 nếu thành công ==> chuyển về trang index.php
            2.2 thất bại ==> xóa file ảnh đã upload đó khỏi server
    */
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = require "inc/db.php";
        try{
            $fullname = Uploadfile::process();

            if(!empty($fullname)){
                //đọc data từ form nhập 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $author = $_POST['author'];
                //tạo ms đối tượng book
                $book = new Book($title, $description, $author, $fullname);
                //gọi hàm thêm 
                if($book->add($conn)){
                    //nếu upload đc thì quay vể trang index để hiển thị
                    header("Location: index.php");
                }else{
                    //nếu k thêm đc ==> xóa file hình đã upload
                    unlink("uploads/$fullname");
                }
            }
        }catch(PDOException $e){
            //nếu đang debug thì thả cmt của dòng throw ra. khi đã debug xong thì đóng dòng 
            //throw lại và thả dòng Dialog ra
            //throw new Exception($e->getMessage());
            Dialog::show($e->getMessage());
            //header("Location: 404.php?error=$e");
        }
    }
?>

<? require "inc/header.php";?>

<!-- Tạo form nhập book-->
<div class="content">
    <form method="post" id="frmADDBOOK" enctype="multipart/form-data">
        <fieldset>
            <legend>Add Book</legend>
            <div class="row">
                <label for="title">Title:</label>
                <span class='error'>*</span>
                <input name="title"
                        id="title"
                        type="text" placeholder="Title"/>
            </div>
            <div class="row">
                <label for="description">Description:</label>
                <span class='error'>*</span>
                <input name="description"
                        id="description"
                        type="text" placeholder="Description"/>
            </div>
            <div class="row">
                <label for="author">Author:</label>
                <span class='error'>*</span>
                <input name="author"
                        id="author"
                        type="text" placeholder="Author"/>
            </div>
            <div class="row">
                <label for="file">File hình ảnh</label>
                <input type="file" name="file" id="file"/>
            </div>           
            <div class="row">
                <input class="btn" type="submit" value="Save"/>
                <input class="btn" type="reset" value="Cancel"/>
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php";?>