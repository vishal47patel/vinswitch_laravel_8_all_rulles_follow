@extends('layouts.main')
@section('content')
<div class="container-fluid"><br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="with-border">
                        <div class="col-md-6">
                            <h4 class="page-title">Freeswitch CLI</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <h5 class="page-title">Switch Host:</h5>
                            <div class="input-group">
                                <select class="form-control" name="host_id" id="host_id">

                                    @foreach ($freeswitchServers as $freeswitchServer)
                                    <option value="{{$freeswitchServer['id']}}">{{$freeswitchServer['freeswitch_host']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <h5 class="page-title">Command</h5>

                            <div class="input-group">
                                <input type="text" class="form-control" name="freeswitch_command" id="freeswitch_command" placeholder="Command" autocomplete=off>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="input-group">
                                <button class="btn btn-primary " onclick="get_data()" style="margin-top: 35px;" type="submit">Submit</button>
                            </div>
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
                            <h4 class="page-title">Command :<font color="blue" id='cmd'></font>
                            </h4>
                        </div>
                    </div>
                    <!-- header end-->
                    <div class="panel panel-default">

                        <pre style='background-color:black; color : white'>
                        <predemo  id = "response">
                           
                        </predemo>
                        </pre>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function get_data() {
        var host_id = $("#host_id").val();
        var freeswitch_command = $("#freeswitch_command").val();
        console.log(freeswitch_command);
        console.log(host_id);
        $.ajax({
            url: "{{ route('switchcli.list') }}",
            dataType: "json",
            data: {
                host_id: host_id,
                freeswitch_command: freeswitch_command,
            },
            type: "GET",
            success: function(data) {
                  console.log(data);
                $("#cmd").html(data.cmd);
                $("#response").html(data.response.result);
            },
            complete: function(j, s, e) {}
        });
    }
</script>
@endsection