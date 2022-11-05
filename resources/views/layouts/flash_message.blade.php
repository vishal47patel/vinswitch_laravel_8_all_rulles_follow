@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    padding: 0.9375rem 1.25rem;
"></button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('danger'))
<div class="alert alert-danger alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif
<script type="text/javascript">
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 ); // 5 secs

});
</script>
