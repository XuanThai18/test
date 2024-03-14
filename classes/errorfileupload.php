<?
    class Errorfileupload{
        public static function error($code){
            switch($code){
                case UPLOAD_ERR_OK: 
                    $msg = 'OK';
                    break;
                case UPLOAD_ERR_INI_SIZE: 
                    $msg = 'OverSize, chỉ đc upload file có size = 2MB'; //định nghĩa size trong config.php
                    break;
                case UPLOAD_ERR_FORM_SIZE: 
                    $msg = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified 
                    in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL: 
                    $msg = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_CANT_WRITE: 
                    $msg = 'K ghi đc tập tin lên trên đĩa (file bị hư,...)';
                    break;
                case UPLOAD_ERR_NO_FILE: 
                    $msg = 'Bạn hãy chọn 1 pic từ máy tính của bạn. Không đc để trống cái upload file của Books';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR: 
                    $msg = 'Không đưa đc file của bạn vào thư mục tạm - TmpDir (Khi mất điện nếu đang upload file .png)';
                    break;
                case UPLOAD_ERR_EXTENSION: 
                    $msg = 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain
                    which extension caused the file upload to stop; examining the list of loaded extensions
                    with phpinfo() may help.';
                    break;                 
                /**
                    UPLOAD_ERR_OK
                    Value: 0; There is no error, the file uploaded with success.

                    UPLOAD_ERR_INI_SIZE
                    Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.

                    UPLOAD_ERR_FORM_SIZE
                    Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified 
                    in the HTML form.
                    (Tệp đã tải lên vượt quá lệnh MAX_FILE_SIZE đã được chỉ định trong biểu mẫu HTML.)

                    UPLOAD_ERR_PARTIAL
                    Value: 3; The uploaded file was only partially uploaded.
                    (Tệp đã tải lên chỉ được tải lên một phần.)

                    UPLOAD_ERR_NO_FILE
                    Value: 4; No file was uploaded.

                    UPLOAD_ERR_NO_TMP_DIR
                    Value: 6; Missing a temporary folder.

                    UPLOAD_ERR_CANT_WRITE
                    Value: 7; Failed to write file to disk.

                    UPLOAD_ERR_EXTENSION
                    Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain
                    which extension caused the file upload to stop; examining the list of loaded extensions
                    with phpinfo() may help.
                    (Tiện ích mở rộng PHP đã dừng tải tệp lên. PHP không cung cấp cách xác định tiện ích mở
                    rộng nào khiến quá trình tải tệp lên bị dừng; việc kiểm tra danh sách các tiện ích mở 
                    rộng đã tải bằng phpinfo() có thể hữu ích.)
                 */

                default:
                    $msg = 'Unknow error';
                    break;
            }
            return $msg;
        }
    }
?>