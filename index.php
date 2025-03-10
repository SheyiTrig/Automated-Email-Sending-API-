<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>login & Register</title>
      
        
       
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<script src="auth.js"></script>
		
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #563c55 url(images/blurred.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
			<section class="main">
				<form class="form-3" method="post" action="register-back.php">
				    <p class="clearfix">
				        <label for="email">email</label>
				        <input type="text" name="email"  placeholder="enter your email">
				    </p>
				    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password"  placeholder="Password"> 
				    </p>
				    <p class="clearfix">
				        <input type="checkbox" name="remember" >
				        <label for="remember">Remember me</label>
				    </p>
				    <p class="clearfix">
				        <input type="submit" name="login" value="Sign in">
				    </p>   
					
					
					<p class="clearfix">
				        <!-- <input type="submit" name="submit" value="Sign in" onclick="auth()"> -->
						 <h4><a href="register.php"> <i>Register here</i> </a></h4>
				    </p> 
				</form>​
			</section>
			
        </div>
    </body>
</html>