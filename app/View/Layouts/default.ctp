<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
$logout =  __d('cake_dev', 'LogOut...');
$tohome =  __d("mysite", "To Users List");

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('menu');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->script('/js/jquery');

		$adminInfo = $this->Session->read('adminInfo');
		$userInfo = $this->Session->read('userInfo');
		$groupInfo = $this->Session->read('groupInfo');
		$clientInfo = $this->Session->read('clientInfo');

//		$adminInfo = Configure::read('adminInfo');
//		$userInfo = Configure::read('userInfo');
//		$groupInfo = Configure::read('groupInfo');
//		$clientInfo = Configure::read('clientInfo');

		$userRole = $userInfo['role_id'];

//		debug($adminInfo);
//		debug($groupInfo);
//		debug($clientInfo);
//		debug($userInfo);
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			<div class="header_info" style="display: flex; text-align: center; margin: 15px">
				<div class="client_header" style="width: 33%">
					<?php
						if (isset($clientInfo) && $clientInfo != null)
						{
							echo( "<img src='".UPLOAD.$clientInfo["logo_url"]."' style='margin: 10px 0;'> ");
							echo ("<p style=\"line-height: 25px\"> ".$clientInfo['description']." <br>".$clientInfo['contact']."<br>".$clientInfo['email']."</p>");
						}
					?>
				</div>
				<div class="userInfo_header" style="width: 33%">
						<div class="username">
							<p class="login_text" style="color: #999;">You are logged in as:</p>
							<p class="login_value" style="font-size: 25px; text-shadow: 5px 5px 5px #000;"><?php echo ($userInfo != null) ? $userInfo['username'] : "not Logged In"; ?></p>
						</div>
						<div class="company">
							<p class="login_text" style="color: #999;">Company:</p>
							<p class="login_value"><?php echo "Melbourne Water"; ?></p>
						</div>
						<div class="login_time">
							<p class="login_text" style="color: #999;">Login Data/Time:</p>
							<p class="login_value"><?php echo (isset($userInfo)) ? $userInfo['login_date'] : ""; ?></p>
						</div>
				</div>
				<div class="group_header" style="width: 33%">
					<?php
						if (isset($groupInfo) && $groupInfo != null)
						{
							echo( "<img src='".UPLOAD.$groupInfo["logo_url"]."'> ");
							echo ("<p style=\"line-height: 25px\"> ".$groupInfo['description']." <br>".$groupInfo['contact']."<br>".$groupInfo['email']."</p>");
						}
						else //if (isset($adminInfo) && $adminInfo != null)
						{
							echo( "<img src='".UPLOAD."footer.png'> ");
							echo ("<p style=\"line-height: 25px\"> ".$groupInfo['description']." <br>".$groupInfo['contact']."<br>".$groupInfo['email']."</p>");
						}
					?>
				</div>
			</div>
			<?php if ($userInfo != null) { ?>
					<div id="navMenu">
						<ul><li><a href="#">Home</a></li></ul>
				<?php if ($userRole == 1) {	?>
						<ul><li>
							<?php echo $this->Html->link('Groups', '/groups/index'); ?>
							<ul>
								<li><?php echo $this->Html->link('Groups-Clients', '/groupsclients/index'); ?></li>
								<li><?php echo $this->Html->link('Groups-Users', '/groupsusers/index'); ?></li>
							</ul>
						</li></ul>
						<ul><li>
							<?php echo $this->Html->link('Clients', '/clients/index'); ?>
							<ul>
								<li><?php echo $this->Html->link('Clients-Users', '/clientsusers/index'); ?></li>
								<li><?php echo $this->Html->link('Clients-Allocation', '/allocations/index'); ?></li>
							</ul>
						</li></ul>
						<ul><li><?php echo $this->Html->link('Users', '/users/index'); ?></li></ul>
				<?php }	else if ( ($userRole == 2) || ($userRole == 3) ) { ?>
						<ul><li>
							<?php echo $this->Html->link('Groups-Users', '/groupsusers/index'); ?>
							<ul><li><?php echo $this->Html->link('Groups-Clients', '/groupsclients/index'); ?></li></ul>
						</li></ul>
						<ul><li>
							<?php echo $this->Html->link('Clients-Users', '/clientsusers/index'); ?>
							<ul><li><?php echo $this->Html->link('Clients-Allocation', '/allocations/index'); ?></li></ul>
						</li></ul>
				<?php }	else if ( ($userRole == 4) || ($userRole == 5) ) { ?>
						<ul><li><?php echo $this->Html->link('Clients-Users', '/clientsusers/index'); ?></li></ul>
						<ul><li><a href="#">Reports</a></li></ul>
						<ul><li><?php echo $this->Html->link('Allocation', '/allocations/index'); ?></li></ul>
						<ul><li><a href="#">Query</a></li></ul>
				<?php } ?>
						<ul><li><a href="#">Contacts</a></li></ul>
						<ul><li><?php echo $this->Html->link($logout, array('controller'=>'users', 'action'=>'logout')); ?></li></ul>
					</div>
			<?php }	?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

		</div>
		<div id="footer">
			<h5 style="text-align: center;">Copyright 2016 Telco Management Pty Ltd</h5>
<!--			<img style="float: right" class="client_logo" src='UPLOAD/footer.png'>-->
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
