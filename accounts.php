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
        <th scope="col">UserName</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Position</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Accounts</h1>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
        ></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="account-email" class="form-label">Email</label>
          <input
            type="text"
            id="account-email"
            class="form-control"
            placeholder="Email"
          />
        </div>
        <div class="mb-3">
          <label for="account-password" class="form-label">Password</label>
          <input
            type="text"
            id="account-password"
            class="form-control"
            placeholder="Password"
          />
        </div>
        <div class="mb-3">
          <label for="account-copassword" class="form-label"
            >Confirm-Password</label
          >
          <input
            type="text"
            id="account-copassword"
            class="form-control"
            placeholder="Confirm-Password"
          />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Add Account</button>
      </div>
    </div>
  </div>
</div>
