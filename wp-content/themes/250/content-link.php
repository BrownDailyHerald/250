<?php

$content = get_the_content();

// extract regex with the help of txt2re.com
$re1='((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))';
if ($c=preg_match_all ("/".$re1."/is", $content, $matches))
{
    $httpurl = $matches[1][0];
    status_header(302);
    header('Location: ' . $httpurl);
    exit;
}
