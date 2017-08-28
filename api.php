<?php

$consumer_key = "xxx";
$secret_key = "yyy";

$base = rawurlencode("GET")."&";
$base .= "http%3A%2F%2Fplatform.fatsecret.com%2Frest%2Fserver.api&";
//sort params by abc....necessary to build a correct unique signature
$params = "format=xml&";
$params .= "method=recipe.get&";
$params .= "oauth_consumer_key=$consumer_key&"; // ur consumer key
$params .= "oauth_nonce=".rand()."&";
$params .= "oauth_signature_method=HMAC-SHA1&";
$params .= "oauth_timestamp=".time()."&";
$params .= "oauth_version=1.0&";
$params .= "recipe_id=".urlencode($_GET['srch']);

$params2 = rawurlencode($params);
$base .= $params2;

$sig= base64_encode(hash_hmac('sha1', $base, "$secret_key&",
    true)); // replace xxx with Consumer Secret

$url = "http://platform.fatsecret.com/rest/server.api?".
    $params."&oauth_signature=".rawurlencode($sig);

//echo $url;
list($output,$error,$info) = loadFoods($url);
echo '<pre>';
if($error == 0){
    if($info['http_code'] == '200')
        echo $output;
    else
        die('Status INFO : '.$info['http_code']);
}

else
    die('Status ERROR : '.$error);
function loadFoods($url)
{
    // create curl resource
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, $url);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output contains the output string
    $output = curl_exec($ch);
    $error = curl_error($ch);
    $info = curl_getinfo($ch);
    // close curl resource to free up system resources
    curl_close($ch);
    return array($output,$error,$info);
}

?>
