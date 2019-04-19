@extends('templates.master')

@section('title','Data Pemilu')

@section('page_name','Pemilu')

@section('breadcrumb')
	<li>Wilayah</li>
	<li><a href="">Pemilu</a></li>
	<li><a href="">Setting</a></li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal">Tambah Setting</a>
				<br><br>
				<div class="modal bs-example-modal-lg fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-lg" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ route('pemilu_setting.store') }}" method="post">
								@csrf		
			                    <div class="modal-body">
			                    	<div class="panel-body">
										<div class="form-group">
											<label>Nama Pemilu</label>
											<input type="text" class="form-control" name="pemilu_name" required value="{{ old('province_name') }}" placeholder="Nama Pemilu">
										</div>
										<div class="form-group">
											<label>Tipe Pemilihan</label>
											<select name="type_candidates_id" id="type_candidates" class="form-control">
												@foreach($data as $type)
												<option value="{{ $type->id }}">{{ $type->type }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group" id="form_province" style="display: none;">
											<label>Provinsi</label>
											<select name="province_id" id="province_select" class="form-control province_select">
												<option value="">Pilih Provinsi</option>
												@foreach($province as $provinsi)
												<option value="{{ $provinsi->id }}">{{ $provinsi->province_name }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group" id="form_kokab" style="display: none;">
											<label>Kabupaten Kota</label>
											<select name="kokab_id" id="kokab_select" class="form-control kokab_select">
												
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

				<div class="panel">
					<div class="panel-heading">
						<h4 class="text-success">Setting</h4>
					</div>
					<div class="panel-body">
						<table id="myTable" class="table text-nowrap table-striped" cellspacing="0" width="100%">
							<thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemilu</th>
                                    <th>Tipe Pemilu</th>
                                    <th width="50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach($array as $partial)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $partial['pemilu_name'] }}</td>
									<td>&nbsp;&nbsp;&nbsp;{{ $partial['type'] }}</td>
									<td>
										<a class="btn btn-sm btn-danger btn-icon btn-icon-circle" data-toggle="modal" data-target="#forget-modal{{ $loop->index }}"><span class="ti-trash"></span></a>
										<a class="btn btn-sm btn-success btn-icon btn-icon-circle" data-toggle="modal" data-target="#edit-modal{{ $loop->index }}"><span class="ti-pencil"></span></a>
										<a class="btn btn-sm btn-warning btn-icon btn-icon-circle" href="{{ url('candidates_pemilu/'.$partial['id']) }}"><span class="ti-plus"></span></a>
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
							                        <a href="{{ route('pemilu_setting.destroy',$partial['id']) }}" class="btn btn-danger btn-block">Hapus</a>
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
							                    <form action="{{ route('pemilu_setting.update',$partial['id']) }}" method="post">
												@csrf @method('patch')
							                    <div class="modal-body">
							                    	<div class="panel-body">
														<div class="form-group">
															<label>Nama Pemilu</label>
															<input type="text" class="form-control" name="pemilu_name" required value="{{ $partial['pemilu_name'] }}" placeholder="Nama Pemilu">
														</div>
														<div class="form-group">
															<label>Tipe Pemilihan</label>
															<select name="type_candidates_id" id="" class="form-control">
																@foreach($data as $type)
																@if($type->id == $partial['type_candidates_id'])
																<option value="{{ $type->id }}" selected>{{ $type->type }}</option>
																@else
																<option value="{{ $type->id }}" selected>{{ $type->type }}</option>
																@endif
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
								@endforeach
                            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			var type_select;
			$('#type_candidates').change(function(){
				var type = $(this).val();
				type_select = type;
				console.log(type);
				if (type == "2" || type == "3") {
					$('#form_province').show("slow");
					$('.province_select').attr('required','required');
					if (type == "2") {
						$('.kokab_select').attr('required','required');
					}
				}else if(type == "1"){
					$('#form_province').hide("slow");
					$('#form_kokab').hide("slow");
				}else{
					$('.kokab_select').removeAttr('required');
					$('.province_select').removeAttr('required');
					$('#form_province').hide("slow");
					$('#form_province').html('<option value="">Pilih Provisi</option>');
					$('#form_kokab').hide("slow");
					$('#form_kokab').html('<option value="">Pilih Kokab</option>');
				}
			});

			$('#province_select').change(function(){
				if (type_select == "2") {
					var selected = $(this).val();
					console.log(selected);
					if (selected != null) {
						var options = '<option value="">Pilih Kokab</option>';
						$.get("{{ url('kecamatan/kokab') }}"+"/"+selected,function(data){
							$(data).each(function(index, value){
						        options += '<option value="'+value.id+'">'+value.kokab_name+'</option>';
						    });
						    $('#kokab_select').html(options);
						    $('#form_kokab').show("slow");
						});
					}
				}
			});

		});
	</script>
@endsection