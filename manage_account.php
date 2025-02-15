<div class="table-name">
  <h2>Manage Account</h2>
</div>
<div class="tables">
  <div class="account">
    <div class="acc-information">
      <div class="profile-account">
        <img src="MW_Cayanan_Temp__website-removebg-preview_1.png" alt="" />
      </div>
      <div class="account-info">
        <h2>Account Information</h2>
        <div class="input1">
          <div class="mb-3">
            <label for="email-account" class="form-label">Email</label>
            <input
              type="text"
              id="email-account"
              class="form-control"
              placeholder="Email"
            />
          </div>
          <div class="mb-3">
            <label for="pass-account" class="form-label">Password</label>
            <input
              type="password"
              id="pass-account"
              class="form-control"
              placeholder="Password"
              disabled
            />
          </div>
        </div>
        <!-- Button to Open Modal -->
        <button
          type="button"
          class="btn btn-primary mt-2"
          data-bs-toggle="modal"
          data-bs-target="#changePasswordModal"
        >
          Change Password
        </button>
      </div>
    </div>
  </div>
</div>

<div
  class="modal fade"
  id="changePasswordModal"
  tabindex="-1"
  aria-labelledby="changePasswordModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">
          Change Password
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="current-password" class="form-label"
              >Current Password</label
            >
            <input
              type="password"
              id="current-password"
              class="form-control"
              placeholder="Enter current password"
              required
            />
          </div>
          <div class="mb-3">
            <label for="new-password" class="form-label">New Password</label>
            <input
              type="password"
              id="new-password"
              class="form-control"
              placeholder="Enter new password"
              required
            />
          </div>
          <div class="mb-3">
            <label for="confirm-password" class="form-label"
              >Confirm New Password</label
            >
            <input
              type="password"
              id="confirm-password"
              class="form-control"
              placeholder="Confirm new password"
              required
            />
          </div>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
