
<?php

//ini_set('display_errors', true);

if(isset($_REQUEST['board']) && isset($_REQUEST['table']) && isset($_REQUEST['round'])) {

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

$board_select = '<select>';

while($row = $sth->fetch()){
	$board_select .= '<option value="'.$row['Board'].'">Board: '.$row['Board'].'</option>';
}

$board_select .= '</select>';

//echo $board_select;

$table = intval($_REQUEST['table']);
$round = intval($_REQUEST['round']);
$board = intval($_REQUEST['board']);

$sql = 
        //"SELECT DISTINCT PairNS, PairEW  FROM ReceivedData";
		"SELECT Direction, Bid, Counter  FROM BiddingData WHERE Table = ? AND Round = ? AND Board = ? ORDER BY Counter";
		
$sth = $db->prepare($sql);

// query parameter value(s)
$params = array($table, $round, $board);

$sth->execute($params);

$bidData = [];

while($row = $sth->fetch()){
	
	$bidData[ $row['Direction'] ][$row['Counter']] = $row['Bid'];
	
}

echo json_encode($bidData);

/*
$table_header = '<tr>';
$countCols = 0;
$table_rows = '';

foreach($bidData as $header => $value){
	$table_header .= '<th>'.$header.'</th>';
	
	foreach($value as $order=>$val){
		$table_rows .= "<td>$val</td>";
		
		$countCols++;
		
		if($countCols == 4){
			$table_rows = '<tr>'.$table_rows.'</tr>';
			$countCols = 0;
		}
	}
	
	
	
}

$table_rows = '<tr>'.$table_rows.'</tr>';

$table_header .= '</tr>';

echo '<table class="table table-striped">'.$table_header.$table_rows.'</table>';

*/

}

?>