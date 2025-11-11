<?php include './inc/CONFIG.php'; ?>
<?php include './inc/head.php'; ?>
<?php include './inc/nav.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    $status = $_POST['status'];

    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "/img/$image");
    }

    $sql = "INSERT INTO `posts` (`post_title`, `post_content`, `category_id`, `post _image`, `post_status`) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $category, $image, $status]);
      header("location: displey_all_post.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Navbar</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      
      <form class="d-flex" role="search">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
       
      </ul>
      </form>
    </div>
  </div>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include 'inc/side_nav.php'; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Add New Post</h1>

                <form  method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <?php
                            $sql = "SELECT * FROM `categoy`"; 
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $categories = $stmt->fetchAll();

                            foreach ($categories as $cat) { ?>
                                <option value="<?php echo $cat['cat_id']; ?>">
                                    <?php echo htmlspecialchars($cat['cat_name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button name="submit" type="submit" class="btn btn-primary" style="width:100%; margin-top:10px;">
                        Submit
                    </button>

                    <a href="dashboard.php" class="btn btn-secondary" style="width:100%; margin-top:10px;">
                        Back to Dashboard
                    </a>
                </form>
            </div>
        </main>

        <?php include 'inc/footer.php'; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
