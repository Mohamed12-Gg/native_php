<?php require_once('header.php');

$posts = $user->my_post($user->id);
?>

<div class="container hero-section text-center py-5" style="margin-top: 50px;">
    <h2 class="hero-title mb-5">Your Profile</h2>

    <div class="row justify-content-center g-4">

        <!-- Profile Info Card -->
        <div class="col-12 col-lg-4 stagger-1">
            <div class="glass-card text-center p-4">
                <div class="mb-4">
                    <!-- Profile Avatar & Update Form -->
                    <div class="mb-3 text-center">
                        <div class="rounded-circle bg-dark d-inline-flex align-items-center justify-content-center border border-info shadow-lg" style="width: 100px; height: 100px; overflow: hidden; padding: 2px;">
                            <img src="<?= ($user->image) ? $user->image : '../images/defualt/image.png' ?>" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                        </div>
                        <form action="update_profile_image.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <label for="profileImage" class="btn btn-sm btn-outline-info" style="cursor: pointer; border-radius: 20px; padding: 5px 15px;">
                                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'Profile_image_updated_successfully') { ?>
                                    <div class="alert alert-success">
                                        Profile image updated successfully
                                    </div>
                                <?php } ?>
                                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'Please_select_an_image') { ?>
                                    <div class="alert alert-danger">
                                        Please select an image
                                    </div>
                                <?php } ?>
                                <span class="fs-6 me-1">📸</span> Change Image

                                <button class="btn p-2" type="submit">Save</button>
                            </label>
                            <input type="file" id="profileImage" name="profile_image" class="d-none">
                        </form>
                    </div>
                    <h4 class="text-white mb-0 fw-bold"><?= $user->name ?></h4>
                    <p class="text-white-50 small mt-1"><?= $user->role ?></p>
                </div>

                <div class="text-start px-2 mt-4 pt-3 border-top border-secondary">
                    <div class="mb-3">
                        <label class="text-white-50 small text-uppercase fw-bold d-block mb-1">Phone Number</label>
                        <div class="d-flex align-items-center text-white">
                            <span class="me-2 opacity-75">📞</span>
                            <?= $user->phone ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Post Form Card -->
        <div class="col-12 col-lg-6 stagger-2">
            <div class="glass-card text-start p-4 h-100">
                <h4 class="text-white mb-4 border-bottom pb-3 border-secondary d-flex align-items-center">
                    <span class="me-2 fs-4">📝</span> Create New Post
                </h4>

                <form novalidate action="storePost.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'Post_created_successfully') { ?>
                        <div class="alert alert-success">
                            Post created successfully
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'Please_fill_all_the_fields') { ?>
                        <div class="alert alert-danger">
                            Please fill all the fields
                        </div>
                    <?php } ?>
                    <div class="mb-4">
                        <label for="postTitle" class="form-label text-white-50 small fw-bold">Post Title</label>
                        <input value="<?= isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '' ?>" type="text" class="form-control bg-dark border-secondary text-white shadow-none" id="postTitle" name="title" placeholder="Enter a catchy title..." required style="border-radius: 10px; padding: 12px 15px;">
                    </div>

                    <div class="mb-4">
                        <label for="postContent" class="form-label text-white-50 small fw-bold">Content</label>
                        <textarea class="form-control bg-dark border-secondary text-white shadow-none" id="postContent" name="content" rows="4" placeholder="What's on your mind?" required style="border-radius: 10px; padding: 12px 15px; resize: none;"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="postImage" class="form-label text-white-50 small fw-bold">Cover Image</label>
                        <input class="form-control bg-dark border-secondary text-white-50 shadow-none" type="file" id="postImage" name="image" style="border-radius: 10px;">
                    </div>

                    <div class="text-end mt-4 pt-2">
                        <button type="submit" class="btn btn-custom w-100 py-2 fs-6">Publish Post</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- Fix CSS specific for forms matching the theme -->
<style>
    .form-control:focus {
        background-color: #212529;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 242, 254, 0.25);
        color: white;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }
</style>

<?php require_once('footer.php'); ?>