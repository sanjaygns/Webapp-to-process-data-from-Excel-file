<?php
date_default_timezone_set('UTC');
require('XLSXReader.php');
$xlsx = new XLSXReader('uploads/sample1.xlsx');
$sheetNames = $xlsx->getSheetNames();
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<style>
input[type=text], select, textarea {
    width: 50%;
    padding: 8px 10px;
    margin: 18px 10px;
    display: inline-block;
    border: 2px solid black;
    border-radius: 7px;
    box-sizing: border-box;
	
	
}

input[type=submit] {
    width: 100%;
    background-color:black;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
<head>
	<title>Cisco Migration Assistant</title>
	
</head>
<body>
<img src="top.png" width="100%" >
<div align="center">
  <form name="process" id="process" action="result.php">
    <label style="font-size:40px; " for="fname">Please select the following </label>
	  </br></br>
    

    <label for="country">Please select</label>
    <select id="chassis" name="chassis">
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[0]=="")
				break;
			  ?>
		  <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
    <?php
				  		
		}}
	  }
		?>
    </select>
    
    
    </br></br>
    <label for="country">Please select</label>
    <select id="supervisor" name="supervisor">
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[3]=="")
				break;
			  ?>
		  <option value="<?php echo $row[3]; ?>"><?php echo $row[3]; ?></option>
    <?php
				  		
		}}
	  }
		?>
    </select>
    
    </br></br>
    <label for="country">Please select</label>
    <select id="linecard" name="linecard">
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[6]=="")
				break;
			  ?>
		  <option value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></option>
    <?php
				  		
		}}
	  }
		?>
    </select>
    
    
    </br></br>
    <label for="country">Please select</label>
    <select id="powersupply" name="powersupply">
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[9]=="")
				break;
			  ?>
		  <option value="<?php echo $row[9]; ?>"><?php echo $row[9]; ?></option>
    <?php
				  		
		}}
	  }
		?>
    </select>
    
 	</br>
    
  	
    <input type="submit" value="Submit">
  </form>
</div>

<hr>



<?
$data = array_map(function($row) {
	$converted = XLSXReader::toUnixTimeStamp($row[0]);
	return array($row[0], $converted, date('c', $converted), $row[1]);
}, $xlsx->getSheetData('Dates'));
array_unshift($data, array('Excel Date', 'Unix Timestamp', 'Formatted Date', 'Data'));

?>

</body>
</html>


<?
function array2Table($data) {
	echo '<table>';
	foreach($data as $row) {
		echo "<tr>";
		foreach($row as $cell) {
			echo "<td>" . escape($cell) . "</td>";
		}
		echo "</tr>";
	}
	echo '</table>';
}

function debug($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES);
}
