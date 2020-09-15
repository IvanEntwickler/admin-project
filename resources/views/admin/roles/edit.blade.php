<x-admin-master>
    @section('content')
    <h1>EDIT A ROLE</h1>
    <div class="row">

        @if(session()->has('role-update'))
        <div class="alert alert-success">
            {{session('role-update')}}
        </div>
        @elseif(session()->has('role-unchanged'))
        <div class="alert alert-warning">
            {{session('role-unchanged')}}
        </div>
        @endif
    </div>
<div class="row">
    <div class="col-sm-6">

<form method="post" action="{{route('roles.update', $role->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            placeholder="Enter Name"
            value={{$role->name}}
            >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>

@if(count($permissions) !== 0)
<div class="row">
    <div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h1 class="m-0 font-weight-bold text-primary">Permissions</h1>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Options</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Attach</th>
                    <th>Detach</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Options</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Attach</th>
                    <th>Detach</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($permissions as $permission)

                <tr>
                    <th>
                        <input type="checkbox"
                        @foreach($role->permissions as $role_permission)
                        @if($role_permission->name == $permission->name)
                            checked
                        @endif
                        @endforeach
                        ></th>
                    <th>{{$permission->id}}</th>
                    <th><a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a></th>
                    <th>{{$permission->slug}}</th>
                    <td>
                        <form method='post' action="{{route('role.permission.attach', $role)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <button
                            class='btn btn-primary'
                            type='submit'
                            @if($role->permissions->contains($permission))
                                disabled
                            @endif
                            >Attach</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action="{{route('role.permission.detach', $role)}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <button
                            class='btn btn-danger'
                            type='submit'
                            @if(!$role->permissions->contains($permission))
                                disabled
                            @endif
                            >Detach</button>
                        </form>
                    </td>
                </tr>

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endif
    @endsection
</x-admin-master>
