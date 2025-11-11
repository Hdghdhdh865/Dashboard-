<?php include './inc/head.php';
 ?>
<?php include './inc/nav.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include './inc/side_nav.php'; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>

<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card border-success mb-3" style="max-width: 18rem;">
      <div class="card-header bg-transparent border-success">total post</div>
      <div class="card-body text-success">
        <?php 
         include './inc/CONFIG.php';
         $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `posts` ");
         $stmt->execute();
         $row = $stmt->fetch();
        ?>
        <p class="card-text"><?php echo $row[0]; ?></p>
        <a class="btn btn-success text-dark small stretched-link" href="#">View Details</a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card border-warning mb-3" style="max-width: 18rem;">
      <div class="card-header bg-transparent border-warning">total category</div>
      <div class="card-body text-warning">
        <?php 
         include './inc/CONFIG.php';
         $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM `categoy` ");
         $stmt->execute();
         $row = $stmt->fetch();
        ?>
        <p class="card-text"><?php echo $row[0]; ?></p>
        <a class="btn btn-warning text-dark small stretched-link" href="#">View Details</a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card border-primary mb-3" style="max-width: 18rem;">
      <div class="card-header bg-transparent border-primary">Primary Card</div>
      <div class="card-body text-primary">
        <p class="card-text">77</p>
        <a class="btn btn-primary text-dark small stretched-link" href="#">View Details</a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="card border-danger mb-3" style="max-width: 18rem;">
      <div class="card-header bg-transparent border-danger">Primary Card</div>
      <div class="card-body text-danger">
        <p class="card-text">77</p>
        <button class="btn btn-danger text-dark small stretched-link">View Details</button>
      </div>
    </div>
  </div>
</div>

        <?php include './inc/footer.php'; ?>
    </div> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="./admin/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
