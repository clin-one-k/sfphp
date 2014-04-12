<p>Guest Token Deom with PHP</p>
<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( -1 );
include_once ("naweb/apis/Store.class.php");
include_once ("naweb/lib/utils.php");
$sto = new Store();
$result = $sto->initial_setup();
set_session_detilas($result->body);
?>
<p>Guess Token: <?php var_dump($result->body->initial_setup->auth_token);?></p>