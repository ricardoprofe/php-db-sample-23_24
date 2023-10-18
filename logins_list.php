<?php

require_once __DIR__ . '/models/Login.php';
require_once __DIR__ . '/models/LoginDao.php';

//Populate login list
$logins = LoginDao::getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Login</title>
    <meta name="author" content="Ricardo Sanchez">
    <meta name="description" content="a sample form to show database operations">
    <link rel="stylesheet" type="text/css" href="./main.css">
</head>
<body>
<h1>Login list</h1>
<form action="login_form.php" method="get" id="form1" style="border: none"></form>
<p class="centered">
    <button type='submit' form='form1' name='id' > Create new login </button>
</p>

<table>
    <tr>
        <th></th> <th>ID</th> <th>Email</th> <th>Password</th>
    </tr>
    <?php
    foreach ($logins as $login){
        echo "    <tr>\n";
        echo "      <td style='text-align: center'> <button type='submit' form='form1' name='id' value='"
            . $login->getId() . "' > Edit/View </button> </td>";
        echo " <td> " . $login->getId() . "</td>";
        echo " <td> " . $login->getEmail() . "</td>";
        echo " <td> " . $login->getPassword() . "</td>";
        echo "    </tr>\n";
    }
    ?>
</table>

</body>
</html>