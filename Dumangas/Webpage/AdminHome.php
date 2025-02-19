<?php
session_start();

//include_once "calendar.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Get session variables for displaying the profile
$username = $_SESSION['admin_username'];
$profile = $_SESSION['admin_image'];
$email = $_SESSION['admin_email'];
$id = $_SESSION['admin_id'];

?>

<div class="home">
    <div class="post-container">
        <div class="post">
            <img src="<?php echo $profile ?>" alt="" />
            <button type="button" data-bs-toggle="modal" data-bs-target="#addpost">Want to Post?</button>
        </div>
        <hr />
        <button type="button" data-bs-toggle="modal" data-bs-target="#addpost">
            <span class="material-icons-outlined"> image </span>
            Photo
        </button>
    </div>
    <div id="cms" class="cms">

    </div>
</div>

<div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="addpostLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addpostLabel">Post Something</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPostForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $username ?>" readonly />
                    </div>
                    <div class="mb-3" style="display: none;">
                        <label class="form-label">Profile Image</label>
                        <input type="text" class="form-control" name="profile_img" value="<?php echo $profile ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter Post description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Post</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="../js/Home.js"></script>