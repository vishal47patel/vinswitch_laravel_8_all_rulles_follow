<div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
        Showing {{($data->currentPage()-1)* $data->perPage()+($data->total() ? 1:0)}} to {{($data->currentPage()-1)*$data->perPage()+count($data)}}  of  {{$data->total()}}  Results
    </div>
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 custom-position">
        {!! $data->appends(\Request::except('page'))->render() !!}
    </div>
</div>

<style>
.custom-position nav {
    float: right;   
}
.page-item:not(:first-child) .page-link {
    margin: 0 3px;
    border: none;
}
</style>
