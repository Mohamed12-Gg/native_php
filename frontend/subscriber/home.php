<?php require_once('header.php');
$posts = $user->my_post($user->id);
?>
<!-- Hero Section -->
<div class="container hero-section text-center">
  <h1 class="hero-title mb-3">
    Welcome back, <span style="background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><?= htmlspecialchars($user->name) ?></span>! ✨
  </h1>
  <p class="hero-subtitle mb-5">
    We're thrilled to see you again. Explore your personalized control center featuring our brand-new premium experience.
  </p>
  <div class="d-flex justify-content-center gap-3">
    <a href="#" class="btn btn-custom">Get Started</a>
    <a href="profile.php" class="btn btn-outline-custom" style="padding: 10px 28px;">View Profile</a>
  </div>
</div>

<!-- Cards Section -->
<div class="container mb-5 pb-5">
  <div class="row g-4 justify-content-center">

    <!-- Card 1 -->
    <?php foreach ($posts as $post) {
    ?>
      <div class="col-12 col-md-6 col-lg-4 stagger-1">
        <div class="glass-card text-center">

          <!-- Post Image -->
          <div class="post-author-box d-flex align-items-center mb-4">
            <div class="rounded-circle bg-dark d-inline-flex align-items-center justify-content-center border border-info shadow-lg" style="width: 120px; height: 120px; overflow: hidden; padding: 2px;">
              <img src="<?= ($user->image) ? $user->image : '../images/defualt/image.png' ?>" class="rounded-circle w-100 h-100" style="object-fit: cover;">
            </div>
            <div class="author-info-text ms-3">
              <h6 class="author-name mb-0 text-white"><?= htmlspecialchars($user->name) ?></h6>
              <div class="post-meta-data d-flex align-items-center">
                <span class="meta-icon me-1"></span>
                <small class="meta-time"><?= date('M d, Y • h:i A', strtotime($post['created_at'])) ?></small>
              </div>
            </div>
          </div>
          <?php if ($post["image"]) { ?>
            <img src="<?= $post["image"] ?>" alt="Post Image" class="w-100 rounded mb-3" style="height: 200px; object-fit: cover; border: 1px solid var(--glass-border);">
          <?php } ?>
          <h3 class="card-title text-white mt-2"><?= $post["title"] ?></h3>
          <p class="card-text"><?= $post["content"] ?></p>

          <!-- Comments Section (UI Only) -->
          <div class="comments-section mt-4 text-start border-top border-secondary pt-3">
            <h6 class="text-white-50 mb-3"><span class="me-2">💬</span> Comments</h6>
            <?php
            $comments = $user->get_post_comments($post['id']);
            foreach ($comments as $comment) {
            ?>
              <div class="d-flex align-items-start mb-3">
                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white me-2 shadow-sm" style="width: 32px; height: 32px; font-size: 12px; flex-shrink: 0;"><img src="<?= $user->image ?>" alt="User Image" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="bg-dark rounded p-2" style="font-size: 13px; flex-grow: 1;">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <strong class="text-info"><?= $user->name ?></strong>
                    <small class="text-white-50" style="font-size: 10px;"><?= $comment['created_at'] ?></small>
                  </div>
                  <span class="text-white-50" style="word-break: break-word;"><?= htmlspecialchars($comment['comment']) ?></span>
                </div>
              </div>
            <?php } ?>
           


            <!-- Add Comment Form -->
            <form action="store_comment.php" class="d-flex mt-3">
              <input type="text" name="comment" class="form-control form-control-sm bg-dark border-secondary text-white shadow-none me-2 p-2 px-3" placeholder="Write a comment..." style="border-radius: 20px; font-size: 13px;">
              <input type="hidden" name="post_id" value="<?= $post['id'] ?>">

              <button type="submit" class="btn btn-sm btn-custom text-nowrap" style="border-radius: 20px; padding: 5px 15px;">Comment</button>
            </form>
          </div>

        </div>
      </div>
    <?php } ?>




  </div>
</div>

<?php require_once('footer.php'); ?>