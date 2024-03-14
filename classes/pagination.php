<?
    class Pagination{
        //biến chứa cấu hình
        private $config = [
            'total' => 0,
            'limit' => 0,
            'full' => true,
            'querystring' => 'page'
        ];
        public function __construct($config = []) {
            $condition1 = isset($config['limit']) && $config['limit'] < 0;
            $condition2 = isset($config['total']) && $config['total'] < 0;
            
            if ($condition1 && $condition2) {
                die('limit và total không được nhỏ hơn 0');
            }
        
            if (!isset($config['querystring'])) {
                $config['querystring'] = 'page';
            }
        
            $this->config = $config;
        }
        
        // tính tổng số trang
        private function gettotalPage(){
            $total = $this->config['total'];
            $limit = $this->config['limit'];
            return ceil($total / $limit);
        }
        // lấy ra trang hiện tại 
        private function getCurrentPage(){
            if(isset($_GET[$this->config['querystring']]) &&
            (int)$_GET[$this->config['querystring']] >= 1){
                $t = (int)$_GET[$this->config['querystring']];
                if($t > $this->gettotalPage()){
                    return (int)$this->gettotalPage();
                }else{
                    return $t;
                }
            }else{
                return 1;
            }
        }
        // lấy trang trước
        private function getPrepage(){
            if($this->getCurrentPage() == 1){
                return 1;
            }
            else{
                return '<li class="item"><a class="text" href="'.
                $_SERVER['PHP_SELF'] . '?' . 
                $this->config['querystring'] . '=' .
                ($this->getCurrentPage() - 1) . 
                '">Previous</a></li>';
            }
        }
        // lấy trang sau
        private function getNextPage(){
            if($this->getCurrentPage() >= $this->gettotalPage()){
                return;
            }else{
                return '<li class="item"><a class="text" href="' .
                $_SERVER['PHP_SELF'] . '?' . 
                $this->config['querystring'] . '=' .
                ($this->getCurrentPage() + 1) .
                '">Next</a></li>';
            }
        }
        // vẽ thanh chuyển trang
        public function getPagination(){
            $data = '';
            if(isset($this->config['full']) && $this->config['full'] === false){
                $data .= ($this->getCurrentPage() -3) > 1 ?
                        '<li class="item">...</li>' : '';
                $current = ($this->getCurrentPage() -3) > 0?
                        ($this->getCurrentPage() -3) : 1;
                        $total = (($this->getCurrentPage() + 3) > $this->gettotalPage()?
                                $this->gettotalPage() : ($this->getCurrentPage() + 3));

                for($i = $current; $i <= $total; $i++){
                    if($i === $this->getCurrentPage()){
                        $data .= '<li class="item"><a href="#" class="text"> ' .
                            $i . '</a></li>';
                    }else{
                        $data .= '<li class="item"><a class="text" href="' .
                        $_SERVER['PHP_SELF'] . '?' .
                        $this->config['querystring'] . '=' . $i .
                        '">' . $i . '</a></li>';     
                    }
                }
                $data .= ($this->getCurrentPage() + 3) < $this->gettotalPage() ?
                        '<li class="item">...</li>' : '';
            }else{
                for($i = 1; $i <= $this->gettotalPage(); $i++){
                    if($i === $this->getCurrentPage()){
                        $data .= '<li class="item" ><a class="text" href="#">' .
                            $i . '</a></li>';

                    }else{
                        $data .= '<li class="item">< a class="text" href="' .
                                $_SERVER['PHP_SELF'] . '?' .
                                $this->config['querystring'] .'=' .
                                $i . '">'. $i . '</a></li>';
                    }
                }
            }
            //trả kq về: danh sách dạng ul
            
            return '<ul class="main-nav">' .
                    $this->getPrepage() . $data . 
                    $this->getNextPage() . '</ul>';
        }
    }
?>