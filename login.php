<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<?php 
		require_once('cssLink.php');
		require_once('startSession.php');
		require_once('header.php');
		require_once('connectvars.php');
	?>
	<link rel="stylesheet" type="text/css" href="css/loginMain.css">
</head>
<body>
<?php
	//变量定义
	$upwrg=false; 	//用户名或密码错误
	$userempty=false; 	//用户名为空
	$passempty=false;	//密码为空


	if(isset($_SESSION['username'])){
		header('location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');	//重定向到首页
	}else{

		if(isset($_POST['submit'])){

			$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$password = mysqli_real_escape_string($dbc, trim($_POST['password']));


			if(!empty($username)&&!empty($password)){

				$query="SELECT * FROM user WHERE username='$username' AND password=	'$password'";
				$result=mysqli_query($dbc,$query);

				if(mysqli_num_rows($result)){
					$row=mysqli_fetch_array($result);
					$_SESSION['username']=$row['username'];
					if($_POST['remPass']==1){
						setcookie('username',$username,time()+3600*24*7);
						setcookie('password',$password,time()+3600*24*7);
					}else{
						if(isset($_COOKIE['username'])){
							setcookie('username',$username,time()-3600);
							setcookie('password',$password,time()-3600);
						}
					}
					header('location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
				}else{
					$upwrg=true;
				}

			}

			if(empty($username))
				$userempty=true;
			if(empty($password))
				$passempty=true;
			mysqli_close($dbc);
		}else{
			if(isset($_COOKIE['username'])){
				$username=$_COOKIE['username'];
				$password=$_COOKIE['password'];
			}
		}
		?>
		<div class="logindiv">
			<form action="login.php" method="post" class="loginform">
				<p class="warning" id="warning">
				<?php
					if($userempty)
						echo '用户名不能为空！';
					else if($passempty)
						echo '密码不能为空！';
					else if($upwrg)
						echo '用户名或密码错误！';
				?>
				</p>
						
				<input type="text" name="username" class="unText inputText" placeholder="用户名/邮箱/手机号" value="<?php if(isset($username)) echo $username ?>" />
				<input type="password" name="password" class="pwText inputText" placeholder="密码" value="<?php if(isset($password)) echo $password ?>"/>
					
				<div class="remPass"><input type="checkbox" class="checkbox" value="1" name="remPass" <?php if(isset($_COOKIE['username']))   echo "checked='checked'" ?>>记住密码</div>
				<input type="submit" name="submit" value="登 录" class="loginbtn btn btn-default">
			</form>
		</div>
		<?php
		
	}
?>

</body>
</html>