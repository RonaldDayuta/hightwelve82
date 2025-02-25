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
    <div id="cms" class="cms">

    </div>
</div>

<script src="../js/UserHome.js"></script>