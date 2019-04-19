<div class="row">
@csrf
@foreach($new_caleg as $partial)
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="parent">
				<img src="{{ asset('images/caleg/'.$partial['photo']) }}" alt="" style="width: 100%;">
			</div>
			<br>
			<h4>{{ $partial['name'] }}</h4>
			<p class="minus_text" style="margin-top: -20px;">{{ $partial['partai_name'] }}</p>
			<div class="form-group">
				<input type="number" class="form-control" placeholder="Jumlah Suara" name="number_of_votes[]">
				<input type="hidden" name="caleg_id[]" value="{{ $partial['id'] }}">
				<input type="hidden" name="pemilu_setting_id[]" value="{{ $pemilu_setting_id }}">
			</div>
		</div>
	</div>
</div>
@endforeach
</div>
</form>