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
<<<<<<< HEAD

<script src="js/account.js"></script>
=======
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
