


<option value="">Pilih Kabupaten / Kota</option>
@foreach($kokab as $data)
<option value="{{ $data->id }}">{{ $data->kokab_name }}</option>
@endforeach