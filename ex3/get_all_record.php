<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect_mobbd.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$result = mysql_query("SELECT id_r,type_device,MAC_address,UUID,time_active_at,time_rec_at FROM www_request") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id_r"] = $row["id_r"];
        $product["type_device"] = $row["type_device"];
        $product["MAC_address"] = $row["MAC_address"];
$product["UUID"] = $row["UUID"];
        $product["time_active_at"] = $row["time_active_at"];
        $product["time_rec_at"] = $row["time_rec_at"];
 
        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>