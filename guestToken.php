<?php session_start();?>
<p>Guest Token Deom with PHP</p>
<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( -1 );
include_once ("naweb/apis/Store.class.php");
include_once ("naweb/apis/Auth.class.php");
include_once ("naweb/lib/phputils.php");
include_once ("naweb/lib/utils.php");
$logger = new Logger();

$sto = new Store();
$result = $sto->initial_setup();
//var_dump($result);
set_session_details( $result->body );

$auth = new Auth();
//$result2 = $auth -> register_user("clin@one-k.com", "1kagency", null);

?>
<!--
<p>Guess Token: <?php echo $result->body->initial_setup->auth_token;?></p>
<p>Guess Result: <?php print_r( $result);?></p>
-->
<?php 
//var_dump($result2);
?>
<hr>
<?php echo ($logger -> showLog());?>