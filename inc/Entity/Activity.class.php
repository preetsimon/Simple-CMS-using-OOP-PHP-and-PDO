
<?php



class Activity  {

    private $title;
    private $location;
    private $content;
    private $created;
    private $categoryID;
    private $memberID;
    private $imageID;
    private $displayed;
    private $id;
    public $image_file;
    public $image_alt;



    //Getters

    function getID() {
        return $this->id;
    }
    function getTitle(): string {
        return $this->title;
    }
    function getImageFile(){
        return $this->image_file;
    }

   function getLocation() {
    return $this->location;
   }

   function getContent() {
    return $this->content;
   }

   function getCreated() {
    return $this->created;
   }

   function getCategoryID() {
    return $this->categoryID;
   }

   function getMemberID() {
    return $this->memberID;
   }

   function getImageID() {
    return $this->imageID;
   }
   function getDisplayed() {
    return $this->displayed;
   }

    //Setters
    function setTitle(string $title){
        $this->title = $title;
    }
function setImageFile($imageFile) {
    $this->image_file;
}
    function setLocation(string $location ) {
        $this->location = $location ;
    }

    function setContent(string $content) {
        $this->content = $content;
    }

    function setCreated(string $created) {
        $this->created = $created;
    }

    function setCategoryID(int $id) {
        $this->categoryID = $id;
    }

    function setMemberID(int $id) {
        $this->memberID = $id;
    }
    
    function setImageID (int $id) {
        $this->imageID = $id;
    }

    function setDisplayed(int $display) {
        $this->displayed = $display ;
    }


}

?>