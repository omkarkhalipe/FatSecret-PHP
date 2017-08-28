# FatSecret-PHP
PHP code to use fatsecret.com REST API 
 
 $params should be alphabetically sorted
 
 Eg To get a recipe with ID known
 
 $params = "format=xml&";
 
$params .= "method=recipe.get&";

$params .= "oauth_consumer_key=$consumer_key&"; // ur consumer key

$params .= "oauth_nonce=".rand()."&";

$params .= "oauth_signature_method=HMAC-SHA1&";

$params .= "oauth_timestamp=".time()."&";

$params .= "oauth_version=1.0&";

$params .= "recipe_id=".urlencode($_GET['srch']);


Eg To search a recipe with keyword 

 $params = "format=xml&";
 
$params .= "method=recipes.search&";

$params .= "oauth_consumer_key=$consumer_key&"; // ur consumer key

$params .= "oauth_nonce=".rand()."&";

$params .= "oauth_signature_method=HMAC-SHA1&";

$params .= "oauth_timestamp=".time()."&";

$params .= "oauth_version=1.0&";

$params .= "search_expression=".urlencode($_GET['srch']);
