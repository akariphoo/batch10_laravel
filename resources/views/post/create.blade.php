@extends('template')

@section('contact')
<h2>Post Create Form</h2>
<!-- return from validation result -->
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->


<form enctype="multipart/form-data" method="post" action="{{route('post.store')}}">
	@csrf
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
@error('title')
    <div class="text-danger">{{ "This field is required" }}</div>
@enderror
		<br>
	</div>

	<div class="form-group">
		<label>Content</label>
		<textarea name="content" class="form-control @error('content') is-invalid @enderror"></textarea>
@error('content')
    <div class="text-danger">{{ "This field is required" }}</div>
@enderror<br>
	</div>
	<div class="form-group">
		<label>Photo</label><span class="text-danger">[supported file types:jpeg,png]</span>
		<input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
		@error('photo')
    <div class="text-danger">{{ "This field is required" }}</div>
@enderror
		<br>
	</div>
	<div class="form-group">
		<label>categories</label>
		<select name="category" class="form-control @error('photo') is-invalid @enderror">
			@error('photo')
    <div class="text-danger">{{ "This field is required" }}</div>
@enderror
			<option value="">Choose Category</option>
			{-- accept data and loop--}
			{--$categories must equal from PageController's compact('categories') --}
			@foreach($categories as $row)
			<option value="{{$row->id}}">{{$row->name}}</option>
			@endforeach
		</select>

	</div>
	<div class="form-group">
		
		<input type="submit" name="btnsubmit" value="Post"><br>
	</div>
	

</form>





@endsection