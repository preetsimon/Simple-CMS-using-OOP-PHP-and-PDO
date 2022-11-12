<?php


class MemberDAO
{

    public static $db;

    static function init()
    {
        //Initialize the internal PDO Agent
        self::$db = new PDOAgent("Member");
    }

    static function getMember($memberID)
    {

        $selectSQL = "SELECT full_name, joined, picture FROM member WHERE id = :id;";;
        self::$db->query($selectSQL);
        self::$db->bind(":id", $memberID);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getMemberByUsername(string $userName)  {
        
        $selectSQL = "SELECT * FROM member WHERE full_name = :name;";
        self::$db->query($selectSQL);
        self::$db->bind(":name", $userName);
        self::$db->execute();
        return self::$db->singleResult();

    }

    static function getActiclesFromMember($memberID)
    {
        $sql = "SELECT a.id, a.title, a.location, a.categoryID, a.memberID, 
        c.name     AS category,
        full_name AS author,
        i.file     AS image_file,
        i.alt      AS image_alt 
   FROM activity    AS a
   JOIN category   AS c   ON a.categoryID = c.id
   JOIN member     AS m   ON a.memberID   = m.id
   LEFT JOIN image AS i   ON a.imageID    = i.id
  WHERE a.memberID = :id AND a.displayed  = 1
  ORDER BY a.id DESC;";

        self::$db->query($sql);

        self::$db->bind(
            ':id',
            $memberID
        );
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function getAllMembers()
    {

        $selectSQL = "SELECT * FROM member
        Except
        SELECT * FROM member WHERE full_name ='admin'";
        self::$db->query($selectSQL);
        self::$db->execute();
        return self::$db->getResultSet();
    }

    static function setPassword($userName, $newPassword)
    { // * reset password. not implemented 

        $sql = "UPDATE users SET password=:password ";
        $sql .= "WHERE username=:user";
        self::$db->query($sql);
        self::$db->bind(":password", $newPassword);
        self::$db->bind(":user", $userName);
        self::$db->execute();


        return self::$db->rowCount();
    }
    // * register/add/sign-up new user
    static function createUser(Member $newUser)
    {

        $sql = "INSERT INTO member (full_name, email, `password`,picture ) VALUES (:full_name, :email, :password,:picture)";

        self::$db->query($sql); // Bind variables to the prepared statement as parameters

        self::$db->bind(":email", $newUser->getEmail());
        self::$db->bind(":password", $newUser->getPassword());
        self::$db->bind(":full_name", $newUser->getAuthor());
        self::$db->bind(":picture", $newUser->getPicture());

      
        self::$db->execute();

        return self::$db->lastInsertedId();
    }

    // check for duplicate username while registering. Display warning after validating inputs
    static function checkDuplicateUser($username)
    {
        $sql = "SELECT id FROM users WHERE username = :username";

        (self::$db->query($sql));
        // Bind variables to the prepared statement as parameters
        self::$db->bind(":username", $username);


        // Attempt to execute the prepared statement
        self::$db->execute();
        if (self::$db->rowCount() == 1) {
            $username_err = "This username is already taken.";
        } else {
            $username_err = "Oops! Something went wrong. Please try again later.";
        }
    }

    static function resetPassword($username, $password)
    { // reset password for the given username
        $sql = "UPDATE users SET password = :password WHERE username = :username";

        self::$db->query($sql); // Bind variables to the prepared statement as parameters

        self::$db->bind(":username", $username);
        self::$db->bind(":password", $password);

        self::$db->execute();


        return self::$db->lastInsertedId();
    }
}
