<!-- Chapter 6 Exercise -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post Message</title>
</head>
<body>
	<?php  
		# Check if this page was loaded because the form was submitted
		if(isset($_POST["submit"])) {
			$Subject = $_POST["subject"];
			$Name = $_POST["name"];
			$Message = $_POST["message"];
			# Replace any ~ with -
			$Subject = str_replace("~", "-", $Subject);
			$Name = str_replace("~", "-", $Name);
			$Message = str_replace("~", "-", $Message);
			# Join all three variables into one string
			$MessageRecord = "$Subject~$Name~$Message\n";
			# Create a file variable to store the messages
			$MessageFile = fopen("messages.txt", "a");
			# Check the file status, if it is broken, display an error, if not, write the message to the file
			if($MessageFile === false) {
				echo "<p style='color: red;'>Sorry! There was an error saving your message!</p>";
			} else {
				fwrite($MessageFile, $MessageRecord);
				fclose($MessageFile);
				echo "<p style='color: green;'>Your message has been saved!</p>";
			}
		}
	?>

	<h1>Post New Message</h1>
	<hr/>
	<form action="PostMessage.php" method="POST">
		<label style="font-weight: bold;" for="subj">Subject:</label>
		<input type="text" name="subject" id="subj" />
		<label style="font-weight: bold;" for="name">Name:</label>
		<input type="text" name="name" id="name" />
		<br/>
		<br/>
		<textarea name="message" rows="6" cols="80" style="resize: none;"></textarea>
		<br/>
		<br/>
		<input type="reset" value="Reset Form" />
		<input type="submit" name="submit" value="Post Message" />
	</form>
	<hr/>
	<p><a href="MessageBoard.php">View Messages</a></p>
</body>
</html>