<?php
use Everyman\Neo4j\Client,
    Everyman\Neo4j\Cypher\Query;

require 'vendor/autoload.php';
$client = new Client();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBP movie database</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav>
<?php require_once 'navigation.php'; ?>
        </nav>
        <div id='content-wrapper' class='col-lg-10 col-lg-offset-1'>
            <div class='well well-lg col-lg-6 col-lg-offset-3'>
                <form role="search" >
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search movies/actors/roles">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
            <div class='clearfix'></div>
            <div class="row">
<?php
    if(isset($_GET['p'])){
        $page = $_GET['p'];
        include 'pages/'.$page.'.php';
    }
    else
        include 'pages/home.php';
    
?>
            </div>
        </div>
        <footer>
<?php require_once 'footer.php' ?>
        </footer>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>
