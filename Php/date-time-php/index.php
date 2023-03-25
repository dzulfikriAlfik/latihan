<?php
function getTime($strtotime = '+7 Hours')
{
   if (gettype($strtotime) == 'integer') {
      return gmdate("Y-m-d H:i:s", $strtotime);
   } else {
      return date("Y-m-d H:i:s", strtotime($strtotime));
   }
}
echo "Now : " . getTime();
echo "<br>";
echo "Last 30 Minutes : " . getTime('+7 Hours -30 Minutes');
echo "<br>";
echo "+ 5 Minutes : " . getTime('+7 Hours +5 Minutes');
echo "<br>";
$now = strtotime(getTime());
$fiveMinutes = strtotime(getTime('+7 Hours +30 Minutes'));
echo "Now : " . $now;
echo "<br>";
echo "+ 5 Minutes : " . $fiveMinutes;
echo "<br>";
echo "+ 30 Minutes - Now : " . ($fiveMinutes - $now) / 300 * -1;
echo "<br>";
echo strtotime("2022-06-15 16:55:54");
