<x-admin-master>
    @section('content')
    <h1>EDIT A PERMISION</h1>
    <div class="row">

        @if(session()->has('permission-update'))
        <div class="alert alert-success">
            {{session('permission-update')}}
        </div>
        @elseif(session()->has('permission-unchanged'))
        <div class="alert alert-warning">
            {{session('permission-unchanged')}}
        </div>
        @endif
    </div>
<div class="row">
    <div class="col-sm-6">

<form method="post" action="{{route('permissions.update', $permission->id)}}" enctype="multipart/form-data">
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
            value={{$permission->name}}
            >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>
@endsection
</x-admin-master>

