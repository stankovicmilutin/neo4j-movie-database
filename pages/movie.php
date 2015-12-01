<?php
    $title = $_GET["movie"];
    use Everyman\Neo4j\Client,
        Everyman\Neo4j\Cypher\Query;
    
    
    $queryTemplate = <<<QUERY
    MATCH (m:Movie)
    WHERE m.title = "$title"
    RETURN m.title as title, m.released as date, m.tagline as tagline
    LIMIT 1
QUERY;
    $cypher = new Query($client, $queryTemplate);
    $movie = $cypher->getResultSet();
    
    foreach($movie as $m){
        $t = $m['title'];
        $r = $m['date'];
        $tag = $m['tagline'];
    }
    
    $queryTemplate = <<<QUERY
    START n=node(*) 
    MATCH n<-[r:ACTED_IN]-a 
    WHERE HAS(n.title) AND n.title =~ "$title" 
    RETURN a, r.roles as role
QUERY;
    $cypher2 = new Query($client, $queryTemplate);
    $cast = $cypher2->getResultSet();
    
// Moze i preko 1 upita, provalio sam kasnije tek    
    
    $i1 = $i2 = 0;
    foreach($cast as $c){ 
        foreach($c as $ca){
            if(isset($ca->name)) {
                $actors[$i1] = $ca->name;
                $i1++;
            }   
            foreach ($ca as $a){
                $roles[$i2] = $a;
                $i2++;
            }
        }    
    }

?>


<div class='col-lg-12'>
    <div class='col-lg-4 col-lg-offset-1'>
        <div class="well">
            <h4><?php echo $t ?></h4>
            <img src="css/img/film-reel.jpg" style="width: 100%" alt="">
        </div>
        <div class="well">
            <a href="deleteMovie.php?title=<?php echo $t ?>"><span class="text-danger">Delete this movie</span></a>
        </div>
    </div>
    
    <div class='well col-lg-6 col-lg-offset-0'>
        <blockquote>
            <p><?php echo $t ?></p>
            <small><cite title="Source Title"><?php echo $tag ?></cite></small>
        </blockquote>
        <h4>Released: <?php echo $r ?></h4>
        <div>
            <h4>Cast</h4>
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($z=0; $z<$i1; $z++){
                ?>
                <tr>
                    <td></td>
                    <td><a href="?p=actor&actor=<?php echo $actors[$z] ?>"><?php echo $actors[$z] ?></a></td>
                    <td><?php echo $roles[$z] ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class='col-lg-10 col-lg-offset-1'>
        <div class="well">
            Reviews
        </div>
    </div>
</div>