<x-admin-master>
    @section('content')
    @if(count($posts) === 0)
    <h1>NO POSTS</h1>
    @else
        @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{session('message')}}
          </div>
        @endif
        @if (session('post-created-message'))
        <div class="alert alert-success" role="alert">
            {{session('post-created-message')}}
          </div>
        @endif
        @if (session('post-updated-message'))
        <div class="alert alert-warning" role="alert">
            {{session('post-updated-message')}}
          </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary">All Posts</h1>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Id</th>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Category_id</th>
                        <th>Category_name</th>
                        <th>Image</th>
                        <th>Body</th>
                        <th>createdAt</th>
                        <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Id</th>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Category_id</th>
                        <th>Category_name</th>
                        <th>Image</th>
                        <th>Body</th>
                        <th>createdAt</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($posts as $post)

                    <tr>
                        <th>{{$post->id}}</th>
                        <th>{{$post->user->name}}</th>
                    <th><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></th>
                    <th>{{$post->category_id}}</th>
                    <th>{{$post->category->name}}</th>
                        <th><div><img class="img-fluid" src="{{$post->post_image}}" alt="image-pic"></div></th>
                        <th>{{$post->body}}</th>
                        <th>{{$post->created_at->diffForHumans()}}</th>
                        <th>
                            @can('view', $post)
                            <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete Post</button>
                            </form>
                            @endcan
                        </th>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @endif
          <div class="d-flex">
              <div class="mx-auto">
                <div>{{$posts->links()}}</div>
              </div>
          </div>

    @endsection
    @section('scripts')
                <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>
