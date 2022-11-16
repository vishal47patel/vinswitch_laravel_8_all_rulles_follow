@extends('layouts.main')
@section('content')
<div class="container-fluid"><br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="with-border">
                        <div class="col-md-6">
                             <h4 class="page-title">Registered Gateways</h4>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <h5 class="page-title">Switch Host:</h5>
                        <div class="input-group">
                            <select class="form-control" name="host_id" id="host_id" onchange="get_data(this.value)">
                                <option selected>Select Host</option>
                                @foreach ($freeswitchServers as $freeswitchServer)
                                <option value="{{$freeswitchServer['id']}}">{{$freeswitchServer['freeswitch_host']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>                    
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                             <h4 class="page-title">Registered Gateways</h4>
                        </div>
                    </div>
                    <!-- header end-->           
                    <table data-toggle="table" data-show-columns="false" data-buttons-class="xs btn-light" class="tablesaw table mb-0" id="ajax_reponse" data-tablesaw-mode="stack">
                        
                    </table>
                </div>
            </div> 
        </div> 
    </div>
</div>           


<script type="text/javascript">

function get_data(value)
{
    var host_id =  value;
    $.ajax({
        url: "{{ route('registeredgatewey.list') }}",
        dataType: "json",
        data: {host_id: host_id},
        type : "GET",
        success: function(data){
            document.getElementById("ajax_reponse").innerHTML= data.table;
            document.getElementById("ajax_reponse").style.display = "";
        },
        error: function() {
            document.getElementById("ajax_reponse").style.display = "none";
        },
        complete: function(j, s, e){}   
    });
}
</script>
@endsection