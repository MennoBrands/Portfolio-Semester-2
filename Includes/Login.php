<?php
/* login script */
Session_start();

/* Include connection.php */
require_once('Connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST["username"], $_POST["password"])) {
    /* Check of usename en password zijn ingevuld */
        $UserInfo = $conn->prepare("SELECT Username, Password FROM user WHERE Username = :Username LIMIT 1");
        $UserInfo->bindParam(":Username", $username);
        $UserInfo -> execute();

        $UserInfo->bindColumn(1, $Username);
        $UserInfo->bindColumn(2, $Password);

        while ($UserInfo->fetch()) {
            $dbusername = $Username;
            $dbpassword = $Password;
        }

    /* Check of password goed is, d.m.v. password hash */
    $passwordHash = password_verify($password, $dbpassword);

	if($UserInfo -> rowCount() !=0)
	{
		if($username==$dbusername&&$passwordHash != 0)
		{

		$_SESSION['Username']=$dbusername;

			try {
                $RoleResult = $conn->prepare("SELECT Role_ID FROM user_role WHERE User_ID = (SELECT ID FROM User WHERE Username = :Username)");
                $RoleResult->bindParam(':Username', $username);
                $RoleResult->execute();

                $RoleResult->bindColumn(1, $Role_ID);

                while ($RoleResult->fetch()) {
                    $roleID = $Role_ID;
                }


                if ($roleID == 1) {
                    $_SESSION['Type']='Admin';
                }
                else {
                    $_SESSION['Type']='User';
                }
            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }

		header('Location:../CMS/ContentList.php');

		}
		else
			echo '<script type="text/javascript">alert("Wrong password.");';
			echo 'window.location = "LoginPage.html";';
			echo '</script>';
	}
	else
		echo '<script type="text/javascript">alert("Username does not exist.");';
		echo 'window.location = "LoginPage.html";';
		echo '</script>';
}
 ?>

