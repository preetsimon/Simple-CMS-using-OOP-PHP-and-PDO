<?php

class ActivityDAO
{

    //Place to store the PDO Agent/Service class
    public static $dbActivity;
   
    static function initialize(string $className)
    {
        self::$dbActivity = new PDOAgent($className);
    }


    // function to create (insert) `activity`
    static function createActivity(Activity $newActivity): int
    {
        // prepared statement
        $sql = "INSERT INTO activity (title, location, content, categoryID, 
memberID, imageID, displayed)
VALUES (:title, :location, :content, :categoryID, :memberID,  
:imageID, :displayed);";    // SQL to create activity
        // prepare the query
        self::$dbActivity->query($sql);

        // bind the parameters
        self::$dbActivity->bind(':title', $newActivity->getTitle());
        self::$dbActivity->bind(':location', $newActivity->getLocation());
        self::$dbActivity->bind(':content', $newActivity->getContent());
        self::$dbActivity->bind(':categoryID', $newActivity->getCategoryID());
        self::$dbActivity->bind(
            ':memberID',
            $newActivity->getMemberID()
        );
        self::$dbActivity->bind(
            ':imageID',
            $newActivity->getImageID()
        );
        self::$dbActivity->bind(
            ':displayed',
            $newActivity->getDisplayed()
        );
        // execute the query
        self::$dbActivity->execute();

        return self::$dbActivity->lastInsertedId();
    }

    // get all activity table
    static function getActivities(): array
    {
        $sql = "SELECT * from activity";

        self::$dbActivity->query($sql);
        self::$dbActivity->execute();

        return self::$dbActivity->getResultSet();
    }



    // function to get single activity by title
    static function getActivity($title)
    {
        $sql = "SELECT * from activity WHERE title=:title";

        self::$dbActivity->query($sql);
        self::$dbActivity->bind(':title', $title);
        self::$dbActivity->execute();

        return self::$dbActivity->singleResult();
    }

    static function editActivity(Activity $activityToEdit): int
    {
        $sql = "UPDATE activty SET title=:title,
                    `location` =:location,
                    content =:content,
                    created =:created,
                    categoryID = :categoryID,
                    memberID = :memberID,
                    displayed = :displayed
                    WHERE title=:title";

        self::$dbActivity->query($sql);

        // bind the parameters
        self::$dbActivity->bind(':title', $activityToEdit->getTitle());
        self::$dbActivity->bind(':location', $activityToEdit->getLocation());
        self::$dbActivity->bind(':content', $activityToEdit->getContent());
        self::$dbActivity->bind(':categoryID', $activityToEdit->getCategoryID());
        self::$dbActivity->bind(
            ':memberID',
            $activityToEdit->getMemberID()
        );
        self::$dbActivity->bind(
            ':imageID',
            $activityToEdit->getImageID()
        );
        self::$dbActivity->bind(
            ':displayed',
            $activityToEdit->getDisplayed()
        );

        // execute the query
        self::$dbActivity->execute();

        return self::$dbActivity->rowCount();
    }
// get single activity with associated details from other tables
    static function getActivityDetail($activityID): Activity
    {
        $sql = "SELECT a.title, a.location, a.content, a.created, a.categoryID, a.memberID, 
               c.name      AS category,
               m.full_name AS author,
               i.file AS image_file,
               i.alt  AS image_alt 
          FROM activity     AS a
          JOIN category    AS c  ON a.categoryID = c.id
          JOIN member      AS m  ON a.memberID   = m.id
          LEFT JOIN image  AS i  ON a.imageID    = i.id
         WHERE a.id = :id  AND a.displayed = 1;";

        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':id',
            $activityID
        );
        self::$dbActivity->execute();
        return self::$dbActivity->singleResult();
    }
// get 6 activities to show on casual user landing page  
    static function getActivityIndex()
    {

        $sql = "SELECT a.id, a.title, a.location, a.categoryID, a.memberID, 
               c.name AS category,
               full_name AS author,
               i.file     AS image_file,
               i.alt      AS image_alt 
          FROM activity    AS a
          JOIN category   AS c ON a.categoryID = c.id
          JOIN member     AS m ON a.memberID   = m.id
          LEFT JOIN image AS i ON a.imageID    = i.id
         WHERE a.displayed = 1
      ORDER BY a.id DESC
         LIMIT 6;";

        self::$dbActivity->query($sql);

        self::$dbActivity->execute();
        return self::$dbActivity->getResultSet();
    }

// function to impplement search: How many `activities` match search term?
    static function getColumns($arguments)
    {
        // ? return number of columns for search
        $sql = "SELECT COUNT(title) FROM activity
             WHERE title   LIKE :term1
                OR `location` LIKE :term2
                OR content LIKE :term3
               AND displayed = 1;";                       
        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':term1',
            $arguments['term1']
        );
        self::$dbActivity->bind(
            ':term2',
            $arguments['term2']
        );
        self::$dbActivity->bind(
            ':term3',
            $arguments['term3']
        );
        self::$dbActivity->execute();
        return self::$dbActivity->getColumn();
    }
// function to return all `activities` that match the search term
    static function searchResults($arguments)
    {

        $sql = "SELECT a.id, a.title, a.location, a.categoryID, a.memberID, 
        c.name      AS category,
        full_name  AS author,
        i.file      AS image_file,
        i.alt       AS image_alt 
   FROM activity     AS a
   JOIN category    AS c    ON a.categoryID = c.id
   JOIN member      AS m    ON a.memberID   = m.id
   LEFT JOIN image  AS i    ON a.imageID    = i.id
  WHERE a.title   LIKE :term1
     OR a.location LIKE :term2
     OR a.content LIKE :term3
    AND a.displayed = 1
ORDER BY a.id DESC
  LIMIT :show 
 OFFSET :from;";

        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':term1',
            $arguments['term1']
        );
        self::$dbActivity->bind(
            ':term2',
            $arguments['term2']
        );
        self::$dbActivity->bind(
            ':term3',
            $arguments['term3']
        );
        self::$dbActivity->bind(
            ':term3',
            $arguments['term3']
        );
        self::$dbActivity->bind(
            ':show',
            $arguments['show']
        );
        self::$dbActivity->bind(
            ':from',
            $arguments['from']
        );
        self::$dbActivity->execute();

        return self::$dbActivity->getResultSet();
    }
// get all acticities to display on the admin page
    static function getAllActivities()
    {
        $sql = "SELECT a.id, a.title, a.location, a.created, a.categoryID, a.memberID, a.displayed,
               c.name     AS category,
               full_name AS author,
               i.file     AS image_file,
               i.alt      AS image_alt 
          FROM activity    AS a
          JOIN category   AS c   ON a.categoryID = c.id
          JOIN member     AS m   ON a.memberID   = m.id
          LEFT JOIN image AS i   ON a.imageID    = i.id
         ORDER BY a.id DESC;";

        self::$dbActivity->query($sql);

        self::$dbActivity->execute();
        return self::$dbActivity->getResultSet();
    }
// display `activity` together with image attributes
    static function getActivityAndImage($activityID)
    {
        $sql     = "SELECT a.id, a.title, a.location, a.content,  
        a.categoryID, a.memberID, a.imageID, a.displayed,
        i.file      AS image_file,
        i.alt       AS image_alt 
   FROM activity     AS a
   LEFT JOIN image  AS i ON a.imageID = i.id
  WHERE a.id = :id;";

        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':id',
            $activityID
        );
        self::$dbActivity->execute();
        return self::$dbActivity->singleResult();
    }
// update `activity`
    static function updateActivity($activityObj)
    {

        $sql = "UPDATE activity
        SET title = :title, location = :location, content = :content,
            categoryID = :categoryID, memberID = :memberID, 
            imageID = :imageID, displayed = :displayed 
      WHERE id = :id;";                       
        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':id',
            $activityObj->getId()
        );
        self::$dbActivity->bind(
            ':displayed',
            $activityObj->getDisplayed()
        );
        self::$dbActivity->bind(
            ':title',
            $activityObj->getTitle()
        );
        self::$dbActivity->bind(
            ':location',
            $activityObj->getLocation()
        );
        self::$dbActivity->bind(
            ':content',
            $activityObj->getContent()
        );
        self::$dbActivity->bind(
            ':categoryID',
            $activityObj->getCategoryID()
        );
        self::$dbActivity->bind(
            ':imageID',
            $activityObj->getImageID()
        );
        self::$dbActivity->bind(
            ':memberID',
            $activityObj->getMemberID()
        );
        self::$dbActivity->execute();
        return self::$dbActivity->lastInsertedID();
    }
// delete image: set image-id to null in `activity` table then delete img from image table 
    static function deleteImage($id)
    {
        $sql = "UPDATE activity SET imageID = null WHERE id = :activityID;"; // SQL to update activity table
        self::$dbActivity->query($sql);

        self::$dbActivity->bind(
            ':id',
            $id
        );

        try {
            self::$dbActivity->execute();


            $sql = "DELETE FROM image WHERE id = :id;";     // SQL to delete from image table
            self::$dbActivity->query($sql);

            self::$dbActivity->bind(
                ':id',
                $id
            );
            self::$dbActivity->execute();

            if (self::$dbActivity->rowCount() != 1) {
                throw new Exception("Problem deleting book $id");
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }

        return true;
    }


    // function to delete activity
    static function deleteActivity(string $id): bool
    {
        $sql = "DELETE FROM activity WHERE id = :id";

        try {
            self::$dbActivity->query($sql);
            self::$dbActivity->bind(':id', $id);
            self::$dbActivity->execute();

            if (self::$dbActivity->rowCount() != 1) {
                throw new Exception("Problem deleting book $id");
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            self::$dbActivity->debugDumpParams();
            return false;
        }

        return true;
    }
// get total number of activities
    static function getCount()
    {
        $sql = "SELECT count(id) FROM activity";
        self::$dbActivity->query($sql);

        self::$dbActivity->execute();
        return self::$dbActivity->getColumn();
    }
}
