@extends('templates.default')

@section('content')

<h1> File Upload</h1>
<form action ="" method ="post" enctype="multipart/form-data">
	<label>Select image to upload </label>
	<input type="file" name="file" id ="file">
	<input type="submit" value ="Upload" name="submit">
</form>

@stop