<?
    //khởi tạo session
    if(session_id() === '') session_start();
    //session_id là 1 string duy nhất bên server tạo mỗi khi có session đc tạo

    /*
        Phương thức auto load các class tương ứng    
    */
    spl_autoload_register(
        function($className){            
            $fileName = strtolower($className) . ".php";
            $dirRoot = dirname(__DIR__);
            require $dirRoot . "/classes/{$fileName}"; //gọi lớp đó vào
        }
    );
    //gọi tập tin config
    require dirname(__DIR__) . "/config.php";
    /*
        Quản lý lỗi và exception
    */
    //hàm quản lý lỗi (k phải sài quản lý lỗi của PHP, mà là tự tạo)
    function errorHandler($level, $message,$file,$line){
        throw new ErrorException($message, 0, $level, $file, $line);
    }
    //hàm quản lý exception (k phải sài quản lý lỗi của PHP, mà là tự tạo)
    function exceptionHandler($ex){
        if(DEBUG){
            echo "<h2>Lỗi</h2>";
            echo "<p>Exception: ". get_class($ex) . "</p>";
            echo "<p>Nội dung: ". $ex->getMessage() . "</p>";
            echo "<p>Tập tin: ". $ex->getFile() . " dòng thứ :" . $ex->getLine() . "</p>";
        }else{
            echo "<h2>Lỗi. Vui lòng thử lại</h2>";
            //sau này sẽ gọi trang 404.php ở đây
        }
        exit();
    }
    //đăng ký vs PHP
    set_error_handler('errorHandler');
    set_exception_handler('exceptionHandler');
?>