<div class="accounts">
    <div class="name">
        <h3>Accounts Table</h3>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="material-icons-outlined"> person_add </span>
            Add Accounts
        </button>
    </div>
    <div class="search">
        <div class="group">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
                <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                    </path>
                </g>
            </svg>

            <input id="search-account" class="input" type="text" placeholder="Search..." name="searchbar" />
        </div>
    </div>

    <div class="tables">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Position</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="table-accounts"></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-account">
                    <div class="mb-3">
                        <label for="account-email" class="form-label">Email</label>
                        <input type="email" id="account-email" name="account-email" class="form-control"
                            placeholder="Email" required />
                    </div>
                    <div class="mb-3">
                        <label for="account-username" class="form-label">Username</label>
                        <input type="text" id="account-username" name="account-username" class="form-control"
                            placeholder="Username" required />
                    </div>
                    <div class="mb-3">
                        <label for="account-password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="account-password" name="account-password" class="form-control"
                                placeholder="Password" required />
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="account-copassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="account-copassword" name="account-copassword"
                                class="form-control" placeholder="Confirm Password" required />
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="account-position" class="form-label">Website Position</label>
                        <select id="account-position" name="account-position" class="form-control" required>
                            <option value="" selected disabled>Website Position</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="account-image" class="form-label">Profile Image</label>
                        <input type="file" id="account-image" name="account-image" class="form-control" accept="image/*"
                            required />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span id="button-text">Add Account</span>
                            <div id="spinner" class="spinner-border spinner-border-sm" role="status"
                                style="display: none;">
                                <span class="sr-only"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="form-update-account">
                    <input id="update-id" name="update-id" type="text" style="display: none" />
                    <div class="mb-3">
                        <label for="update-email" class="form-label">Email</label>
                        <input type="email" id="update-email" name="update-email" class="form-control"
                            placeholder="Email" required />
                    </div>
                    <div class="mb-3">
                        <label for="update-username" class="form-label">Username</label>
                        <input type="text" id="update-username" name="update-username" class="form-control"
                            placeholder="Username" required />
                    </div>
                    <div class="mb-3">
                        <label for="update-password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="update-password" name="update-password" class="form-control"
                                placeholder="Password" />
                            <button class="btn btn-outline-secondary toggle-password" type="button"><i
                                    class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="update-position" class="form-label">Website Position</label>
                        <select id="update-position" name="update-position" class="form-control" required>
                            <option value="" selected disabled>Website Position</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-status" class="form-label">Status</label>
                        <select id="update-status" name="update-status" class="form-control" required>
                            <option value="" selected disabled>Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span id="button-texts">Update Account</span>
                            <div id="spinners" class="spinner-border spinner-border-sm" role="status"
                                style="display: none;">
                                <span class="sr-only"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="../js/Account.js"></script>