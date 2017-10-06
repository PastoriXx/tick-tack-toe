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

@if (session('error'))
	<div class="container">
	    <div class="row">
		    <div class="col-md-8 col-md-offset-2">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ session('error') }}
				</div>
			</div>
		</div>
	</div>
@endif

<div class="container js-alert-container hidden">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p></p>
			</div>
		</div>
	</div>
</div>