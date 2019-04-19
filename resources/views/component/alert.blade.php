@if(session('message'))
<script>
    toastr.success('<h5>Success</h5><span>{{ session('message') }}</span>');
    toastr.options = {
        "timeOut": "6000",
        "positionClass": "toast-bottom-right",
        "closeButton": true,    
    }
    toastr.options.closeHtml = '<button><i class="ti-close"></i></button>';
</script>
@endif

@if($errors->any())
	@foreach($errors->all() as $error)
	<script>
	toastr.info('<h5>Warning</h5><span>{{ $error }}</span>');
	</script>
	@endforeach
@endif