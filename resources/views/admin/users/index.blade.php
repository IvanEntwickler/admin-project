<x-admin-master>
    @section('content')
    @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{session('message')}}
          </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h1 class="m-0 font-weight-bold text-primary">All User</h1>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($users as $user)

                <tr>
                    <th>{{$user->id}}</th>
                    <th>{{$user->username}}</th>
                <th><a href="{{route('user.profile.show', $user->id)}}">{{$user->name}}</a></th>
                    <th><div><img class="img-fluid" src="{{$user->avatar}}" alt="image-pic"></div></th>
                    <th>{{$user->email}}</th>
                    <th>{{$user->password}}</th>
                    <th>

                        <form method="post" action="{{route('users.destroy', $user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete User</button>
                        </form>
                    </th>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- <div class="d-flex">
          <div class="mx-auto">
            <div>{{$users->links()}}</div>
          </div>
      </div> --}}

@endsection
@section('scripts')
            <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
</x-admin-master>
