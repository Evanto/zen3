<?php

class product {

    protected $_db;

    const DB_NAME = 'subscribeorder.db';

    function __construct() {
        if (is_file(self::DB_NAME)) {
            $this->_db = new SQLite3(self::DB_NAME);
        } else {
            $this->_db = new SQLite3(self::DB_NAME);
            $sql = "CREATE TABLE subscribeorder(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT)";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
        }
    }

    function insertproduct($email) {
        $sql = "INSERT INTO subscribeorder(email)
                 VALUES('$email')";
        $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
    }

    function __destruct() {
        unset($this->_db);
    }

}

$some = new product;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['subscribe'])) {
        $email = $_POST['subscribe'];
        $to = 'vasilukwolf@gmail.com'; // Your e-mail address here.
        $body = "Email: {$_POST['subscribe']}\n\n";
        mail($to, "Booking order from http://zenwordpress.com/", $body, "From: {$_POST['noreplayinfo@zenwordpress.com']}"); // E-Mail subject here.
        $some->insertproduct($email);
    }
}