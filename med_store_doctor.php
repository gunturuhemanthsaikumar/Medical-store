<?php
	session_start();
	if(!isset($_SESSION['doctor']))
	{
		header("Location: index.html");
	}
	include 'config.php';
	if(!($dbconn = @mysqli_connect($dbhost, $dbuser, $dbpass,$db))) exit('Error connecting to database.');
	
?>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
		<![if !IE]>
		<link href='css/style.css' rel='stylesheet' type='text/css'>
		<![endif]>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script>
			function ajaxForQuery(id)
			{
				$.ajax({type:'POST', url: 'ownersqlq.php', data:{name:id}, success: function(response)
				{
					$('#medowner').find('#'+id).html(response);
				}
				});
				return false;
			}
			ajaxForQuery("medicines");
			ajaxForQuery("medicines_compounds");
			ajaxForQuery("medicines_pharma");
			ajaxForQuery("employees");
			ajaxForQuery("transactions");

			function bills()
			{
				$.ajax({type:'POST', url: 'bills.php', data:$('#medownerbills').serialize(), success: function(response)
				{
					$('#medownerbills').find('#billsdisp').html(response);
				}
				});
				return false;
			}

			function profitlosscalc()
			{
				$.ajax({type:'POST', url: 'pl.php', data:$('#profitloss').serialize(), success: function(response)
				{
					$('#profitloss').find('#pldisp').html(response);
				}
				});
				return false;
			}
		</script>
		<title>Medical Store Management</title>
	</head>

	<body>

		<form id="medowner" style="height:;">
			<center>
				<h1>Medical Store Management - OWNER</h1>
				<hr />
			</center>

			<label for="tables" style="font-size:25px;">Current Status of Tables:</label>
			<br /><br />

			<div id="medicines" 		class="outputsqlq" style="border:2px solid black;">medicines</div>
			<div id="medicines_compounds" 	class="outputsqlq" style="border:2px solid black;">medicines_compounds</div>
			<div id="medicines_pharma" 	class="outputsqlq" style="border:2px solid black;"></div>
			<div id="employees" 		class="outputsqlq" style="border:2px solid black;"></div>
			<div id="transactions" 		class="outputsqlq" style="border:2px solid black;"></div>
		</form>

		
	
	</body>
</html>
