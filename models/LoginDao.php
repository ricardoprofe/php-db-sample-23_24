<?php declare(strict_types=1);
require_once __DIR__ . '/Login.php';
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ . '/../IDbAccess.php';

class LoginDao implements IDbAccess
{
    public static function getAll(): ?array
    {
        $conn = DBConnection::connectDB();
        if (!is_null($conn)) {
            $stmt = $conn->prepare("SELECT * FROM logins");
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Login');
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public static function select($id): ?Login
    {
        $conn = DBConnection::connectDB();
        if (!is_null($conn)) {
            // The user input is automatically quoted, so there is no risk of a SQL injection attack.
            $stmt = $conn->prepare("SELECT * FROM logins WHERE id = :id");
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Login');
            $stmt->execute(['id' => $id]);
            $login = $stmt->fetch();
            if ($login)
                return $login;
        }
        return null;
    }

    public static function insert($object): int
    {
        $conn = DBConnection::connectDB();
        if (!is_null($conn)) {
            $stmt = $conn->prepare("INSERT INTO logins (id, email, password) VALUES (:id, :email, :password)");
            $stmt->execute(['id'=>null, 'email'=>$object->getEmail(), 'password'=>$object->getPassword()]);
            echo $stmt->rowCount(); //Return the number of rows affected
        }
        return 0;
    }

    public static function delete($object): int
    {
        $conn = DBConnection::connectDB();
        if (!is_null($conn)) {
            $stmt = $conn->prepare("DELETE FROM logins WHERE id=:id");
            $stmt->execute(['id'=>$object->getId()]);
            return $stmt->rowCount(); //Return the number of rows affected
        }
        return 0;
    }

    public static function update($object): int
    {
        $conn = DBConnection::connectDB();
        if (!is_null($conn)) {
            $stmt = $conn->prepare("UPDATE logins SET email=:email, password=:password WHERE id=:id");
            $stmt->execute(['id'=>$object->getId(), 'email'=>$object->getEmail(), 'password'=>$object->getPassword()]);
            return $stmt->rowCount(); //Return the number of rows affected
        }
        return 0;
    }
}