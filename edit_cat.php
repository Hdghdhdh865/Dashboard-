<?php include 'inc/head.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php
require_once('inc/CONFIG.PHP');


$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM categoy WHERE cat_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    header("location: category.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE categoy SET cat_name = ?, description = ? WHERE cat_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $id]);
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
          <h1 class="h2"><i class="bi bi-tags"></i> Edit Category</h1>
        </div>

        <div class="card mb-4">
          <div class="card-header">
            <h5 class="card-title mb-0">Edit Category Details</h5>
          </div>
          <div class="card-body">
            <form method="POST" class="row g-3">
              <div class="col-md-4">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="name" value="<?php echo htmlspecialchars($category['cat_name']); ?>" required>
              </div>
              <div class="col-md-6">
                <label for="categoryDescription" class="form-label">Description</label>
                <textarea class="form-control" id="categoryDescription" name="description" required><?php echo htmlspecialchars($category['description']); ?></textarea>
              </div>
              <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">
                  <i class="bi bi-check-circle"></i> Update
                </button>
              </div>
            </form>
          </div>
        </div>

        <a href="category.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Categories</a>

      </div>
    </main>
  </div>
</div>

<?php include 'inc/footer.php'; ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
