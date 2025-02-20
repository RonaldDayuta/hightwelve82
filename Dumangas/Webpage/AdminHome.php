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

<style>
    .post-images {
        position: relative;
        max-width: 100%;
    }

    .post-img {
        width: 100%;
        max-height: 50rem;
        border-radius: 5px;
    }

    /* --- "+X More" Button --- */
    .more-images-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .more-images-btn:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    /* --- Modal Background (Centered) --- */
    .modals {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .active {
        display: flex;
    }

    /* --- Modal Content Box (Centered) --- */
    .modal-contents {
        background: #323639;
        padding: 20px;
        border-radius: 10px;
        max-width: 80%;
        max-height: 80%;
        overflow-y: auto;
        text-align: center;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    /* --- Modal Image Grid (Better Spacing) --- */
    .modal-contents img {
        width: auto;
        max-width: 300px;
        max-height: 300px;
        margin: 10px;
        border-radius: 5px;
        object-fit: cover;
    }

    /* --- Close Button (Fixed Position) --- */
    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        color: white;
        font-size: 30px;
        cursor: pointer;
        font-weight: bold;
    }

    .close-btn:hover {
        color: red;
    }

    .buttons-post {
        display: flex;
        justify-content: end;
        gap: 1rem;
        padding: .5rem;
    }

    .buttons-post button {
        border: none;
        border-radius: .5rem;
        padding: .3rem;
        height: 2rem;
    }

    .buttons-post #update_post {
        color: #6c9bcf;
        background-color: #323639;
    }

    .buttons-post #delete_post {
        color: #ff0060;
        background-color: #323639;
    }
</style>

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
                        <input type="file" class="form-control" name="images[]" multiple accept="image/*">
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