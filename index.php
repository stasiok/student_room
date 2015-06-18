<?
	include_once('sys/global.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<title></title>
		<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	<head>
	<body>
		<div id="auth">
			<h1>student room</h1>
			<h2>sumy state university</h2>
			<input id="auth_rbn" type="text" placeholder="Номер зачетки"/>
			<label for="auth_rbn">8-ми значный числовой код</label>
			<input id="auth_pass" type="password" placeholder="Пароль" />
			<label for="auth_pass">От 6 до 20 символов</label>
			<div id="auth_send" class="button">Войти</div>
		</div>
	</body>
</html>