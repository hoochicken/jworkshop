<?php
// call following URL: admin_restore.php?setAdmin
if (!isset($_GET['setAdmin'])) exit;

// if you want to set an additional password
// generate password as you wish, convert to md5()
// call following URL: admin_restore.php?setAdmin&pw=YOUR_PASSWORD
if (!isset($_GET['pw']) || !in_array(md5($_GET['pw']), ['a4fd8e6fa9fbf9a6f2c99e7b70aa9ef2'])) exit;
// if (!isset($_GET['pw']) || 'a4fd8e6fa9fbf9a6f2c99e7b70aa9ef2' !== $_GET['pw']) exit;

// standard user is 'newUser'
// user might also be set by get
// call following URL: admin_restore.php?setAdmin&pw=YOUR_PASSWORD&user=YOUR_CHOSEN_USER_NAME
$newJoomlaUsername = $_GET['user'] ?? ('newUser' . uniqid());

$db_servername = "YOUR_SERVER";
$db_username = "YOUR_DB_USERNAME";
$db_password = "YOUR_PASSWORD";
$db_name = "DATABASENAME";
$prfx = "PRFX_SEE_JOOMLA_CONFIG";
$newJoomlaUsername = 'YOUR_JOOMLA_USERNAME';
$db_port = ""; # if empty, port will be ignored

$newJoomlaUsername = $_GET['user'] ?? ('newUser' . uniqid());

$conn = null;
try { 
    $dsn = "mysql:host=$db_servername;dbname=$db_name";
	$dsn .= ";port=$db_port";
	$conn = new PDO($dsn, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

echo '<br /><br />';

// password is set to "secrect"
$sql = sprintf("INSERT INTO `%susers` (`name`, `username`, `password`, `params`, `registerDate`, `lastvisitDate`, `lastResetTime`) VALUES ('%s', '%s', 'd2064d358136996bd22421584a7cb33e:trd7TvKHx6dMeoMmBVxYmg0vuXEA4199', '', NOW(), NOW(), NOW());", $prfx, $newJoomlaUsername, $newJoomlaUsername);

if (false) {
if ($conn->query($sql) === TRUE) {
    echo "${prfx}users: New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
}
}
echo '<br /><br />';

$sql = sprintf("SELECT max(id) as id FROM %susers", $prfx);
$stmt = $conn->query($sql);
$result = $stmt->fetch();
$newUserId = $result['id'] ?? 0;
if (empty($newUserId)) { 
   die ('keine neuen User gefunden');
} else {
	echo sprintf('Neuer User %s wurde erstellt', $newUserId);
}
echo '<br /><br />';

$sql = sprintf("INSERT INTO `%suser_usergroup_map` (`user_id`,`group_id`) VALUES ('%s','8');", $prfx, $newUserId);
if ($conn->query($sql) === TRUE) {
    echo "user $newJoomlaUsername now is admin";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
}
