<div class="table-name">
  <h2>Accounts</h2>
  <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <span class="material-icons-outlined"> person_add </span>
    <span>Add Account</span>
  </button>
</div>

<div class="tables">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Password</th>
        <th scope="col">Position</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="table-accounts"></tbody>
  </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="email" id="account-email" name="account-email" class="form-control" placeholder="Email" required />
          </div>
          <div class="mb-3">
            <label for="account-username" class="form-label">Username</label>
            <input type="text" id="account-username" name="account-username" class="form-control" placeholder="Username" required />
          </div>
          <div class="mb-3">
            <label for="account-password" class="form-label">Password</label>
            <input type="password" id="account-password" name="account-password" class="form-control" placeholder="Password" required />
          </div>
          <div class="mb-3">
            <label for="account-copassword" class="form-label">Confirm Password</label>
            <input type="password" id="account-copassword" name="account-copassword" class="form-control" placeholder="Confirm Password" required />
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
            <label for="account-image" class="form-label">Profile Image (Optional)</label>
            <input type="file" id="account-image" name="account-image" class="form-control" accept="image/*" />
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Account</button>
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
          <input id="update-id" name="update-id" type="text" style="display: none;">
          <div class="mb-3">
            <label for="update-email" class="form-label">Email</label>
            <input type="email" id="update-email" name="update-email" class="form-control" placeholder="Email" required />
          </div>
          <div class="mb-3">
            <label for="update-username" class="form-label">Username</label>
            <input type="text" id="update-username" name="update-username" class="form-control" placeholder="Username" required />
          </div>
          <div class="mb-3">
            <label for="update-password" class="form-label">Password</label>
            <input type="password" id="update-password" name="update-password" class="form-control" placeholder="Password" required />
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
            <label for="update-statuus" class="form-label">Status</label>
            <select id="update-status" name="update-status" class="form-control" required>
              <option value="" selected disabled>Status</option>
              <option value="Active">Active</option>
              <option value="InActive">InActive</option>
              <option value="Suspended">Suspended</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="js/account.js"></script>