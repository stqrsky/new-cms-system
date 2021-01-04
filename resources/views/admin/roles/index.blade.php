<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block"  type="submit">Create</button>
                </form>
            </div>

            <div class="col-sm-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Owner</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Delete</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Owner</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Delete</th>
                                </tr>
                              </tfoot>
                              <tbody>
                                <tr>

                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
            </div>
        </div>
    @endsection
</x-admin-master>