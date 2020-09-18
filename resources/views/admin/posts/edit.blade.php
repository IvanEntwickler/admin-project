<x-admin-master>
    @section('content')
    <h1>EDIT A POST</h1>
<form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input
            type="text"
            name="title"
            class="form-control"
            id="title"
            placeholder="Enter Title"
            value={{$post->title}}
            >
        </div>
        <div class="form-group">
            <div>
            <img class="img-fluid" src="{{$post->post_image}}" alt="pic">
            </div>
            <label for="file">File</label>
            <input
            type="file"
            name="post_image"
            class="form-control-file"
            id="file"
            >
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
            @foreach ($posts->unique('category_id') as $post)
            <option value="{{$post->category_id}}">{{$post->category->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <textarea
            name="body"
            id="body"
            class="form-control"
            cols="30"
            rows="10"
            >{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    @endsection
</x-admin-master>
