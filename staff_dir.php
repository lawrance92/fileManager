<?php
require_once('config.php');

$query  = "SELECT * FROM users";
$result = mysqli_query($db, $query);

// Test if there was a query error
if (!$result) {
    die("Database query failed.");
}
?>

<!-- Page Header -->
<?php $pageid = "staffdir"; $title = "Dashboard - Staff Directory"; include('header.php'); ?>

<?php include('bossmenu.php'); ?>

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Staff Directory</h3>
        <div class="row">
            <div class="col-md-12 mt">
                <div class="content-panel">
                    <table class="table table-hover">
                        <h4><i class="fa fa-angle-right"></i>Staffs</h4>
                        <hr>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($staff = mysqli_fetch_assoc($result)) {
                            // output data from each row
                            ?>
                            <tr>
                            <td><?php echo $staff["userid"]; ?></td>
                            <td><?php echo $staff["type"]; ?></td>
                            <td><?php echo $staff["name"]; ?></td>
                            <td><?php echo $staff["email"]; ?></td>
                            <td><?php echo $staff["username"]; ?></td>
                            </tr><?php
                        }
                        mysqli_free_result($result);
                        ?>
                        </tbody>
                    </table>
                </div><! --/content-panel -->
            </div><!-- /col-md-12 -->
        </div><!-- row -->
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<!--main content end-->

<?php include('footer.php'); ?>
<?php mysqli_close($db); ?>
