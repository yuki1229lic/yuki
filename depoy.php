<?php
exec('cd /home/yuyaserver/y-u-y-a-blog.com/public_html');
exec('git pull -u origin master');
echo "<p>Success auto deployed!</p>";
?>