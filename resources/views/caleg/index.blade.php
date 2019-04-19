@extends('templates.master')

@section('title','Data Caleg')

@section('page_name','List Caleg')

@section('breadcrumb')
	<li>Menu</li>
	<li>Caleg</li>
	<li><a href="">List</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Caleg</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ route('caleg.store') }}" method="post" enctype="multipart/form-data">
								@csrf		
			                    <div class="modal-body">
			                    	<div class="panel-body">
										<div class="form-group">
											<label>Nama Caleg</label>
											<input type="text" class="form-control" name="name" required value="{{ old('name') }}" placeholder="Nama Caleg">
										</div>
										<div class="form-group">
											<label>Nomor Urut</label>
											<input type="number" class="form-control" name="serial_number" required value="{{ old('serial_number') }}" placeholder="Nomor Urut" max="4">
										</div>
										<div class="form-group">
											<label>Foto Caleg</label>
											<input type="file" class="form-control" name="photo" required value="{{ old('serial_number') }}" placeholder="Photo" max="4">
										</div>
										<div class="form-group">
											<label>Partai</label>
											<select name="partai_id" id="" class="form-control">
												@foreach($partai as $partai_part)
												<option value="{{ $partai_part->id }}">{{ $partai_part->partai_name }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Tipe Caleg</label>
											<select name="type_candidate_id" id="" class="form-control">
												@foreach($type as $tipe)
												<option value="{{ $tipe->id }}">{{ $tipe->type }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Jenis Kelamin</label>
											<select name="jk" id="" class="form-control">
												<option value="">Pilih Jenis Kelamin</option>
												<option value="L">Laki - Laki</option>
												<option value="P">Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label>Daerah Pemilihan</label>
											<select name="province_id" id="" class="form-control">
												@foreach($province as $provinsi)
												<option value="{{ $provinsi->id }}">{{ $provinsi->province_name }}</option>
												@endforeach
											</select>
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

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="text-success">Caleg</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
								<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
								<thead>
	                                <tr>
	                                    <th>No</th>
	                                    <th>Foto</th>
	                                    <th>Nama</th>
	                                    <th>Jenis Kelamin</th>
	                                    <th>Partai</th>
	                                    <th>Nomor Urut</th>
	                                    <th>Tipe Caleg</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@foreach($data as $partial)
									<tr>
										<td>{{ $loop->index + 1 }}</td>
										<td><img src="{{ asset('images/caleg/'.$partial['photo']) }}" alt="" width="50"></td>
										<td>{{ $partial['name'] }}</td>
										<td>{{ $partial['jk'] }}</td>
										<td>{{ $partial['partai_name'] }}</td>
										<td>{{ $partial['serial_number'] }}</td>
										<td>{{ $partial['type'] }}</td>
										<td>
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
								                        <a href="{{ route('caleg.destroy',$partial['id']) }}" class="btn btn-danger btn-block">Hapus</a>
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
							                        <h4>Edit Form</h4>
							                    </div>
							                    <form action="{{ route('caleg.update',$partial['id']) }}" method="post" enctype="multipart/form-data">
												@csrf @method('patch')
							                    <div class="modal-body">
							                    	<div class="panel-body">
														<div class="form-group">
															<label>Nama Caleg</label>
															<input type="text" class="form-control" name="name" required value="{{ $partial['name'] }}" placeholder="Nama Caleg">
														</div>
														<div class="form-group">
															<label>Nomor Urut</label>
															<input type="number" class="form-control" name="serial_number" required value="{{ $partial['serial_number'] }}" placeholder="Nomor Urut" max="4">
														</div>
														<div class="form-group">
															<label>Foto Caleg</label>
															<input type="file" class="form-control" name="photo" placeholder="Photo">
														</div>
														<div class="form-group">
															<label>Partai</label>
															<select name="partai_id" id="" class="form-control">
																@foreach($partai as $partai_part)
																@if($partai_part->id == $partial['partai_id'])
																<option value="{{ $partai_part->id }}" selected>{{ $partai_part->partai_name }}</option>
																@else
																<option value="{{ $partai_part->id }}">{{ $partai_part->partai_name }}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="form-group">
															<label>Tipe Caleg</label>
															<select name="type_candidate_id" id="" class="form-control">
																@foreach($type as $tipe)
																@if($tipe->id == $partial['type_candidate_id'])
																<option value="{{ $tipe->id }}" selected>{{ $tipe->type }}</option>
																@else
																<option value="{{ $tipe->id }}">{{ $tipe->type }}</option>
																@endif
																@endforeach
															</select>
														</div>
														<div class="form-group">
															<label>Jenis Kelamin</label>
															<select name="jk" id="" class="form-control">
																<option value="">Pilih Jenis Kelamin</option>
																@if($partial['jk'] == "L")
																<option value="L" selected>Laki - Laki</option>
																<option value="P">Perempuan</option>
																@else
																<option value="L">Laki - Laki</option>
																<option value="P" selected>Perempuan</option>
																@endif
															</select>
														</div>
														<div class="form-group">
															<label>Daerah Pemilihan</label>
															<select name="province_id" id="" class="form-control">
																@foreach($province as $provinsi)
																@if($provinsi->id == $partial['province_id'])
																<option value="{{ $provinsi->id }}" selected>{{ $provinsi->province_name }}</option>
																@else
																<option value="{{ $provinsi->id }}">{{ $provinsi->province_name }}</option>
																@endif
																@endforeach
															</select>
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
	</div>
@endsection