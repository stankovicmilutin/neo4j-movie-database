<?php
use Everyman\Neo4j\Client,
    Everyman\Neo4j\Cypher\Query;

require 'vendor/autoload.php';
$client = new Client();

    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $released = $_POST['released'];
    
    var_dump($_POST);
    
    $queryTemplate = <<<QUERY
            CREATE(NewMovie:Movie {title:"$title", tagline:"$tagline", released:$released}) RETURN NewMovie
QUERY;
    $cypher = new Query($client, $queryTemplate);
    $res = $cypher->getResultSet();
    
    header('Location: index.php');