<?php
	session_start(); 
	if (!isset($_SESSION['userid'])) {
	header('Location: login.php');
	die();
	}
	
	$userid = isset($_SESSION['userid'])?$_SESSION['userid']:0;
	$username= isset($_SESSION['user_name'])?$_SESSION['user_name']:"";
	$accessid= isset($_SESSION['group_id'])?$_SESSION['group_id']:0;
		
    include_once 'config_sistem.php';
    include_once 'config_ux.php'; 
?>
<html>
<head>
    <title><?php echo SITE_TITLE; ?></title>
	<link rel="icon" href="images/icon/index2.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all-notheme.css">
    <link rel="stylesheet" type="text/css" title="blue" href="extjs/resources/css/xtheme-blue.css" /> 
    <link rel="stylesheet" type="text/css" title="gray" href="extjs/resources/css/xtheme-gray.css" />
	<link rel="stylesheet" type="text/css" title="access" href="extjs/resources/css/xtheme-access.css" />
        <!-- <link rel="stylesheet" type="text/css" href="extjs/resources/css/xtheme-gray.css"> -->
    <!-- custom includes -->
        <link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="add-on/message/examples.css">    
        <?php foreach ($ux_css as $css) {?>
	<link rel="stylesheet" type="text/css" href="extjs/ux/<?php echo $css;?>">
        <?php } ?>
</head>
<body scroll="no">
	<div id="loading">
		<img src="images/indicator.gif" width="32" height="32">	
	</div>
    <script type="text/javascript" src="extjs/adapter/ext/ext-base.js"></script>
    <script type="text/javascript">Ext.BLANK_IMAGE_URL = "extjs/resources/images/default/s.gif"</script>
    <script type="text/javascript" src="extjs/ext-all.js"></script>
    <?php foreach ($ux_js as $js) {?>
    <script type="text/javascript" src="extjs/ux/<?php echo $js;?>"></script>
    <?php } ?>
    <script type="text/javascript">
    var userid = <?php echo $userid; ?>;
    var username = '<?php echo ucfirst($username); ?>';

    </script>
 
    <div id="header">
		<h1><?php echo SITE_TITLE; ?></h1>
		<label><?php echo COMPANY; ?></label>
		<form id="styleswitcher">
            <label for="styleswitcher_select">Theme: </label>
            <select name="styleswitcher_select" id="styleswitcher_select">
                <option value="blue" selected="true">Blue</option>
                <option value="gray">Gray</option>
				<option value="access">Accessibility</option>
            </select>
        </form>
	</div>
    
	<div style="display:none;">
    
        <!-- Start page content -->
        <div id="start-div">
            <?php include_once 'start.php';  ?>
        </div>
        
        <!-- Menu Master Details -->

	<ul id="control-view" class="x-hidden">
		<li>
			<img src="images/s.gif" class="chk-pwd"/>
			<a id="user-profile" href="#">User Profile</a>
		</li>  
		<?php if ($accessid==1): ?>
		<li>
			<img src="images/s.gif" class="user-comment"/>
			<a id="user-manager" href="#">User Manager</a>
		</li>
		<li>
			<img src="images/s.gif" class="app"/>
			<a id="menu-manager" href="#">Menu Event Manager</a>
		</li>
		<!--  
		<li>
			<img src="images/s.gif" class="db-refresh"/>
			<a id="db-backup" href="#">Database Manager</a>
		</li>
		-->	
		<?php endif;  ?>
		<li>
			<img src="images/s.gif" class="logout"/>
			<a id="logout" href="#">Logout</a>
		</li>
	</ul>
    </div>    
    <script type="text/javascript" src="js/formLogin.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="add-on/message/examples.js"></script>    
</body>
</html>
