  @extends('home.dashboard')
  @section('admin')
      <div class="page-content">
          <div class="container-fluid">

              <!-- start page title -->
              <div class="row">
                  <div class="col-12">
                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                          <h4 class="mb-sm-0">All Authors</h4>
                      </div>
                  </div>
              </div>
              <!-- end page title -->

              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-editable table-nowrap align-middle table-author">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th>Born Year</th>
                                              <th>Edit</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($authors as $key => $item)
                                              <tr data-id="{{ $item->id }}">
                                                  <td style="width: 80px">{{ $key }}</td>
                                                  <td data-field="name">{{ $item->name }}
                                                  </td>
                                                  <td data-field="born">{{ $item->born }}</td>
                                                  <td style="width: 100px">
                                                      <div style="display:none"
                                                          class="spinner-border spinner-border-sm text-success myspinner"
                                                          role="status">
                                                      </div>
                                                      <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                          <i class="fas fa-pencil-alt"></i>
                                                      </a>
                                                      <a href="{{ route('delete.author', $item->id) }}"
                                                          class="btn btn-danger btn-sm" title="Delete Data"
                                                          id="delete"><i class="fas fa-trash-alt"></i></a>
                                                  </td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div> <!-- end col -->
              </div> <!-- end row -->
          </div> <!-- container-fluid -->
      </div>
  @endsection
