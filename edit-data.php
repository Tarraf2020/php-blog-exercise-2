<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-update'])) {
    $ID = $_GET['edit_ID'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $overview = $_POST['overview'];
    
    if($crud->update($ID, $title, $content, $overview)) {
        $sms = "<div class='alert alert-info'>
                <strong>Yesh!</strong>Successfully updated
                <a href='index.php'>HOME</a>!</div>";
    } else {
        $sms = "<div class='alert alert-warning'>
                <strong>Oop!</strong>Error while updating record!
                </div>";
    }
}
if(isset($_GET['edit_ID'])) {
    $ID = $_GET['edit_ID'];
    extract($crud->getID($ID));
}
?>
<?php include_once 'header.php'; ?>
<div class=""></div>
<div class="">
<?php
    if(isset($sms)) {
        echo $sms;
    }
?>
</div>
<div class=""></div><br/>
<div class="">
    <form method="post">
        <table class="">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" class="" value="<?php echo $title; ?>" required />
                </td>
            </tr>
            <tr>
                <td>content</td>
                <td>
                    <input type="text" name="content" class="" value="<?php echo $content; ?>" required />
                </td>
            </tr>
            <tr>
                <td>overview</td>
                <td>
                    <input type="text" name="overview" class="" value="<?php echo $overview; ?>" required />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="" name="btn-update"> Update this record </button>
                    <a href="index.php" class="">CANCEL</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include_once 'footer.php'; ?>