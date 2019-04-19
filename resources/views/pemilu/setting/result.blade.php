@extends('templates.master')

@section('title','Hasil Pemilu')

@section('page_name','Hasil Pemilu')

@section('breadcrumb')
	<li>Wilayah</li>
	<li><a href="">Pemilu</a></li>
	<li><a href="">Hasil Pemilu</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-success">Daftar Pemilu</h4>
					</div>
					<div class="panel-body">
						<table class="table text-nowrap table-striped">
							<thead>
								<th>No</th>
								<th>Nama Pemilu</th>
								<th>Tipe Pemilu</th>
								<th>Jumlah Caleg Dalam Pemilu</th>
								<th>Total Suara</th>
								<th>Aksi</th>
							</thead>
							<tbody>
								@foreach($array as $data)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>{{ $data['pemilu_name'] }}</td>
									<td>{{ $data['pemilu_type'] }}</td>
									<td>{{ $data['count_candidates'] }}</td>
									<td>{{ $data['count_transaction'] }}</td>
									<td>
										<a class="btn btn-sm btn-success btn-icon btn-icon-circle" href="{{ url('transaction/caleg/'.$data['id'])}}"><span class="ti-eye"></span></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection