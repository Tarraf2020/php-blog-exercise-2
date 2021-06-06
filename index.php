<?php require 'auth.php'; ?>
<?php include_once 'dbconfig.php'; ?>
<?php include_once 'header.php'; ?>


<section>
<?php
      $query = "SELECT * FROM blogs";
      $records_per_page=3;
      $newquery = $crud->paging($query,$records_per_page);
      $crud->dataview($newquery);
?>
</section>
    <br><br><br>
      <?php $crud->paginglink($query,$records_per_page); ?>





<?php include_once 'footer.php'; ?>
