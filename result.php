<?php
date_default_timezone_set('UTC');
require('XLSXReader.php');
$xlsx = new XLSXReader('uploads/sample1.xlsx');
$sheetNames = $xlsx->getSheetNames();
error_reporting(E_ERROR | E_PARSE);


$chassis=$_GET['chassis'];
$linecard=$_GET['linecard'];
$powersupply=$_GET['powersupply'];
$supervisor=$_GET['supervisor'];

if($chassis=="") {
	echo "<html><h1 style='top:40%;'  align='center'>Thank you </h1> </html>";
}
else {

?>

<!DOCTYPE html>
<html>

	
	
<style>
input[type=text], select, textarea {
    width: 50%;
    padding: 22px 30px;
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

button {
    width: 40%;
    background-color:black;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: orange;
}	
input[type=submit]:hover {
    background-color: #45a049;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
	table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}
</style>
<head>
	<title>Cisco Migration Assistant</title>
	
</head>
<body>

<div align="center">
  <form name="process" id="process" action="">
   <div id="content">
   <img src="top.png" width="100%" >
	  </div>
	  <div>
    <label style="font-size:40px; " for="fname">Here are the Migration result ! ! </label>
	  </br></br>
    
   
   <table id="t01">
  <tr>
   	<th>Items</th>
    <th>Current</th>
    <th>Suggested</th> 
    <th>Benifits</th>
  </tr>
   
   
   <tr>
    <td>Chassis</td>
   	<td><?php echo $chassis; ?></td>
       
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[0]==$chassis)
				break;
			  ?>
		 
    <?php
				  		
		}}
	  }
		?>
    	  <td> <?php echo $row[1];  ?></td>
		 <td> <?php echo $row[2];  ?></td>
     </tr>
     
     
     
       <tr>
    <td>Supervisor</td>
   	<td><?php echo $supervisor; ?></td>
       
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[3]==$supervisor)
				break;
			  ?>
		 
    <?php
				  		
		}}
	  }
		?>
    	  <td> <?php echo $row[4];  ?></td>
		 <td> <?php echo $row[5];  ?></td>
     </tr>
     
     
       <tr>
    <td>Line card</td>
   	<td><?php echo $linecard; ?></td>
       
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[6]==$linecard)
				break;
			  ?>
		 
    <?php
				  		
		}}
	  }
		?>
    	  <td> <?php echo $row[7];  ?></td>
		 <td> <?php echo $row[8];  ?></td>
     </tr>
     
       <tr>
    <td>Power supply</td>
   	<td><?php echo $powersupply; ?></td>
       
    <?
	  foreach($sheetNames as $sheetName) {
		  if($sheetName=="Database") {
		$sheet = $xlsx->getSheet($sheetName);
		$data=$sheet->getData();
		foreach($data as $row) { 
			if($row[9]==$powersupply)
				break;
			  ?>
		 
    <?php
				  		
		}}
	  }
		?>
    	  <td> <?php echo $row[10];  ?></td>
		 <td> <?php echo $row[11];  ?></td>
     </tr>
     
    </table>
	</div>
    
  
 	</br>
    <label for="country">Please Write your quires and our executive will get back to you !!!</label>
	</br>
 	
  	<textarea style="width: 60%;" rows="4" cols="190" name="comment" form="process" > Enter text here...</textarea>
    
    
    
    <input type="submit" value="Submit" onClick=ale()>
    
    
  </form>
  <button id="cmd">Generate PDF</button>
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
	 }
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
	  
	  
	 
?>
	<script type="text/javascript" src="js/basic.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui-1.8.17.custom.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>

<script>

	function ale() {
	
	alert("Query has been sent as an email, please wait till our executive get back to you !!!");
	return 0;
}

	
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {
    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});
	
	
</script>
