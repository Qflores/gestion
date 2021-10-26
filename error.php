

<?php

$newpassword = "neohouse54";

$passHased = password_hash($newpassword,PASSWORD_DEFAULT);

echo "pass: ".$passHased;

?>