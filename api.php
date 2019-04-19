<?php

$api_url = ''; //Set URI

/*
 * Example of post data fields
 */
$data = array(
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'sub1' => $_POST['sub1'],
    'sub2' => $_POST['sub2'],
);

$json_data = json_encode($data);

$response = post_request($api_url, $json_data);

print_r($response);

function post_request($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',));

    $result = curl_exec($ch);

    if ($result === 0) {
        echo "API didn't respond";
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      if ($httpCode === 200) {
          echo 'Data is transfered succesfuly';
      } else if ($httpCode === 400) {
          echo 'Data is invalid! Check post data and required params';
      } else {
          echo 'Unknown error! Check api url';
      }
    }

    curl_close($ch);
}
