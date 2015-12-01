<?php
use Everyman\Neo4j\Client,
    Everyman\Neo4j\Cypher\Query;

    $queryTemplate = <<<QUERY
    MATCH (m:Movie)
    RETURN m.title as movie, m.released as date 
    ORDER BY m.released DESC
    LIMIT 5
QUERY;
    $cypher = new Query($client, $queryTemplate);
    $latest5 = $cypher->getResultSet();

    $queryTemplate = <<<QUERY
    MATCH (n) 
    WHERE has(n.`rating`) 
    RETURN DISTINCT "node" as element, n.`rating` AS `rating`, n.title as movie, n.name as name 
    LIMIT 5 
    UNION ALL MATCH (a)-[r]-(m)
        WHERE has(r.`rating`) 
        RETURN DISTINCT "relationship" AS element, r.`rating` AS `rating`, a.title as movie, m.name as name
        LIMIT 5
QUERY;
    $cypher2 = new Query($client, $queryTemplate);
    $top5 = $cypher2->getResultSet();
    
    $queryTemplate = <<<QUERY
    START n=node(*)
    MATCH (n)-[r]->(x)
    RETURN n.name as actor, COUNT(r) as roles
    ORDER BY COUNT(r) DESC
    LIMIT 5
QUERY;
    $cypher3 = new Query($client, $queryTemplate);
    $actors5 = $cypher3->getResultSet();
?>

<div class="col-lg-12">
    <?php 
        foreach($actors5 as $res){
            var_dump($res["actors"]);
        }
    ?>
</div>


<div class="col-lg-4">
    <h3>Latest 5 movies</h3>
    <ul class="list-group">
        <?php 
            foreach($latest5 as $res){
        ?>
            <li class="list-group-item">
                <span class="badge"><?php echo $res['date']; ?></span>
                <a href="?p=movie&movie=<?php echo $res['movie'] ?>"><?php echo $res['movie']; ?></a>
            </li>
        <?php  }  ?>
    </ul>
</div>
<div class="col-lg-4">
    <h3>Latest 5 reviews</h3>
     <ul class="list-group">
        <?php 
            foreach($top5 as $res){
        ?>
            <li class="list-group-item">
                <span class="badge"><?php echo $res['rating']; ?></span>
                <?php echo $res['movie']; ?> - by <?php echo $res['name'] ?>
            </li>
        <?php  }  ?>
    </ul>
</div>
<div class="col-lg-4">
    <h3>Top 5 actors</h3>
    <ul class="list-group">
        <?php 
            foreach($actors5 as $res){
        ?>
            <li class="list-group-item">
                <span class="badge"><?php echo $res['roles']; ?></span>
                <?php echo $res['actor']; ?> 
            </li>
        <?php  }  ?>
    </ul>
</div>