<div class="header">
	<div class="headCenter comWidth">
		<div class="logo fl">
			<div class="logoPicDiv"><img src="pic/logo.png" class="logopic"/></div>
			<div class="fr">
				<div class="logoDe">Waka</div>
				<div>Home</div>
			</div>
		</div>
		<ul class="nav fl">
			<li class="navli"><a href="index.php">首页</a></li>
			<li class="navli"><a href="cartoon.php">动画</a></li>
			<li class="navli"><a href="music.php">音乐</a></li>
			<li class="navli"><a href="sports.php">体育</a></li>
			<li class="navli"><a href="news.php">新闻</a></li>
			<li class="navli"><a href="technology.php">科技</a></li>
			<li class="navli"><a href="ecnomic.php">经济</a></li>
			<li class="navli"><a href="leaveword.php">留言</a></li>
		</ul>
		<?php
			if(!isset($_SESSION['username'])){

				if(basename($_SERVER['PHP_SELF'],".php")=="login"){
					?>
						<div class="logIn fr">
								<div class="logBut"><a href="register.php">注册</a></div>
						</div>
					<?php
				}else if(basename($_SERVER['PHP_SELF'],".php")=="register"){
					?>
						<div class="logIn fr">
								<div class="logBut"><a href="login.php">登录</a></div>
						</div>
					<?php
				}else{

				?>
					<div class="logIn fr">
						<div class="logBut fl">
							<a href="login.php">登录</a></div>&nbsp;|&nbsp;<div class="logBut fr">
							<a href="register.php">注册</a>
						</div>
					</div>
				<?php
				}

			}else{
				$username=$_SESSION['username'];
				?>
				<div class="fr loggeddiv" id="quit">
					<div class="logname"><?php echo $username?></div>
					<ul class="primgr">
						<li><a href="logout.php" >退出登录</a></li>
					</ul>
				</div>
				<?php
			}
		?>
	</div>
</div>