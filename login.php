<?php
	session_start(); 
	if (isset($_SESSION['userid'])) {
	header('Location: /');
	die();
	}
	
	$userid = isset($_SESSION['userid'])?$_SESSION['userid']:0;
	$username= isset($_SESSION['user_name'])?$_SESSION['user_name']:"";
    include_once 'config_sistem.php';
    include_once 'config_ux.php'; 
	
?>
<html>
<head>
    <title><?php echo SITE_TITLE; ?></title>
	<link rel="icon" href="images/icon/login.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="extjs/adapter/ext/ext-base.js"></script>
    <script type="text/javascript">Ext.BLANK_IMAGE_URL = "extjs/resources/images/default/s.gif"</script>
    <script type="text/javascript" src="extjs/ext-all.js"></script>
</head>
<body scroll="no">
	<div id="loading">
		<img src="images/indicator.gif" width="32" height="32">	
	</div>
	<script type="text/javascript">
    var userid = <?php echo $userid; ?>;
    var username = '<?php echo ucfirst($username); ?>';
    </script>
    <div id="header">
		<h1><?php echo SITE_TITLE; ?></h1>
		<label><?php echo COMPANY; ?></label>

	</div>
	<script type="text/javascript" src="js/formLogin.js"></script>
	<script type="text/javascript" src="js/login.js"></script>  
</body>
</html>