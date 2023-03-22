<?php
if (!isset($_GET['setAdmin'])) exit;

$db_servername = "YOUR_SERVER";
$db_username = "YOUR_DB_USERNAME";
$db_password = "YOUR_PASSWORD";
$db_name = "DATABASENAME";
$prfx = "PRFX_SEE_JOOMLA_CONFIG";
$newJoomlaUsername = 'YOUR_JOOMLA_USERNAME';
$db_port = ""; # if empty, port will be ignored

$conn = null;
try {
    $dsn = "mysql:host=$db_servername;dbname=$db_name";
    $dsn .= ";port=$db_port";
    $conn = new PDO($dsn, $db_username, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

echo '<br /><br />';

// here a new user is created
// password is set to "secrect"
$sql = sprintf("INSERT INTO `%susers` (`name`, `username`, `password`, `params`, `registerDate`, `lastvisitDate`, `lastResetTime`) VALUES ('%s', '%s', 'd2064d358136996bd22421584a7cb33e:trd7TvKHx6dMeoMmBVxYmg0vuXEA4199', '', NOW(), NOW(), NOW());", $prfx, $newJoomlaUsername, $newJoomlaUsername);

if ($conn->query($sql) === TRUE) {
    echo "${prfx}users: New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
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

$superadminUserGroup = 8;
$sql = sprintf("INSERT INTO `%suser_usergroup_map` (`user_id`,`group_id`) VALUES ('%s','%s');", $prfx, $newUserId, $superadminUserGroup);
if ($conn->query($sql) === TRUE) {
    echo "user $newJoomlaUsername now is admin";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
}