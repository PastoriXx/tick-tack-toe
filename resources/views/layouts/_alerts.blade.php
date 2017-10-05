@if (session('status'))
	<div class="container">
	    <div class="row">
		    <div class="col-md-8 col-md-offset-2">
			    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        {{ session('status') }}
			    </div>
			</div>
		</div>
	</div>
@endif

@if ($errors->any())
	<div class="container">
	    <div class="row">
		    <div class="col-md-8 col-md-offset-2">
		    	@foreach($errors->all() as $error)
				    <div class="alert alert-danger">{{ $error }}</div>
				@endforeach
			</div>
		</div>
	</div>
@endif