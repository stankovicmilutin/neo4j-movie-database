<?php
    use Everyman\Neo4j\Client,
        Everyman\Neo4j\Cypher\Query;
    
    $actor = $_GET["actor"];
    
    $queryTemplate = <<<QUERY
    MATCH (m:Movie)<-[:ACTED_IN]-(a:Person)
    WHERE a.name = "$actor"
    RETURN m.title as movie, collect(a.name) as cast, collect(a.born) as born
QUERY;
    $cypher = new Query($client, $queryTemplate);
    $results = $cypher->getResultSet();
	$actors = [];
	$nodes = [];
	$rels = [];
	foreach ($results as $result) {
                
		$target = count($nodes);
		$nodes[] = array('title' => $result['movie'], 'label' => 'movie');
		foreach ($result['cast'] as $name) {
			if (!isset($actors[$name])) {
				$actors[$name] = count($nodes);
				$nodes[] = array('title' => $name, 'label' => 'actor');
			}
			$rels[] = array('source' => $actors[$name], 'target' => $target);
		}
	}
	 foreach($result["born"] as $b  )
            $born = $b;
?>

<div class='col-lg-12'>
    <div class='col-lg-4 col-lg-offset-1'>
        <div class="well">
            <h4><?php echo $name ?></h4>
            <img src="css/img/actor.jpg" style="width: 100%" alt="">
        </div>
        <div class="well">
            <a href="deleteActor.php?actor=<?php echo $name ?>"><span class="text-danger">Delete this actor</span></a>
        </div>
    </div>

    <div class='well col-lg-6 col-lg-offset-0'>
        <blockquote>
            <p><?php echo $name ?></p>
            <small><cite title="Source Title">Born: <?php echo $born ?>.</cite></small>
        </blockquote>
        <div>
            <h4>Filmography</h4>
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Movies</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($nodes as $node){
                        if($node["label"] == 'movie')
                        echo "<tr><td></td><td><a href='?p=movie&movie=". $node["title"] ."'>". $node["title"] ."</a></td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
