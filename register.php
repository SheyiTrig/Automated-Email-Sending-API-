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
				<form class="form-3" method="POST" action="register-back.php">
				    <p class="clearfix">
				        <label for="username">Username</label>
				        <input type="text" name="username"  placeholder="Please enter your username">
				    </p>
				    <p class="clearfix">
				        <label for="email">Email</label>
				        <input type="text" name="email"  placeholder="Enter your password"> 
				    </p>
                    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password"  placeholder="Enter your password"> 
				    </p>
                    <p class="clearfix">
				        <label for="cpassword">Confirm Password</label>
				        <input type="password" name="cpassword"  placeholder="Enter your password again"> 
				    </p>
                    <p class="clearfix">
				        <label for="phone"> Phone Number</label>
				        <input type="text" name="phone"  placeholder="Enter your phone"> 
				    </p>
				    <p class="clearfix">
				        <button type="submit" name="register">Register</button>
				    </p>   


                    <!-- onclick="auth()" -->
				</form>​
			</section>
			
        </div>
    </body>
</html>