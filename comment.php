<?php
require 'inc/confige.php';

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $pdo->prepare("UPDATE comments SET status='approved' WHERE id=?")->execute([$id]);
}

if (isset($_GET['pending'])) {
    $id = $_GET['pending'];
    $pdo->prepare("UPDATE comments SET status='pending' WHERE id=?")->execute([$id]);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM comments WHERE id=?")->execute([$id]);
}

$stmt = $pdo->query("SELECT * FROM comments ORDER BY id DESC");
$comments = $stmt->fetchAll();
?>

<?php include 'inc/head.php'; ?>
<?php include 'inc/nav.php'; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include 'inc/side_nav.php'; ?>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Comments</h1>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Comments Table
                    </div>

                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($comments as $c): ?>
                                <tr>
                                    <td><?php echo $c['id']; ?></td>
                                    <td><?php echo $c['comment']; ?></td>
                                    <td><?php echo $c['status']; ?></td>
                                    <td><?php echo $c['created_at']; ?></td>

                                    <td>
                                        <a href="?approve=<?php echo $c['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                        <a href="?pending=<?php echo $c['id']; ?>" class="btn btn-warning btn-sm">Pending</a>
                                        <a href="?delete=<?php echo $c['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </main>

        <?php include 'inc/footer.php'; ?>
    </div>
</div>