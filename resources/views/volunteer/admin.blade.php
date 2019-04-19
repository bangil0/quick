@extends('templates.master')

@section('title','Relawan')

@section('page_name','Relawan')

@section('breadcrumb')
	<li>Menu</li>
	<li><a href="">Relawan</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-success">Relawan</h4>
					</div>
					<div class="panel-body">
						<table class="table text-nowrap table-striped" id="myTable">
							<thead>
								<tr>
									<th>No</th>
									<th>NIP</th>
									<th>Name</th>
									<th>Email</th>
									<th>Address</th>
									<th>Tanggal Lahir</th>
									<th>Tanggal Daftar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($array as $data)
								<tr>
									<td>&nbsp;&nbsp;&nbsp;{{ $loop->index + 1 }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['nip'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['name'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['email'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['address'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['date_of_birth'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $data['created_at'] }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop