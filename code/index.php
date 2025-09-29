<?php
	$servername = "db";  // Service name defined in docker-compose.yml
	$username = "root";
	$password = $_ENV['MYSQL_ROOT_PASSWORD'];
	$database = "messages";
	
	try {
		// Create connection
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	
		// Set PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_POST['username']) and isset($_POST['chat'])) {
			/*
			foreach ($_POST as $key => $value) {
				echo $key." = ".$value."<br>";
			}
			*/
			$sql = "INSERT INTO messages (written, username, chat, icon)
			VALUES (\"".date("Y-m-d H:i:s")."\", \"".$_POST["username"]."\", \"".$_POST["chat"]."\", \"".$_POST['icon']."\")";

			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			#$conn->close();
		}
		
		$last25 = "SELECT * FROM (SELECT * FROM messages ORDER BY written DESC LIMIT 25) AS temp ORDER BY written ASC;";
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>
<head>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<title><?php echo $_ENV["title"]; ?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<main>
		<!--Simple banner-->
		<img src="<?php echo $_ENV["banner_image"]; ?>" id="banner">
		<hr>
		
		<!--Last 25(?) messages-->
		<div id="messages">
			<table>
				<?php
					$stmt = $conn->prepare($last25);
					$stmt->execute();
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					$messages = $stmt->fetchAll();
					foreach ($messages as $key => $value) {
						if ( $value['icon'] == "" ) {
							echo "<tr><td><img src=".$_ENV["default_user_icon"]." class=userIcon></td><td>At ".$value['written']." UTC ".$value['username']." said, \"".$value['chat']."\"</td></tr><tr><td colspan=2><hr></td></tr>";
						} else {
							echo "<tr><td><img src=".$value['icon']." class=userIcon></td><td>At ".$value['written']." UTC ".$value['username']." said, \"".$value['chat']."\"</td></tr><tr><td colspan=2><hr></td></tr>";
						}
					}
				?>
			</table>
		</div>
		<hr>
		<br>
		<br>
		
		<form id="chat" method="post" action="index.php">
			<!--Username, Password, User Icon URL-->
			<label for="icon">Avatar (optional):&nbsp</label><input type="url" name="icon">&nbsp&nbsp&nbsp&nbsp&nbsp<label for="username">Username:&nbsp</label><input type="text" name="username">
			<!--<label for="password">Password (optional):&nbsp</label><input type="test" name="password">-->
			<br>
			<br>
			
			<!--Chat box-->
			<textarea name="chat" rows="10" cols="100"></textarea><br>
			<br>
			
			<!--Submit-->
			<input type="submit" value="Chat" style="padding:10px 20px;">
		</form>
	</main>
</body>
