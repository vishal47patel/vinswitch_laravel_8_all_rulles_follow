<form action="?" method="get" id="globalSearchForm">
    <input type="text" id="global-search" style="float: right; width: 40%;" class="form-control mb-2" value="{{request('search')}}" placeholder="Type and press enter" name="search" @if(request('search') != '') autofocus @endif autocomplete = off>
    @foreach (request()->except(['search', 'page','vendor_id', 'vendor_name']) as $key => $value )
        <input type="hidden" name="{{$key}}" value="{{ $value }}">
    @endforeach
</form>
<script>
$('#global-search').on("keypress", function(e) {
    if (e.keyCode == 13) {
        $('#globalSearchForm').submit();
    }
});
</script>