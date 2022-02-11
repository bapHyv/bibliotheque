<?php 
    session_start();

    if (!isset($_SESSION['logged_user'])) {
        header('location:http://localhost:8888/projet_bibliotheque_clone/admin/login.php');
    }
    
    define('URL_ADMIN', 'http://localhost:8888/projet_bibliotheque_clone/admin/');
    define('URL_INCLUDE', '/opt/lampp/htdocs/projet_bibliotheque_clone/admin/');

?>