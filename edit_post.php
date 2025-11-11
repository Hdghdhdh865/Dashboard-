<?php
include 'inc/head.php';
include 'inc/nav.php';
include 'inc/config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE post_id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) {
    header("Location: display_all_post.php");
    exit();
}

$cat_stmt = $pdo->prepare("SELECT * FROM `categoy`");
$cat_stmt->execute();
$categories = $cat_stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    $img = $post['post_image']; 
    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        move_uploaded_file($tmp_name, "img/$img");
    }

    $sql = "UPDATE `posts` SET `post_title` = ?, `post_content` = ?, `category_id` = ?, `post _image` = ?, `post_status` = ? WHERE `post_id` = ?";
   
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $category, $img, $status, $id]);
      header("location: displey_all_post.php");
    exit();

   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php'; ?>
</head>
<body>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include 'inc/side_nav.php'; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit Post</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($post['post_title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($post['post_content']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
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
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="published" <?php echo ($post['post_status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?php echo ($post['post_status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" class="form-control" id="img" name="img">
                        <small class="form-text text-muted">Leave empty to keep current image.</small>
                        <?php if ($post['post _image']): ?>
                            <img src="img/<?php echo $post['post _image']; ?>" width="80" alt="Current Image">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                    <a href="display_all_post.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </main>
        <?php include 'inc/footer.php'; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
