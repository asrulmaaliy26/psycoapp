<?php include("contentsConAdm.php");
// Handle toggle mode dosen: S1 atau S2
if (!empty($_GET['dosen_mode']) && in_array($_GET['dosen_mode'], ['S1', 'S2'])) {
  $_SESSION['dosen_mode'] = $_GET['dosen_mode'];
  // Redirect bersih tanpa query string
  header("location:dashboardAdm.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("headAdm.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include("navtopAdm.php");
    include("navSideBarAdmTaper.php");
    ?>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4 class="mb-0">Dashboard</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active small">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">

        </div>
      </section>
    </div>
  </div>
  <?php include("footerAdm.php"); ?>
  <?php include("jsAdm.php"); ?>
</body>

</html>