<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare("INSERT INTO comments (post_id, name, email, comment, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->execute([$id, $name, $email, $comment]);
}
?>

<div class="mt-5">
    <h3>Comments</h3>

    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>
            </div>

            <div class="col-md-6">
                <input type="email" name="email" class="form-control mb-2" placeholder="Your Email" required>
            </div>
        </div>

        <textarea name="comment" class="form-control mb-2" rows="3" placeholder="Your Comment" required></textarea>

        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>

    <?php
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? AND status = 'approved' ORDER BY id DESC");
    $stmt->execute([$id]);
    $comments = $stmt->fetchAll();
    ?>

    <?php foreach ($comments as $c): ?>
        <div class="p-3 mb-3 border rounded bg-light">
            <strong><?php echo $c['name']; ?></strong>
            <p class="mb-1"><?php echo $c['comment']; ?></p>
            <small class="text-muted"><?php echo $c['created_at']; ?></small>
        </div>
    <?php endforeach; ?>
</div>
