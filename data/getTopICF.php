<?php
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'www.rustbolt.com/cgi-bin/mm/getTopICF.pl');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

if (empty($buffer))
{
    print "Sorry,
 No return data.<p>";
}
else
{
    print $buffer;
}
?>
