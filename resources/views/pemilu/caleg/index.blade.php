@extends('templates.master')

@section('title','Daftar Kandidat')

@section('page_name','Kandidat')

@section('breadcrumb')
	<li>Menu</li>
	<li>Pemilu</li>
	<li>Kandidat</li>
@endsection

@section('content')
	<style>
		.parent{
			width: 100%;
			height: 300px;
			overflow: hidden;
		}

		.minus_text{
			margin-top: -17px;
		}
	</style>
	<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="forget-modal">
    	<div class="modal-dialog modal-sm" role="document">
        	<div class="modal-content">
            	<div class="modal-panel">
                	<div class="modal-header">
                    	<button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="ti-close" aria-hidden="true"></span></button>
                        <h4>Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                    	<p>Menghapus kandidat</p>
                        <a href="" class="btn btn-danger btn-block btnDelete">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="container">
		<div class="row">
			@foreach($new_caleg as $partial)
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="parent">
							<img src="{{ asset('images/caleg/'.$partial['photo']) }}" alt="" class="" style="height: 100%;">
						</div>
						<br>
						<h4>{{ $partial['name'] }}</h4>
						<p class="minus_text">{{ $partial['partai_name'] }}</p>
						@if($partial['terpilih'] == "belum")
						<a class="btn btn-success btn-block btn_candidate" href="{{ $loop->index }}">Pilih Kandidat</a>
						@else
						<a class="btn btn-danger btn-block btn_candidate" href="{{ $loop->index }}">Terpilih</a>
						@endif
						<form action="{{ url('api/candidates_pemilu/store') }}" method="post" id="form{{ $loop->index }}">
							<input type="hidden" name="caleg_id" value="{{ $partial['id'] }}">
							<input type="hidden" name="pemilu_setting_id" value="{{ $pemilu_setting_id }}">
						</form>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<script>
		$('.btn_candidate').click(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			var parent = this;
			if ($(this).hasClass('btn-success')) {
				$(this).addClass('btn-danger').removeClass('btn-success').html("Terpilih");
				formSubmit(href);
			}else{
				$('#delete-modal').modal('show');
				$('.btnDelete').click(function(e){
					e.preventDefault();
					$(parent).addClass('btn-success').removeClass('btn-danger').html("Pilih Kandidat");
					formSubmit(href);
					$('#delete-modal').modal('hide');
				});
			}
		});

		function formSubmit(href)
		{
			$.post($('#form'+href).attr('action'),$('#form'+href).serialize(),function(data){
			})
		}
	</script>
@endsection