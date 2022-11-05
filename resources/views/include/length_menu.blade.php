<form action="?" method="get" id="rowForm">
    <select class="form-control" style="width: auto !important; display: initial;" name="row" onchange="javascript:$('#rowForm').submit()"
        style="margin: 5px;">
        <option value="10" @if(request('row') == 10) selected @endif>10</option>
        <option value="15" @if(request('row') == 15) selected @endif>15</option>
        <option value="25" @if(request('row') == 25) selected @endif>25</option>
        <option value="50" @if(request('row') == 50) selected @endif>50</option>
        <option value="100" @if(request('row') == 100) selected @endif>100</option>
        <option value="200" @if(request('row') == 200) selected @endif>200</option>
    </select>
    @foreach (request()->except(['row', 'page']) as $key => $value )
        <input type="hidden" name="{{$key}}" value="{{ $value }}">
    @endforeach
</form>