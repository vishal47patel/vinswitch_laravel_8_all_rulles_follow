@extends('layouts.main')

@section('content')
<div class="container-fluid"><br>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title" id="activecall_count"><i class="fa fa-user" aria-hidden="true"></i> Registrations</h4>
                        </div>
                    </div>
                    <!-- header end-->
                    <div class="box-body table-responsive">
                        <div class="col-md-12">
                            <div class="table-responsive" style="overflow:auto;" id="ajax_reponse">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
    //Main.init();
    //Index.init();
    get_data();

    setInterval(function() {
      get_data();
    }, 6000);
  });

  function get_data(){
     //alert(data);
    $.ajax({
      url: "{{ route('registrations.registration') }}",
      dataType: "json",
      type : "GET",
      success: function(data){
         //console.log(data);
        document.getElementById("ajax_reponse").innerHTML= data.table;
        document.getElementById("activecall_count").innerHTML= data.activecallc;    
      },
      complete: function(j, s, e){
      }   
    });
  }

  function unregister(unregister,user,agent,sip_profile_name) {
   // alert(sip_profile_name);
      $.ajax({
        url: "{{ route('registrations.unregister') }}",
        data: {unregister: unregister , user: user ,agent: agent ,sip_profile_name: sip_profile_name},
        type : "GET",
        success: function(data) {
          location.reload();
        }
      });
   
  }

</script>
@endsection