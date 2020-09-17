<x-admin-master>
    @section('content')
    <h1>EDIT A CATEGORY</h1>
    <div class="row">

        @if(session()->has('category-update'))
        <div class="alert alert-success">
            {{session('category-update')}}
        </div>
        @elseif(session()->has('category-unchanged'))
        <div class="alert alert-warning">
            {{session('category-unchanged')}}
        </div>
        @endif
    </div>
<div class="row">
    <div class="col-sm-6">

<form method="post" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
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
            value={{$category->name}}
            >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>

@if(count($categories) !== 0)
<div class="row">
    <div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h1 class="m-0 font-weight-bold text-primary">Categories</h1>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($categories as $category)

                <tr>
                    <th>{{$category->id}}</th>
                    <th><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></th>
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
