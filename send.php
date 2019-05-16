<?php

require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:aburefko159753@localhost:7474') // Example for HTTP connection configuration (port is optional)
    /* ->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional) */
    ->build();

$name = $_REQUEST['name'];
$year = $_REQUEST['year'];

echo $name; 
echo $year;


$result = $client->run('CREATE (n:Artist { name: "'.$name.'", year: '.$year.' })');

header("location: index.php");
?>