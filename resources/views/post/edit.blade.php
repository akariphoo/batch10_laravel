@extends('template')

@section('contact')
<h2>Post Edit Form</h2>
<!-- return from validation result -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form enctype="multipart/form-data" method="post" action="{{route('post.update',$post->id)}}">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" class="form-control" value="{{$post->title}}"><br>
	</div>

	<div class="form-group">
		<label>Content</label>
		<textarea name="content" class="form-control">{{$post->body}}</textarea><br>
	</div>
	<div class="form-group">
		<label>Photo</label><span class="text-danger">[supported file types:jpeg,png]</span>
		<input type="file" name="photo" class="form-control">
		<img src="{{asset($post->image)}}" class="img-fluid w-25">
		<br>
		<input type="hidden" name="oldphoto" value="{{$post->image}}">
	</div>
	<div class="form-group">
		<label>categories</label>
		<select name="category" class="form-control">
			<option value="">Choose Category</option>
			{-- accept data and loop--}
			{--$categories must equal from PageController's compact('categories') --}
			@foreach($categories as $row)
			<option value="{{$row->id}}"
				@if($row->id==$post->category_id)
				{{'selected'}}
				@endif
				>{{$row->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		
		<input type="submit" name="btnsubmit" value="Update"><br>
	</div>
	

</form>





@endsection