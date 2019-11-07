@extends('template')

@section('contact')
<h2>Category Edit Form</h2>



<form method="post" action="{{route('category.update',$categories->id)}}">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label>Category Name</label>
		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$categories->name}}">@error('name')
    <div class="text-danger">{{ "This field is required" }}</div>
@enderror
	</div>

	
	<div class="form-group">
		
		<input type="submit" name="btnsubmit" value="Update"><br>
	</div>
	

</form>





@endsection