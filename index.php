<?php

require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:aburefko159753@localhost:7474') // Example for HTTP connection configuration (port is optional)
    /* ->addConnection('bolt', 'bolt://neo4j:password@localhost:7687') // Example for BOLT connection configuration (port is optional) */
    ->build();

$result = $client->run('MATCH (n:Artist) RETURN n, ID(n) as ID');
// a result always contains a collection (array) of Record objects

// get all records
$records = $result->getRecords();

foreach($result->getRecords() as $record){
    $name = $record->values()[0]->get('name');
    $year = $record->values()[0]->get('year');
    $ID = $record->values()[1];
    $age = 2019 - $year;
    echo    ' <form action="delete.php" method="post">
                <input type="number" value="'.$ID.'" name="ID" hidden>
                <input type="text" value="'.$name.'" name="name" hidden>
                <input type="number" value="'.$year.'" name="year" hidden>
            <table style="border-spacing: 10px;border: 1px solid red">
                <tr>
                    <th style=" padding: 10px;border-collapse: collapse; text-align: center; border: 1px solid red">Name</th>
                    <th style="padding: 10px; text-align: center;border-collapse: collapse;border: 1px solid red">Year born</th>
                    <th style="padding: 10px; text-align: center;border-collapse: collapse;border: 1px solid red">Age</th>
                </tr>
                <tr>
                    <td style="padding: 10px; text-align: center;border-collapse: collapse;border: 1px solid red">'. $name .'</td>
                    <td style="padding: 10px; text-align: center;border-collapse: collapse;border: 1px solid red" name="year"> '. $year .' </td>
                    <td style="padding: 10px; text-align: center;border-collapse: collapse;border: 1px solid red"> '. $age .' </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" id="delete">Delete</button>
                    </td>
                </tr>
            </table>
            </form>';
    /* echo '<strong>'.$name.' '.$year.'</strong><br/>';
    echo '<br/>'; */
}

// get the first or (if expected only one) the only record
$record = $result->getRecord();

/* $insertTest = new Node($client); 
 $insertTest = $client->setProperty('name', 'test'); 
 $insertTest->setProperty('year', 0000)->save(); */


//INSERT INTO DB - INPUT FIELD
/* $insertTest = $client->run("CREATE (n:Person { name: 'Artist', year: 0000 })"); */
echo '
    <form style="margin-top:20px" method="post" action="send.php">
        <input type="text" placeholder="Your name..." name="name" id="name">
        <input type="number" placeholder="Year born..." name="year" id="year">
        <br><br>
        <button type="submit" id="button">Insert</button>
    </form>
'
?>