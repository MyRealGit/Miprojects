<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['type_device'])
&& isset($_POST['MAC_address'])
&& isset($_POST['UUID'])) {
 
    $type_device = $_POST['type_device'];
    $MAC_address = $_POST['MAC_address'];
    $UUID = $_POST['UUID'];
  $advert_interval=$_POST['advert_interval'];
$broad_power=$_POST['broad_power'];

    // include db connect class
    require_once __DIR__ . '/db_connect_mobbd.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO www_request(
    type_device,
     MAC_address,
      UUID,
advert_interval,
broad_power
      
      ) VALUES(
      '$type_device',
      '$MAC_address',
       '$UUID',
    '$advert_interval',
       '$broad_power'
       )");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>