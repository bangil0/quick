@extends('templates.master')

@section('title','Data Provinsi')

@section('page_name','Provinsi')

@section('breadcrumb')
	<li>Wilayah</li>
	<li><a href="">Provinsi</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Provinsi</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ route('province.store') }}" method="post">
								@csrf		
			                    <div class="modal-body">
			                    	<div class="panel-body">
										<div class="form-group">
											<label>Nama Provinsi</label>
											<input type="text" class="form-control" name="province_name" required value="{{ old('province_name') }}" placeholder="Nama Provinsi">
										</div>
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

				<div class="panel">
					<div class="panel-heading">
						<h4 class="text-success">Provinsi</h4>
					</div>
					<div class="panel-body">
						<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
							<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Provinsi</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $partial)
								<tr>
                            		<td>{{ $loop->index + 1 }}</td>
                            		<td>{{ $partial->province_name }}</td>
                            		<td width="50">
                            			<a class="btn btn-sm btn-danger btn-icon btn-icon-circle" data-toggle="modal" data-target="#forget-modal{{ $loop->index }}"><span class="ti-trash"></span></a>
                            			<a class="btn btn-sm btn-success btn-icon btn-icon-circle" data-toggle="modal" data-target="#edit-modal{{ $loop->index }}"><span class="ti-pencil"></span></a>
                            		</td>
                            	</tr>

								{{-- Delete Modal --}}
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
							                        <a href="{{ route('province.destroy',$partial->id) }}" class="btn btn-danger btn-block">Hapus</a>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>

								{{-- Edit Modal --}}
							    <div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="edit-modal{{ $loop->index }}">
							    	<div class="modal-dialog modal-lg" role="document">
							        	<div class="modal-content">
							            	<div class="modal-panel">
							                	<div class="modal-header">
							                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
							                        <h4>Edit Form</h4>
							                    </div>
							                    <form action="{{ route('province.update',$partial->id) }}" method="post">
												@csrf @method('patch')
							                    <div class="modal-body">
							                    	<div class="panel-body">
														<div class="form-group">
															<label>Nama Provinsi</label>
															<input type="text" class="form-control" name="province_name" required value="{{ $partial->province_name }}" placeholder="Nama Provinsi">
														</div>
													</div>
							                    </div>
							                    <div class="modal-footer">
							                    	<button class="btn btn-success" type="submit">Simpan Perubahan</button>
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
@endsection