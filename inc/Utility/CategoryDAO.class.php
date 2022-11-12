<?php
  class CategoryDAO {

    //Place to store the PDO Agent/Service class
    private static $dbCategory;

    static function initialize(string $className)   {
        self::$dbCategory = new PDOAgent($className);
    }
// get categories to display in navigation bar
    static function getNavigationBar() {
        $sql = "SELECT id, name FROM category WHERE navigation = 1;";
        self::$dbCategory->query($sql);
        self::$dbCategory->execute();

        return self::$dbCategory->getResultSet();

    }

    // get single category by id
    static function getCategory($categoryID) {
        $sql = "SELECT id, name, description FROM category WHERE id=:id;";

        self::$dbCategory->query($sql);
        self::$dbCategory->bind(':id', 
        $categoryID);
        self::$dbCategory->execute();

        return self::$dbCategory->singleResult();
    }

    // get all categories
    static function getCategories() {
        $sql = "SELECT id, name, description FROM category ;";

        self::$dbCategory->query($sql);
    
        self::$dbCategory->execute();

        return self::$dbCategory->getResultSet();
    }

    // get all activities in a specific category: eg get all activities with category hiking
    static function getActivityByCategory($categoryID) {
        $sql = "SELECT a.id, a.title, a.location,  a.categoryID, a.memberID, 
        c.name      AS category,
        m.full_name AS author,
        i.file AS image_file,
        i.alt  AS image_alt 
   FROM activity     AS a
   JOIN category    AS c  ON a.categoryID = c.id
   JOIN member      AS m  ON a.memberID   = m.id
   LEFT JOIN image  AS i  ON a.imageID    = i.id
  WHERE a.categoryID = :id  AND a.displayed = 1;";    

 self::$dbCategory->query($sql);

 self::$dbCategory->bind(':id', 
 $categoryID);
 self::$dbCategory->execute();
 return self::$dbCategory->getResultSet(); 
    }
}
?>