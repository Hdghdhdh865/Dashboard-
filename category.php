<?php include 'inc/head.php';?>
<?php include 'inc/nav.php';?>
<?php
require_once('inc/CONFIG.PHP');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `categoy`( `cat_name`, `description`) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description]);
    header("location: category.php");
    exit();
}
?>
       
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <?php include 'inc/side_nav.php'; ?>
  </div>

  <div id="layoutSidenav_content">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="py-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2"><i class="bi bi-tags"></i> Categories Management</h1>
        </div>

        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Add New Category</h5>
          </div>
          <div class="card-body">
            <form method="POST" class="row g-3">
              <div class="col-md-4">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="name">
              </div>
              <div class="col-md-6">
                <label for="categoryDescription" class="form-label">Description</label>
                <textarea class="form-control" id="categoryDescription" name="description"></textarea>
              </div>
              <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100" name="add_category">
                  <i class="bi bi-plus-circle"></i> Add
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">All Categories</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="categoriesTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM categoy");
                while ($row = $stmt->fetch()) { ?>
                  <tr>
                    <td><?php echo $row['cat_id']; ?></td>
                    <td><?php echo $row['cat_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                      <a href="edit_cat.php?id=<?php echo $row['cat_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                      <a href="del_cat.php?id=<?php echo $row['cat_id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a>
                    </td>
                    
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</div>

<?php include 'inc/footer.php';?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
