@extends('templates.master')

@section('title','Data Kabupaten dan Kota')

@section('page_name','Kabupaten dan Kota')

@section('breadcrumb')
	<li>Wilayah</li>
	<li><a href="">Kabupaten Kota</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Kokab</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
		    	<div class="modal-dialog modal-lg" role="document">
		        	<div class="modal-content">
		            	<div class="modal-panel">
		                	<div class="modal-header">
		                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
		                        <h4>Form</h4>
		                    </div>
		                    <form action="{{ route('kokab.store') }}" method="post">
							@csrf		
		                    <div class="modal-body">
		                    	<div class="panel-body">
		                    		<div class="form-group">
		                    			<label>Provinsi</label>
		                    			<select name="province_id" id="" class="form-control">
		                    				<option value="">Pilih Provinsi</option>
		                    				@foreach($province as $partial_province)
											<option value="{{ $partial_province->id }}">{{ $partial_province->province_name }}</option>
		                    				@endforeach
		                    			</select>
		                    		</div>
									<div class="form-group">
										<label>Nama Kabupaten Atau Kota</label>
										<input type="text" class="form-control" name="kokab_name" required value="{{ old('kokab_name') }}" placeholder="Nama Kabupaten atau Kota">
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
						<h4 class="text-success">Kabupaten dan Kota</h4>
					</div>
					<div class="panel-body">
						<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
							<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kabupaten Atau Kota</th>
                                    <th>Nama Provinsi</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $partial)
								<tr>
                            		<td>{{ $loop->index + 1 }}</td>
                            		<td>{{ $partial['kokab_name'] }}</td>
                            		<td>{{ $partial['province_name'] }}</td>
                            		<td width="50">
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
							                        <h4>Delete Confirm</h4>
							                    </div>
							                    <div class="modal-body">
							                    	<p>Data yang di hapus tidak dapat di kembalikan</p>
							                        <a href="{{ route('kokab.destroy',$partial['id']) }}" class="btn btn-danger btn-block">Hapus</a>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>

							    <div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="edit-modal{{ $loop->index}}">
							    	<div class="modal-dialog modal-lg" role="document">
							        	<div class="modal-content">
							            	<div class="modal-panel">
							                	<div class="modal-header">
							                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
							                        <h4>Edit Form</h4>
							                    </div>
							                    <form action="{{ route('kokab.update',$partial['id']) }}" method="post">
												@csrf @method('patch')
							                    <div class="modal-body">
							                    	<div class="panel-body">
							                    		<div class="form-group">
							                    			<label>Provinsi</label>
							                    			<select name="province_id" id="" class="form-control">
							                    				<option value="">Pilih Provinsi</option>
							                    				@foreach($province as $partial_province)
							                    				@if($partial_province->id == $partial['province_id'])
																<option value="{{ $partial_province->id }}" selected>{{ $partial_province->province_name }}</option>
																@else
																<option value="{{ $partial_province->id }}">{{ $partial_province->province_name }}</option>
																@endif
							                    				@endforeach
							                    			</select>
							                    		</div>
														<div class="form-group">
															<label>Nama Kabupaten Atau Kota</label>
															<input type="text" class="form-control" name="kokab_name" required value="{{ $partial['kokab_name'] }}" placeholder="Nama Kabupaten atau Kota">
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