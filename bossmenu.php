<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start-->
<?php
$staff = ['staffdir', 'staffreg'];
?>
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <!--
            <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
            <h5 class="centered">Marcel Newman</h5>
            -->

            <li class="mt">
                <a <?php if ($pageid == "home") { echo 'class="active"'; } ?> href="index.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>


 
            <li class="sub-menu">
                <a <?php if (in_array($pageid, $staff))  { echo 'class="active"'; } ?> href="javascript:;" >
                    <i class="fa fa-book"></i>
                    <span>ADD USERS</span>
                </a>
                <ul class="sub">
                    <li <?php if ($pageid == "staffdir") { echo 'class="active"'; } ?>><a  href="staff_dir.php">Directory</a></li>
                    <li <?php if ($pageid == "staffreg") { echo 'class="active"'; } ?>><a  href="staff_reg.php">Add Staff</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->