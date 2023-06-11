<?php
class Post
{
  // DB stuff
  private $conn;
  private $table = 'projects';

  // Post Properties
  public $Sno;
  public $Title;
  public $Author;
  public $Content;
  public $Category;
  public $Event;
  public $Image;
  public $Date;
  public $catCount;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get Posts
  public function read($start, $limit)
  {
    $query = 'SELECT b.projectId, b.projectTitle, b.userName, b.content, b.published, b.BtnText, b.projectLink, b.coverImage, b.tags FROM ' . $this->table . ' b WHERE approved=1 AND isDraft=0 ORDER BY published DESC LIMIT ' . $start . ',' . $limit;
    $stmt = $this->conn->query($query);
    return $stmt;
  }

  // Get Posts
  public function getCategories()
  {
    // Create query
    $query = 'SELECT b.Category, COUNT(Category) AS CatCount
                                FROM ' . $this->table . ' b 
                                GROUP BY Category';

    $stmt = $this->conn->query($query);
    // Prepare statement
    // $stmt = $this->conn->prepare($query);

    // Execute query
    // $stmt->execute();

    return $stmt;
  }

  // Get Posts
  public function readCategories($Category)
  {
    // Create query
    $query = 'SELECT b.Sno, b.Title, b.Author, b.Content, b.Category, b.Event, b.Image, b.Date, b.tags
                                FROM ' . $this->table . ' b 
                                WHERE Category=' . $Category;

    $stmt = $this->conn->query($query);
    // Prepare statement
    // $stmt = $this->conn->prepare($query);

    // Execute query
    // $stmt->execute();

    return $stmt;
  }

  public function countprojects()
  {
    $query = 'SELECT COUNT(*) FROM projects';
    $stmt = $this->conn->query($query);
    return $stmt->fetch_assoc();
  }

  public function readThree()
  {
    // Create query
    $query = 'SELECT b.projectId, b.projectTitle, b.userName, b.content,b.BtnText, b.projectLink, b.published, b.coverImage, b.tags
                                FROM ' . $this->table . ' b
                                WHERE approved=1 AND isDraft=0 ORDER BY projectId DESC LIMIT 3';

    $stmt = $this->conn->query($query);

    return $stmt;
  }
  public function readOne($Sno)
  {
    // Create query
    $query = 'SELECT b.projectId, b.projectTitle, b.user_ids, b.BtnText, b.projectLink, b.content, b.coverImage
                                FROM ' . $this->table . ' b
                                WHERE projectId=' . $Sno;

    $stmt = $this->conn->query($query);

    return $stmt;
  }


  public function readGalleryImage()
  {
    $query = 'SELECT g.Sno, g.source, g.date FROM gallery g';
    $stmt = $this->conn->query($query);
    return $stmt;
  }
}
