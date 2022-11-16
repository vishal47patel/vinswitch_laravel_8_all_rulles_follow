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
                             <h4 class="page-title" id="activecall_count"><i class="fa fa-phone-square" aria-hidden="true"></i> &nbsp; Live Calls</h4>
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


    $(document).ready(function() {
      get_data();
  
      setInterval(function() {
        get_data();
      }, 5000);
    });
  
    function get_data(){
      $.ajax({
        url: "{{ route('cdr.getActiveCall') }}",
        dataType: "json",
        type : "GET",
        success: function(data){
           $("#ajax_reponse").html(data.table);
           $("#activecall_count").html(data.activecallc);
        },
        complete: function(j, s, e){
        }   
      });
    }
  
    function hangup(uuid) {
      if (confirm("Do you really want to hangup this call?")) {
        $.ajax({
            url: "{{ route('cdr.call.hangup') }}",
          data: {uuid: uuid},
          success: function(data) {
            // alert(data)
          }
        });
      }
    }
  
  </script>
  @endsection