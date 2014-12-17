<?php

$input=$_REQUEST['text'];
$words = explode(' ', $input);
$ch = curl_init("http://api.corrasable.com/phonemes/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "text={$input}");
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
