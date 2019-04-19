@extends('templates.master')

@section('title','Data Partai')

@section('page_name','Partai')

@section('breadcrumb')
	<li>Menu</li>
	<li>Partai</li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Partai</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ route('partai.store') }}" method="post" enctype="multipart/form-data">
								@csrf		
			                    <div class="modal-body">
			                    	<div class="form-group">
										<label>Logo Partai</label>
										<input type="file" class="form-control" name="photo" required>
									</div>

			                    	<div class="form-group">
										<label>Nama Partai</label>
										<input type="text" class="form-control" name="partai_name" required value="{{ old('partai_name') }}" placeholder="Nama Partai">
									</div>
			                    </div>
			                    <div class="modal-footer">
			                    	<button class="btn btn-success" type="submit">Submit</button>
			                    </div>
			                    </form>
			                </div>
			            </div>
			        </div>
			    </div>
				
				<div class="panel panel-default">
					<div class="panel-heading"><h4 class="text-success">Partai</h4></div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
								<thead>
									<th>No</th>
									<th>Logo</th>
									<th>Nama Partai</th>
									<th width="50">Aksi</th>
								</thead>
								<tbody>
									@foreach($data as $partial)
									<tr>
										<td>{{ $loop->index + 1 }}</td>
										<td><img src="{{ asset('images/partai/'.$partial->photo) }}" alt="" width="100"></td>
										<td>&nbsp;&nbsp;&nbsp;{{ $partial->partai_name }}</td>
										<td>
											<a class="btn btn-sm btn-danger btn-icon btn-icon-circle" data-toggle="modal" data-target="#forget-modal{{ $loop->index }}"><span class="ti-trash"></span></a>
											<a class="btn btn-sm btn-success btn-icon btn-icon-circle" data-toggle="modal" data-target="#edit-modal{{ $loop->index }}"><span class="ti-pencil"></span></a>
										</td>
									</tr>

									<div class="modal fade" id="forget-modal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="forget-modal">
								    	<div class="modal-dialog modal-sm" role="document">
								        	<div class="modal-content">
								            	<div class="modal-panel">
								                	<div class="modal-header">
								                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
								                        <h4>Konfirmasi</h4>
								                    </div>
								                    <div class="modal-body">
								                    	<p>Data yang di hapus tidak dapat di kembalikan</p>
								                        <a href="{{ route('partai.destroy',$partial->id) }}" class="btn btn-danger btn-block">Hapus</a>
								                    </div>
								                </div>
								            </div>
								        </div>
								    </div>
									
									<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="edit-modal{{ $loop->index }}">
								    	<div class="modal-dialog modal-lg" role="document">
								        	<div class="modal-content">
								            	<div class="modal-panel">
								                	<div class="modal-header">
								                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
								                        <h4>Form</h4>
								                    </div>
								                    <form action="{{ route('partai.update',$partial->id) }}" method="post" enctype="multipart/form-data">
													@csrf @method('patch')
								                    <div class="modal-body">
								                    	<div class="form-group">
								                    		<label>Logo</label>
								                    		<input type="file" name="photo" class="form-control">
								                    	</div>
								                    	<div class="form-group">
															<label>Nama Partai</label>
															<input type="text" class="form-control" name="partai_name" required value="{{ $partial->partai_name }}" placeholder="Nama Partai">
														</div>
								                    </div>
								                    <div class="modal-footer">
								                    	<button class="btn btn-success" type="submit">Submit</button>
								                    </div>
								                    </form>
								                </div>
								            </div>
								        </div>
								    </div>

									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection