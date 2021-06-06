<?php require 'auth.php'; ?>
<?php 
include_once 'dbconfig.php';
if(isset($_POST['btn-del'])) {
    $ID = $_GET['delete_ID'];
    $crud->delete($ID);
    header("location: delete.php?deleted");
}
?>
<?php include_once 'header.php'; ?>
<div class=""></div>
<div class="">
    <?php
    if(isset($_GET['deleted'])) {    
    ?>
    <div class="">
        <strong>Success!</strong> Record was successully deleted!
    </div>
    <?php
    } else {
    ?>
    <div class="">
        <strong>Sure !</strong> to remove the following record ?
    </div>
    <?php
    }
    ?>
</div>
<div class=""></div>
<div class="">
    <?php 
    if(isset($_GET['delete_ID'])) {  
    ?>
        
        <?php
        $stmt = $dbc->prepare("SELECT * FROM blogs WHERE ID=:ID");
        $stmt->execute(array(":ID"=>$_GET['delete_ID']));
        while($row=$stmt->fetch(PDO::FETCH_BOTH)) {  
        ?>
        <tr>
            <td><?php print($row['title']); ?></td>
            <td><?php print($row['content']); ?></td>
            <td><?php print($row['overview']); ?></td>
            <td><?php print($row['date_of_publishing']); ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
    ?>
</div>
<div class="container">
<p>
<?php
if(isset($_GET['delete_ID'])) {
?>
    <form method="post">
        <input type="hIDden" name="ID" value="<?php echo $row['ID']; ?>" />
        <button class="try1" type="submit" name="btn-del">YES</button>
        <a href="index.php" class="try1">NO</a>
    </form>
<?php
} else {
?>
    <a href="index.php" class="try1">Back to index</a>
<?php
}
?>
</p>
</div>
<?php include_once 'footer.php'; ?>