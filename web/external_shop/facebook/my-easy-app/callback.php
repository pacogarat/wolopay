<?php
file_put_contents(__DIR__.'/log', 'GET: '.print_r($_GET, true).', POST: '.print_r($_POST, true). "-END- \n", FILE_APPEND);
echo $_GET['hub_challenge'];