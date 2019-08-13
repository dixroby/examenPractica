<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- fontawesome-->
    <link rel="stylesheet" href="<?php echo base_url('public/fontawesome/css/fontawesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/fontawesome/css/brands.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/fontawesome/css/solid.css'); ?>">	
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.css'); ?>">  
    <link rel="stylesheet" href="<?php echo base_url('public/css/datatables.min.css'); ?>">

    <!-- jquery 3.1.1 -->
    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-3.1.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.js'); ?>"></script>    
    <script type="text/javascript" src="<?php echo base_url('public/js/datatables.min.js'); ?>"></script>
   
    
</head>
<nav class=" success navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a  class="red">Unamba Repositorio</a>
            <a class="btn btn-success" href="<?php echo base_url().'category/index'; ?>"> Caterogy</a>
            <a class="btn btn-success" href="<?php echo base_url().'degree/index'; ?>"> degree</a>
            <a class="btn btn-success" href="<?php echo base_url().'profile/index'; ?>"> profile</a>
            <hr>



        </div>

        </div>
    </div>
</nav>
<body class="container">

    <div class="container">
        <?php
        $this->load->view($contenido);
        ?>
    </div>
    <footer>
        <p></p>
    </footer>
</body>
</html>