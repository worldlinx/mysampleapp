
<?php

ini_set('display_errors', true);



//$dbName = $_SERVER["DOCUMENT_ROOT"] . "products\products.mdb";

$dbName = "C:\wamp64\www\AccessDB\Event1-Nov06-2018.accdb";

if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$dbName; Uid=; Pwd=;");

/*
$connStr = 
        'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};' .
        'Dbq=C:\\Users\\ch.george\\Documents\\demo_db.accdb;';

$dbh = new PDO($connStr);
*/

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 
        "SELECT DISTINCT Board FROM BiddingData WHERE counter = ?";
		
		
$sth = $db->prepare($sql);

// query parameter value(s)
$params = array(2);

$sth->execute($params);

echo '<select>';

while($row = $sth->fetch()){
	echo '<option value="'.$row['Board'].'">Board: '.$row['Board'].'</option>';
}

echo '</select>';

$sql = 
        "SELECT DISTINCT PairNS, PairEW  FROM ReceivedData";
		
		
$sth = $db->prepare($sql);

// query parameter value(s)
$params = array(2);

$sth->execute($params);
echo '<select>';

while($row = $sth->fetch()){
	echo '<option>Pairs: '.$row['PairNS'].'-'.$row['PairEW'].'</option>';
}

echo '</select>';

?>
