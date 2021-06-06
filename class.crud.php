<?php
class crud {
    private $db;
    function __construct($dbc) {
        $this->db = $dbc;
    }
    
    public function create($title, $content, $overview ) {
        try {
            $stmt = $this->db->prepare("INSERT INTO blogs(title, content, overview) VALUES(:title, :content, :overview )");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":content", $content);
            $stmt->bindParam(":overview", $overview);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getID($ID) {
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE ID=:ID");
        $stmt->execute(array(":ID"=>$ID));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    
    public function update($ID,  $title, $content, $overview ) {
        try {
            $stmt = $this->db->prepare("UPDATE blogs SET title=:title, content=:content, overview=:overview WHERE ID=:ID");
            $stmt->bindparam(":title",$title);
            $stmt->bindparam(":content",$content);
            $stmt->bindparam(":overview",$overview);
            $stmt->bindparam(":ID",$ID);

            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function delete($ID) {
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE ID=:ID");
        $stmt->bindparam(":ID", $ID);
        $stmt->execute();
        return true;
    }
    
    /*paging*/
    public function dataview($query)
     {
      $stmt = $this->db->prepare($query);
      $stmt->execute();

      if($stmt->rowCount()>0)
      {
       while($row=$stmt->fetch(PDO::FETCH_ASSOC))
       {
        ?>
                    <br>
                    <div class="card">
                    <img src="https://pbs.twimg.com/profile_images/1199795117852364801/hltfr-Lf_400x400.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b><?php print($row['title']); ?></b></h4> 
                            <p><?php print($row['overview']); ?></p> <center>
                            <a href="edit-data.php?edit_ID=<?php print($row['ID']); ?>" class="try1" >edit</a>
                        <a href="delete.php?delete_ID=<?php print($row['ID']); ?>" class="try1">delete</a>
                        </center>
                        </div>
                    </div>
                    <!-- <tr>
                        <td><img src="" alt="pic"></td>
                    <td><?php print($row['title']); ?></td>
                    <td><?php print($row['content']); ?></td>
                    <td><?php print($row['overview']); ?></td>
                    <td><?php print($row['date_of_publishing']); ?></td> 
                    <td align="center">
                    <a href="edit-data.php?edit_ID=<?php print($row['ID']); ?>" class="try1" >edit</a>
                    </td>
                    <td align="center">
                    <a href="delete.php?delete_ID=<?php print($row['ID']); ?>" class="try1">delete</a>
                    </td>-->
                    </tr><br><br><br>
                    <?php
                    
       }
      } 
      else
      {
       ?>
                <tr>
                <td>Nothing here...</td>
                </tr>
                <?php
      }

     }
    public function paging($query,$records_per_page) {
      $starting_position=0;
      if(isset($_GET["page_no"]))
      {
       $starting_position=($_GET["page_no"]-1)*$records_per_page;
      }
      $query2=$query." limit $starting_position,$records_per_page";
      return $query2;
     }
    
    public function paginglink($query, $records_per_page) {
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        if($total_no_of_records > 0) {
        ?><ul class="ul1"><?php
            $total_no_of_pages = ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }
            if($current_page !=1) {
                $previous = $current_page - 1;
                echo "<li><a href='".$self."?page_no=1'class= \"try1 li1\">First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'class= \"try1 li1\">Previous</a></li>";
            }
            for($i=1; $i<=$total_no_of_pages; $i++) {
                if($i==$current_page) {
                    echo "<li><a href='".$self."?page_no=".$i."'style='color:red;'class= \"try1 li1\">".$i."</a></li>";
                } else {
                    echo "<li><a href='".$self."?page_no=".$i."'class= \"try1 li1\">".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages) {
                $next=$current_page + 1;
                echo "<li><a href='".$self."?page_no=".$next."'class= \"try1 li1\">Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'class= \"try1 li1\">Last</a></li>";
            }
            ?></ul><?php
            
            
        }
    }
    
}
?>