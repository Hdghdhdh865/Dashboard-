 <?php 
 require './admin/inc/CONFIG.php';


 $stmt = $pdo->prepare("SELECT * FROM `posts`WHERE `status` = 'published'");
 $stmt->execute();
 $posts = $stmt->fetchAll();


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Blog</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #0d6efd;
    }
    .navbar-brand, .nav-link {
      color: white !important;
    }
    .nav-link:hover {
      text-decoration: underline;
    }

    .welcome-section {
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
        url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f') center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 120px 20px;
    }
    .welcome-section h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .post-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .post-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="./blog.php">MyBlog</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="./blog.php">Home</a></li>
         
        </ul>
      </div>
    </div>
  </nav>

  <section class="welcome-section">
    <div class="container">
      <h1>Welcome to My Blog</h1>
      <p class="lead mt-3">Insights, stories, and tips from the world of web development.</p>
    </div>
  </section>

  <section id="posts" class="py-5">
    <div class="container">
      <div class="row g-4">

      <div class="col-md-4">
          <?php foreach ($posts as $post) { ?>
          <div class="card post-card">
          
            <img src="./img/<?php echo $post['post _image'];  ?>" width=" " alt="" >
            <div class="card-body">
              <h5 class="card-title"><?php echo $post['post_title']; ?></h5>
              <p class="card-text"><?php echo $post['post_content']; ?></p>
              <a href="post_detail.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary">Read More</a>
            </div>
          
          </div>
            <?php }; ?>
        </div>

        

        
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 MyBlog. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
