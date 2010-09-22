<?php


$time = getdate();
$time = $time['weekday'] . " " . $time['month'] . " " . $time['year'] . " at " . $time['hours'].":".$time['minutes'] . ":" . $time['seconds'];

echo $time;

echo phpinfo();

?>
