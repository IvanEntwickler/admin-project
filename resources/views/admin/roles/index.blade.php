<x-admin-master>

    @section('content')

    <div class="row">
            @if(session()->has('role-delete'))
            <div class="alert alert-danger">
                {{session('role-delete')}}
                </div>
            </div>
            @endif
    </div>
    <div class="row">

            <div class="col-sm-2">
            <form  method='post' action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                        class="form-control @error('name') is-invalid @enderror"
                        type="text"
                        name="name"
                        id="name"
                        >
                    </div>
                    @error('name')
                    <div><span class='text-danger'><strong>{{$message}}</strong></span></div>
                    @enderror

                    <button class="btn btn-primary btn-block" type="submit">Create</button>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="card shadow m">
                    <div class="card-header py-3">
                      <h1 class="m-0 font-weight-bold text-primary">Roles</h1>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($roles as $role)

                            <tr>
                                <th>{{$role->id}}</th>
                                <th>{{$role->name}}</th>
                                <th>{{$role->slug}}</th>
                                <th>

                                    <form method="post" action="{{route('roles.destroy', $role)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete Role</button>
                                    </form>
                                </th>
                            </tr>
                            @endforeach

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    @endsection
</x-admin-master>
