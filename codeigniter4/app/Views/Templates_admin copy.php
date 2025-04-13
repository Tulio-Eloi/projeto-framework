<?php 
    include('templates/header.php');
    include('templates/nav.php');
    echo $this->renderSection('content');
    include('templates/footer.php');
    include('templates/end.php');
?>