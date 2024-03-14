<?
    class User{
        public $id;
        public $username;
        public $password;
        /*
            Chứng thực người dùng
        */
        public static function authenticate($conn,$username,$password){
            $sql = "select * from users where username=:username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username',$username,PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS,'User');
            $stmt->execute();
            $user=$stmt->fetch();
            if($user){
                $hash = $user->password;
                return password_verify($password,$hash);
            }
        }
        /* 
            Ktr info nhập
            pass và user phải khác rỗng
        */
        private function validate(){
            return $this->username != '' && $this->password != '';
        }
        /*
            Thêm mới User
        */
        public function addUser($conn){
            if($this->validate()){
                $sql = "insert into users(username, password) 
                        values (:username, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':username', $this->username, PDO::PARAM_STR); 
                //băm password
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
                return $stmt->execute();
            }else{
                return false;
            }
        }
    }
?>