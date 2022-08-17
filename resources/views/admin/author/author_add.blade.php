  @extends('home.dashboard')
  @section('admin')
      <div class="page-content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Add Author Page</h4> <br><br>
                              <form method="POST" action="{{ route('store.author') }}" class="was-validated">
                                  @csrf
                                  <div class="row mb-3">
                                      <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                      <div class="form-group col-sm-10">
                                          <input class="form-control" id="name" name="name" type="text"
                                              placeholder="First Name and Last Name" required>
                                      </div>
                                  </div>
                                  <!-- end row -->
                                  <div class="row mb-3">
                                      <label for="date_born" class="col-sm-2 col-form-label">Born Year</label>
                                      <div class="form-group col-sm-10">
                                          <input class="form-control" id="date_born" name="born" type="text">
                                      </div>
                                  </div>
                                  <!-- end row -->
                                  <input type="submit" value="Insert Author" class="btn btn-info waves-effect waves-light">
                              </form>
                          </div>
                      </div>
                  </div> <!-- end col -->
              </div>
          </div>
      </div>
  @endsection
