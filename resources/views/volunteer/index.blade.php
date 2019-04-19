@extends('templates.master')

@section('title','Data TPS')

@section('page_name','TPS')

@section('breadcrumb')
	<li>Wilayah</li>
	<li>Tps</li>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_modal" style="display: none;">Tambah TPS</a>
				<div class="modal bs-example-modal-fullwidth fade" tabindex="-1" role="dialog" id="add_modal">
			    	<div class="modal-dialog modal-fullwidth" role="document">
			        	<div class="modal-content">
			            	<div class="modal-panel">
			                	<div class="modal-header">
			                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
			                        <h4>Form</h4>
			                    </div>
			                    <form action="{{ url('transaction/store') }}" method="post">
								@csrf		
			                    <div class="modal-body">
			                    	<input type="hidden" name="tps_id" id="tps_value">
			                    	<div class="form-group">
			                    		<label>Tipe Pemilu</label>
			                    		<select name="type_pemilu" id="select_type" class="form-control">
			                    			<option value="">Pilih Tipe</option>
			                    			@foreach($type_candidates as $type)
											<option value="{{ $type->id }}">{{ $type->type }}</option>
			                    			@endforeach
			                    		</select>
			                    	</div>
			                    	<div class="form-group">
			                    		<label>Pemilu</label>
			                    		<select name="pemilu_setting_id" id="select_pemilu" class="form-control">
			                    			<option value="">Pilih Pemilu</option>
			                    		</select>
			                    	</div>
			                    	<div id="content_caleg"></div>
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
						<h4 class="text-success">Pemilu</h4>
					</div>
					<form action="" method="post">
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
								<label>Kelurahan</label>
								<select name="kelurahan_id" id="select_kelurahan" class="form-control"></select>
							</div>

							<div class="form-group">
								<label>TPS</label>
								<select name="tps_id" id="select_tps" class="form-control"></select>
							</div>

							<a href="" class="btn btn-success" id="btnVote">Mulai Vote</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		$(document).ready(function(){

			$('#btnVote').click(function(e){
				e.preventDefault();
				console.log($('#select_tps').val());
				if ($('#select_tps').val() != "") {
					$('#add_modal').modal({
				        show: 'true'
				    }); 
				}else{
					toastr.warning('<h5>Peringatan</h5><span>Pilih Tps Sebelum Melanjutkan</span>');
				}
			});

			var options = '<option value="">Pilih Kokab</option>';
			$('#select_kokab').html(options);

			var optionss = '<option value="">Pilih Kecamatan</option>';
			$('#select_kecamatan').html(optionss);

			var optionsss = '<option value="">Pilih Kelurahan</option>';
			$('#select_kelurahan').html(optionsss);

			var optionssss = '<option value="">Pilih Tps</option>';
			$('#select_tps').html(optionssss);

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

			$('#select_kecamatan').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kelurahan</option>';
					$.get("{{ url('tps/kelurahan/') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.kelurahan_name+'</option>';
					    });
					    $('#select_kelurahan').html(options);
					});
				}
			});

			$('#select_kelurahan').change(function(){
				var selected = $(this).val();
				if (selected != null) {
					var options = '<option value="">Pilih Kelurahan</option>';
					$.get("{{ url('tps/di/') }}"+"/"+selected,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.tps_name+'</option>';
					    });
					    $('#select_tps').html(options);
					});
				}
			});

			$('#select_type').change(function(){
				var selected = $(this).val();
				$('#content_caleg').html("");
				if (selected != null) {
					var url = "{{ url('tps/pemilu/') }}"+"/"+selected+"/"+$('#select_province').val()+"/"+$('#select_kokab').val();
					var options = '<option value="">Pilih Pemilu</option>';
					$.get(url,function(data){
						$(data).each(function(index, value){
					        options += '<option value="'+value.id+'">'+value.pemilu_name+'</option>';
					    });
					    $('#select_pemilu').html(options);
					});
				}
			});

			$('#select_pemilu').change(function(){
				$('#content_caleg').load("{{ url("relawan/pemilu/caleg/") }}"+"/"+$('#select_pemilu').val());
			});

			$('#select_tps').change(function(){
				$('#tps_value').val($(this).val());
			});


		});
	</script>

@endsection