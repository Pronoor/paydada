<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
$.ajax({
    url : "https://www.pronoor.com/shopping_cart/api/user/login",
    type : 'post',
    data : 'username=' + encodeURIComponent('admin') + '&password=' + encodeURIComponent('password'),
    dataType : 'json',
    error : function(data) {
           console.log(data);
    },
    success : function(data) {
         console.log(data);
    }
});
});
</script>

<?php $service_url = 'https://www.pronoor.com/shopping_cart/api/user/login'; // .xml asks for xml data in response
$post_data = array(
  'username' => 'admin',
  'password' => 'Admin@10',
);
$post_data = http_build_query($post_data, '', '&'); // Format post data as application/x-www-form-urlencoded

// set up the request
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // have curl_exec return a string

curl_setopt($curl, CURLOPT_POST, true);             // do a POST
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); // POST this data

// make the request
curl_setopt($curl, CURLOPT_VERBOSE, true); // output to command line
$response = curl_exec($curl);
curl_close($curl);
print "RESPONSE:\n";
var_dump($response);
exit;
// parse the response
$xml = new SimpleXMLElement($response);
$session_cookie = $xml->session_name .'='. $xml->sessid;
print "SESSION_COOKIE: $session_cookie";

file_put_contents('session_cookie.txt', $session_cookie);