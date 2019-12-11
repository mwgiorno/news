<div class="card my-4">
	<h5 class="card-header">Search</h5>
	<div class="card-body">
		<form class="" action="{{ route('news.search') }}">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search by name..." name="word">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">Search</button>
			</span>
		</div>
		</form>
	</div>
</div>
