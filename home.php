 <?php
include('register-back.php');
session_start();

?> 

<!DOCTYPE html>
<html lang="en">

<head>
	<title>customer relational management systems</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="CRM.css">
	<script src="crm.js"></script>

</head>

<body>
	<h2>Welcome Admin</h2>
	<p>Kindly check the history of Mails </p>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="inventory">
					<table class="table" id="you" border="1">
						<thead>
							<tr>
								<th>ID</th>
								<th>Sender's ID</th>
								<th>Recipient Email</th>
								<th>Subject</th>
								<th>Message</th>
								<th>Status</th>
								<th>Created At</th>
								<th>Updated At</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<div class="col-md-4">
				<h1> User: <?php  echo $_SESSION['username']?> You're welcome  </h1>
				<p>Please send your mail...</p>
				<form role="form" method="post" action="register-back.php" >
				<input type="hidden" name="user_id"  value="<?php  echo $_SESSION['username']?>">
					<div class="form-group">
						<label for="recipient">Recipient Email</label>
						<input type="text" class="form-control" name="recipient" placeholder="Enter the recipient email" >
					</div>
					<div class="form-group">
						<label for="name">Subject</label>
						<input type="text" class="form-control"  placeholder="what is the subject of your mail" name="subject">
					</div>
					<div class="form-group">
						<label for="name">Messsgae</label>
						<textarea name="message" class="form-control" name="messsage" placeholder="Enter your message here"></textarea>
					</div>	
					<div class="form-group" style=" width:15px; padding-top:15px; align:center;">
						<button type="submit" class="button btn-primary" name="sendmail">SendMail</button>
					</div>
					
				
				</form>


				<form action="register-back.php" method="post">
    				<button type="submit" name="Logout" >Logout</button>
				</form>
			</div>
		</div>
	</div>






</body>

</html>