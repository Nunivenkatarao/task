<html>
	<head>
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<style>
			.errMsg{
				color: red;
			}
			.succMsg{
				color: green;
			}
		</style>
	</head>
	<body>
		<form method="post" name="myFrm" id="myFrm">
			Full Path / File Name :<input type="text"  name="fullpath" id="fullpath" />
			<span id="pathErr" class="errMsg"></span>
			
			<br />
			<input type="button" name="ffret" id="ffret" value="Submit">
		</form> 
		<br />
		<span class="succMsg"></span>
	</body>
</html>