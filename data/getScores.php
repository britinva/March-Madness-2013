<?php
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://www.rustbolt.com/cgi-bin/mm/getScores.pl');
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
    print str_replace("\'", "&rsquo;", $buffer);
}
?>
