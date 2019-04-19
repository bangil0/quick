@extends('templates.master')

@section('title','Data Kelurahan')

@section('page_name','Kelurahan')

@section('breadcrumb')
	<li>Wilayah</li>
	<li>Kelurahan</li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Kelurahan</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ route('kelurahan.store') }}" method="post">
								@csrf		
			                    <div class="modal-body">
			                    	<div class="panel-body">
			                    		<div class="form-group">
			                    			<label>Provinsi</label>
			                    			<select name="province_id" id="select_province" class="form-control">
			                    				<option value="">Pilih Provinsi</option>
			                    				@foreach($province as $partial_province)
												<option value="{{ $partial_province->id }}">{{ $partial_province->province_name }}</option>
			                    				@endforeach
			                    			</select>
			                    		</div>
			                    		<div class="form-group">
											<label>Kabupaten / Kota</label>
											<select name="kokab_id" id="select_kokab" class="form-control">
																							
											</select>
										</div>

										<div class="form-group">
											<label>Kecamatan</label>
											<select name="kecamatan_id" id="select_kecamatan" class="form-control">
																					
											</select>
										</div>

										<div class="form-group">
											<label>Nama Kelurahan</label>
											<input type="text" class="form-control" name="kelurahan_name" placeholder="Nama Kelurahan" value="{{ old('kelurahan_name') }}">
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
						<h4 class="text-success">Kelurahan</h4>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
							<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Nama Kabupaten</th>
                                    <th>Nama Kabupaten Atau Kota</th>
                                    <th>Nama Provinsi</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($data as $partial)
								<tr>
                            		<td>{{ $loop->index + 1 }}</td>
                            		<td>{{ $partial['kelurahan_name'] }}</td>
                            		<td>{{ $partial['kecamatan_name'] }}</td>
                            		<td>{{ $partial['kokab_name'] }}</td>
                            		<td>{{ $partial['province_name'] }}</td>
                            		<td width="50">
                            			<a class="btn btn-sm btn-danger btn-icon btn-icon-circle" data-toggle="modal" data-target="#forget-modal{{ $loop->index }}"><span class="ti-trash"></span></a>
                            			<a class="btn btn-sm btn-success btn-icon btn-icon-circle edited" data-toggle="modal" data-target="#edit-modal{{ $loop->index }}"><span class="ti-pencil"></span></a>
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
							                        <a href="{{ route('kelurahan.destroy',$partial['id']) }}" class="btn btn-danger btn-block">Hapus</a>
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
							                    <form action="{{ route('kelurahan.update',$partial['id']) }}" method="post">
												@csrf	@method('patch')
							                    <div class="modal-body">
							                    	<div class="panel-body">
							                    		<input type="hidden" value="{{ $partial['kokab_id'] }}" class="kokab_id">
							                    		<input type="hidden" value="{{ $partial['kecamatan_id'] }}" class="kecamatan_id">
							                    		<div class="form-group">
							                    			<label>Provinsi</label>
							                    			<select name="province_id" id="select_province" class="form-control select_province">
							                    				<option value="">Pilih Provinsi</option>
							                    				@foreach($province as $partial_province)
							                    				@if($partial['province_id'] == $partial_province->id)
																<option value="{{ $partial_province->id }}" selected>{{ $partial_province->province_name }}</option>
																@else
																<option value="{{ $partial_province->id }}">{{ $partial_province->province_name }}</option>
																@endif
							                    				@endforeach
							                    			</select>
							                    		</div>
							                    		<div class="form-group">
															<label>Kabupaten / Kota</label>
															<select name="kokab_id" id="select_kokab" class="form-control select_kokab">
																											
															</select>
														</div>

														
														<div id="content_kokab"></div>

														<div class="form-group">
															<label>Nama Kecamatan</label>
															<select name="kecamatan_id" class="form-control select_kecamatan"></select>
														</div>

														<div class="form-group">
															<label for="">Nama Kelurahan</label>
															<input type="text" class="form-control" value="{{ $partial['kelurahan_name'] }}" name="kelurahan_name">
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
	
	<script>
		$(document).ready(function(){
			var options = '<option value="">Pilih Kokab</option>';
			$('#select_kokab').html(options);

			var optionss = '<option value="">Pilih Kecamatan</option>';
			$('#select_kecamatan').html(optionss);

			$('#select_province').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kokab</option>';
					$.get("{{ url('kecamatan/kokab') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.kokab_name+'</option>';
					    });
					    $('#select_kokab').html(options);
					});
				}
			});

			$('#select_kokab').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kecamatan</option>';
					$.get("{{ url('kelurahan/kecamatan') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.kecamatan_name+'</option>';
					    });
					    $('#select_kecamatan').html(options);
					});
				}
			});

			$('.edited').click(function(){
				var options = '<option value="">Pilih Kokab</option>';
				var kokab_id = null;
				$.get("{{ url('kecamatan/kokab') }}"+"/"+$('.select_province').val(),function(data){
					$(data).each(function(index, value){
				        if (value.id == $('.kokab_id').val()) {
				        	kokab_id = value.id;
				        	options += '<option value="'+value.id+'" selected>'+value.kokab_name+'</option>';
				        }else{
				        	options += '<option value="'+value.id+'">'+value.kokab_name+'</option>';
				        }
				    });
				    $('.select_kokab').html(options);
				});

				var optionss = '<option value="">Pilih Kecamatan</option>';
				$.get("{{ url('kelurahan/kecamatan') }}"+"/"+$('.kokab_id').val(),function(data){
					$(data).each(function(index, value){
						if (value.id == $('.kecamatan_id').val()) {
							optionss += '<option value="'+value.id+'" selected>'+value.kecamatan_name+'</option>';
						}else{
							optionss += '<option value="'+value.id+'">'+value.kecamatan_name+'</option>';
						}
				    });
				    $('.select_kecamatan').html(optionss);
				});


			});

			$('.select_province').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kokab</option>';
					$.get("{{ url('kecamatan/kokab') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.kokab_name+'</option>';
					    });
					    $('.select_kokab').html(options);
					});
				}
			});

			$('.select_kokab').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kecamatan</option>';
					$.get("{{ url('kelurahan/kecamatan') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.kecamatan_name+'</option>';
					    });
					    $('.select_kecamatan').html(options);
					});
				}
			});


		});
	</script>

@endsection