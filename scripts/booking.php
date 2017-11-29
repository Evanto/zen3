<?php
class product{
    protected $_db;
    const DB_NAME='product.db';
    function __construct() {
        if(is_file(self::DB_NAME)){
            $this->_db = new SQLite3 (self::DB_NAME) ;
        }
        else{
            $this->_db = new SQLite3 (self::DB_NAME) ;
            $sql ="CREATE TABLE ordering(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project TEXT,
                price TEXT,
                bookingemail TEXT)";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());   
        }
    }
    
    function insertproduct($project,$price,$bookingemail){
        $sql ="INSERT INTO ordering(project, price, bookingemail)
                 VALUES('$project','$price','$bookingemail')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
   }

    function __destruct() {
        unset($this->_db);
    }
    
}

$news = new product;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if(!empty($_POST['project']) && !empty($_POST['price']) && !empty($_POST['bookingemail'])){
	$bookingemail = $_POST['bookingemail'];
        $price = $_POST['price'];
        $project = $_POST['project'];
        $to = 'vasilukwolf@gmail.com'; // Your e-mail address here.
	$body = "\nPackage: {$_POST['project']}\n\n\nBudget: {$_POST['price']}\n\n\nEmail: {$_POST['bookingemail']}\n\n";
	mail($to, "Booking order from http://zenwordpress.com/", $body, "From: {$_POST['noreplayinfo@zenwordpress.com']}"); // E-Mail subject here.
        $news->insertproduct($project,$price,$bookingemail);
     }
}





