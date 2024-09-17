<!-- Chapter 6 Exercise -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Message Board</title>
</head>
<body>
	<h1>Message Board</h1>
	<?php  

		# Check if our new features triggered the page reload
		if(isset($_GET["action"])) {
			if((file_exists("messages.txt")) && (filesize("messages.txt") != 0)) {
				$MessageArray = file("messages.txt");
				# Switch statement to determine which link was clicked on
				switch($_GET["action"]) {
					case "Delete First":
						array_shift($MessageArray);
						break;
					case "Delete Last":
						array_pop($MessageArray);
						break;
					case "Delete Message":
						if(isset($_GET["message"])) {
							array_splice($MessageArray, $_GET["message"], 1);
						}
						break;
					case "Sort Ascending":
						
				} # end of switch

				if(count($MessageArray) > 0) {
					$NewMessages = implode($MessageArray);
					$MessageStore = fopen("messages.txt", "w");
					if($MessageStore === false) {
						echo "<p>There was an error in updating the file!</p>";
					} else {
						fwrite($MessageStore, $NewMessages);
						fclose($MessageStore);
					}
				} else {
					unlink("messages.txt");
				}
			} # end of if that checks the file
		} # end of the if statement checking the reload


		if((!file_exists("messages.txt")) || (filesize("messages.txt") === 0)) {
			echo "<p>Sorry, no messages to display at this time.</p>";
		} else {
			$MessageArray = file("messages.txt");
			echo "<table style='background-color: lightgray;' border='1' width='100%'>\n ";
			$count = count($MessageArray);
			// loop through the $MessageArray variable, each message is 1 row in the table
			for($i = 0; $i < $count; ++$i) {
				$CurrMsg = explode("~", $MessageArray[$i]);
				echo "<tr>\n";
				echo "<th width='5%'>", ($i + 1), "</th>\n";
				echo "<td width='85%'><span style='font-weight: bold'>Subject:</span> ", htmlentities($CurrMsg[0]), "<br/>\n";
				echo "<span style='font-weight: bold'>Name:</span> ", htmlentities($CurrMsg[1]), "<br/>\n";
				echo "<span style='font-weight: bold; text-decoration: underline;'>Message:</span> ", htmlentities($CurrMsg[2]), "</td>\n";
				echo "<td width='10%;'style='text-align: center;'><a href='MessageBoard.php?action=Delete%20Message&message=$i'>Delete This Message</a></td>\n"; 
				echo "</tr>\n";
			} // end of FOR loop
			echo "</table>\n";
		} # end of if/else
	?>
	<p><a href="PostMessage.php">Post New Message</a></p>
	<p><a href="MessageBoard.php?action=Delete%20First">Delete First Message</a></p>
	<p><a href="MessageBoard.php?action=Delete%20Last">Delete Last Message</a></p>
</body>
</html>