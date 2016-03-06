<?php

$user_session=$_COOKIE['CookieMy'];

	    include "BD_MobBDconnect.php";
	   	    $zero_file='';
	    
	    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	      or die("Could not connect: " . mysql_error());

	   	    mysql_select_db($db_name, $connect_to_db)
	     or die("Could not select DB: " . mysql_error());
	    $qr_result = mysql_query("SELECT DISTINCT type_device, MAC_address,UUID,hardware_ver,major,minor FROM www_request  ")
	      or die(mysql_error());
?>  
<body style="background-color: #ffff99">
        
<style type="text/css">

.style1 {
	font-family: Arial;
	font-size:x-small;
}
        </style>  
          <div>   
<form method="post" action="ex1.php">
	
	<select name="interDays" id="interDays" style="width: 50px">
  <option selected="selected" value=" ">--</option>
  <option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>

  <select name="macaddress" id="macaddress" style="width: 150px">
    <!--<option value="ALL">ALL</option>-->
  <?php
  $qr_result_mac = mysql_query("SELECT DISTINCT MAC_address FROM www_request") or die(mysql_error());
       while($data2 = mysql_fetch_array($qr_result_mac)){
  echo '<option value="'. $data2['MAC_address'].'">'. $data2['MAC_address'].'</option>' ;
  }  
 ?></select>
		<input name="Submit1" type="submit" value="send" /></form>
 </div>
      
<div style="height: 550px; width:700px" align="center" >
	  <table class="sort" align="center" id="results" style="width: 750px">
	  <thead>
<tr>
<td style="font-family:Arial;color:navy;font-size:small;">&nbsp;MAC_address</td>
<td style="font-family:Arial;color:navy;font-size:small;">&nbsp;queries </td>
<td style="font-family:Arial;color:navy;font-size:small;">&nbsp;date</td>    
</tr>
</thead>
	<?php
if (isset($_POST['interDays'])) $interval = (int)$_POST['interDays'] ;
if (isset($_POST['macaddress'])) $macaddr=$_POST['macaddress'] ;

$datNow =  date('d-m-Y');
$date0 = new DateTime($datNow);
$date0->modify('-'.$interval.' day');

while($interval>=0)
{
if($macaddr!='ALL')  {
$qr_result = mysql_query("SELECT *, COUNT(* ) FROM www_request WHERE TO_DAYS(  time_active_at ) = TO_DAYS( CURDATE( ) - INTERVAL '$interval' DAY ) and MAC_address= '$macaddr'  GROUP BY  TO_DAYS(time_active_at)") or die(mysql_error());  
        }
else{
$qr_result = mysql_query("SELECT *, COUNT(* ) FROM www_request WHERE TO_DAYS(  time_active_at ) = TO_DAYS( CURDATE( ) - INTERVAL '$interval' DAY ) GROUP BY  TO_DAYS(time_active_at)") or die(mysql_error());  
    }
while($data = mysql_fetch_array($qr_result)){ 
echo '<tr><td style="width: 150px" class="style1">' . $data['MAC_address']. '</td>'; 
echo '<td style="width: 200px" class="style1">'.$data['COUNT(* )'].'</td>';
$datsh= date("d.m.Y",strtotime($data['time_active_at']));
echo '<td style="width: 200px" class="style1">'.$datsh.'</td></tr>';
}
   if(mysql_num_rows($qr_result)==0){     
echo'<tr><td style="width: 150px" class="style1">'.$macaddr.'</td>'; 
echo'<td style="width: 200px;font-family: Arial, Helvetica, sans-serif;color: #FF0000" class="style1">no active</td>'; 
echo '<td style="width: 200px;font-family: Arial, Helvetica, sans-serif;color: #FF0000" class="style1">'.$date0->format('d-m-Y').'</td></tr>';    
}
$date0->modify('+1 day');
$interval--;
	   }
	   ?>
	    
</table>
</div>
<div>
 <label id="Label1">Interval days <?php echo $interval ?> </label> 
    </div>    
        
