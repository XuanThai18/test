<?
    class Book{
        public $id;
        public $title;
        public $description;
        public $author;
        public $imagefile;

        public function __construct($title = null, $description = null, $author = null, $imagefile = null){
            $this->title = $title;
            $this->description = $description;
            $this->author = $author;
            $this->imagefile = $imagefile;
        }

        private function validate(){
            return  $this->title && 
                    $this->description && 
                    $this->author;
        }

        public static function count($conn) {
            try {
                $sql = "SELECT COUNT(id) AS count FROM books";
                return $conn->query($sql)->fetchColumn();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return -1;
            }
        }
        
        
        public function add($conn){
            if($this->validate()){
                try{
                    $sql = "Insert into books (title, description, author, imagefile) values (:title, :description, :author, :imagefile)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':title',$this->title,
                                     PDO::PARAM_STR);
                    $stmt->bindValue(':description',$this->description,
                                    PDO::PARAM_STR);
                    $stmt->bindValue(':author',$this->author,
                                    PDO::PARAM_STR);
                    $stmt->bindValue(':imagefile',$this->imagefile,
                                    PDO::PARAM_STR);
                    return $stmt->execute();
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }else{
                return false;
            }
            
        }

        public static function getAll($conn){
            try{
                $sql = "select * from books order by title asc";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Book'); 
                //
                if($stmt->execute()){
                    $books = $stmt->fetchAll();
                    return $books;
                }

            }catch(PDOException $e){
               echo $e->getMessage();
               return null;
            }
        }

        public static function getPagging($conn, $limit, $offset){ 
            try{
                $sql = "SELECT * FROM books ORDER BY title ASC LIMIT :limit OFFSET :offset";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS,'Book');
                if($stmt->execute()){
                    $books = $stmt->fetchAll();
                    return $books;
                }
            } catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }
        

        public static function getById($conn, $id){
            try{
                $sql = "select * from books where id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                //$stmt = $conn->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE ,'Book');
                if($stmt->execute()){
                    $book = $stmt->fetch(); // đọc 1 quyển nên k phải fetchAll()
                    return $book;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }           
        
        public function update($conn){
            if($this->validate()){
                try{
                    $sql = "update books
                            set title=:title,
                                description=:description,
                                author=:author
                            where id=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
                    $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                    $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
                    //$stmt = $conn->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);
                    $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                    return $stmt->execute();    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }else{
                return false;
            }
        }

        public function delete(){ //deleteAll
            try{

            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function deleteById($conn){
            try{
                $sql = "delete from books where id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id',$this->id,PDO::PARAM_INT);
                return $stmt->execute();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
                //echo $e->getMessage();
                return false;
            }
        }
        /**
         * hàm cập nhật hình ảnh
        */
        public function updateImage($conn){
            try{
                $sql = "update books
                        set imagefile = :imagefile where id=:id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                //vì $imagefile có thể là null
                $stmt->bindValue(':imagefile', $this->imagefile,
                                $this->imagefile == null ?
                                PDO::PARAM_NULL : PDO::PARAM_STR);
                return $stmt->execute();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
                return false;
            }
        }
    }
?>