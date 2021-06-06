<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $overview = $_POST['overview'];
    
    if($crud->create($title, $content, $overview)) {
        header("location: add-data.php?inserted");
    } else {
        header("location: add-data.php?failure");
    }
}
?>
<?php include_once 'header.php'; ?>
<div class=""></div>
<?php
if(isset($_GET['inserted'])) {  
?>
<div class="">
    <div class="alert alert-info">
        <strong>Yesh!</strong>Successfully inserted<a href="index.php">&nbsp;HOME</a>!
    </div>
</div>
<?php 
} else if(isset($_GET['failure'])) {
?>
<div class="">
    <div class="">
        <strong>Opp!</strong>Error while inserting data!
    </div>
</div>
<?php
}
?>
<div class="">
    <form method="post">
        <table class="">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" class="" required /></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><input type="text" name="content" class="" required /></td>
            </tr>
            <tr>
                <td>Overview</td>
                <td><input type="text" name="overview" class="" required /></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="try1" name="btn-save"> Create New Record </button>
                    <a href="index.php" class="try1">Back to index</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include_once 'footer.php'; ?>
