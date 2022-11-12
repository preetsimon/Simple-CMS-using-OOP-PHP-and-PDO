<?php
class ImageDAO
{

    //Place to store the PDO Agent/Service class
    public static $dbImage;

    static function initialize(string $className)
    {
        self::$dbImage = new PDOAgent($className);
    }
// create new image
    static function createImage($newImage): int
    {
        // prepared statement
        $sql = "INSERT INTO image (`file`, alt) 
                        VALUES (:file, :alt);";

        // prepare the query
        self::$dbImage->query($sql);

        // bind the parameters
        self::$dbImage->bind(':file', $newImage->getFile());
        self::$dbImage->bind(':alt', $newImage->getAlt());

        // execute the query
        self::$dbImage->execute();

        return self::$dbImage->lastInsertedId();
    }

    static function getImage($file)
    {
        $sql = "SELECT * from image WHERE file=:file";

        self::$dbImage->query($sql);
        self::$dbImage->bind(':file', $file);
        self::$dbImage->execute();

        return self::$dbImage->singleResult();
    }
// get image for a given `activity`
    static function getImageforActivity($id)
    {
        $sql = "SELECT i.id, i.file, i.alt 
        FROM image   AS i
        JOIN activity AS a
          ON i.id = a.imageID
       WHERE a.id = :id;";

        self::$dbImage->query($sql);
        self::$dbImage->bind(':id', $id);
        self::$dbImage->execute();

        return self::$dbImage->singleResult();
    }
// update alt-text for image
    static function updateImageAlt(Image $image)
    {
        $sql = "UPDATE image 
        SET alt = :alt 
      WHERE id = :id;";

        self::$dbImage->query($sql);
        self::$dbImage->bind(':id', $image->getID());
        self::$dbImage->bind(':alt', $image->getAlt());

        self::$dbImage->execute();
        return self::$dbImage->lastInsertedID();
    }
}
