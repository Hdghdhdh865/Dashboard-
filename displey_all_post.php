<?php include 'inc/head.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php include 'inc/config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $img = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];

    move_uploaded_file($tmp_name, "img/$img");

    $stmt = $pdo->prepare("INSERT INTO `posts`(`post_title`, `post_content`, `cat_id`, `post_image`) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $category, $img]);

    header("Location: display_all_post.php");
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
                <h1 class="mt-4">Display All Posts</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `posts`";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $posts = $stmt->fetchAll();

                        foreach ($posts as $post) { ?>
                            <tr>
                                <th scope="row"><?php echo $post['post_id']; ?></th>
                                <td><?php echo htmlspecialchars($post['post_title']); ?></td>
                                <td><?php echo htmlspecialchars($post['post_content']); ?></td>
                                <td><img src="../img/<?php echo $post['post _image'];  ?>" width="100px " height="100px" alt="" ></td>
                              
                                <?php 
                                 $sql = "SELECT * FROM `categoy` WHERE cat_id = ?";
                                 $stmt = $pdo->prepare($sql);
                                 $stmt->execute([$post['category_id']]);
                                 $category = $stmt->fetch();
                                 ?>
                               <td> <?php echo $category['cat_name']; ?></td>



                                <td> <?php echo $post['post_status']; ?></td>
                                
                                <td> <?php echo $post['created_at']; ?></td>
                               
                                <td>
                                    <a href="edit_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <a href="del_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
        <?php include 'inc/footer.php'; ?>
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
