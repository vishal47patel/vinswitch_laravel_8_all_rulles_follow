<form action="?" method="get" id="globalSearchForm2">
    <input type="text" id="global-search2" style="float: right; width: 40%;" class="form-control mb-2" value="{{request('search2')}}" placeholder="Type and press enter" name="search2" @if(request('search2') != '') autofocus @endif autocomplete = off>
    @foreach (request()->except(['page', 'search2']) as $key => $value )
        <input type="hidden" name="{{$key}}" value="{{ $value }}">
    @endforeach
    
</form>
<script>
$('#global-search2').on("keypress", function(e) {
    if (e.keyCode == 13) {
        $('#globalSearchForm2').submit();
    }
});
</script>