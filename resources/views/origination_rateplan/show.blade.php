@extends('layouts.main')

@section('content')
<div class="container-fluid"><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- header start-->
                    <div class="row with-border mb-2">
                        <div class="col-md-6">
                            <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> View Origination Rate Plan</h4>
                        </div>
                        <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('origination_rateplan.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                    
                    <form action="{{ route('origination_rateplan.show',$OriginationRatePlan->id) }}" method="POST" id="check_validation">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"  value="{{ $OriginationRatePlan->name }}" autocomplete=off disabled="true">
                                </div>
                                @error('name')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="{{ $OriginationRatePlan->description }}" autocomplete=off >
                                </div>
                            </div>
                        </div>
                        <!-- header start-->
                        <div class="row with-border mb-2">
                            <div class="col-md-6">
                                <h4 class="page-title"><i class="fa fa-paste" aria-hidden="true"></i> Service Type</h4>
                            </div>
                        </div>
                        <!-- header end-->
                     
                       
                        @foreach($servicetype as $sub)
                        <div class="row with-border mb-2">
                            <div class="col-md-6">
                                    <h5 class="text-capitalize">{{ $sub->service->service_type}}</h5>    
                            </div>
                        </div>
                        <div class="row with-border mb-2" id="dynamicAddRemove">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Service Type<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <select class="form-control input-sm"  name="moreFields[0][service_type]" onchange="checkSelects()" required="required" disabled="true">
                                        <option value="" selected>Select Service Type</option>
                                        @foreach ($service as $key)
                                        <option value='{{ $key->id }}' {{$sub->service_type == $key->id  ? 'selected' : ''}}>{{ $key->service_type }}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                                @error('service_type')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2"></div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Did price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][did_price]" placeholder="Enter Did price"  value="{{ $sub->did_price  }}" class="form-control" disabled="true"/>
                                </div>
                                @error('did_price')<p class="validation_error">{{ $message }} </p>@enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Setup Fee<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text"  name="moreFields[0][setup_fee]" value="{{ $sub->setup_fee  }}" placeholder="Enter Setup Fee" class="form-control" disabled="true"/>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">E911 Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][e911_price]" value="{{ $sub->e911_price  }}" placeholder="Enter E911 Price" class="form-control" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Inbound SMS Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][inbound_sms_price]" value="{{ $sub->inbound_sms_price  }}" placeholder="Enter Inbound SMS Price" class="form-control" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">CNAM Price<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][cnam_price]"  value="{{ $sub->cnam_price  }}" placeholder="Enter CNAM Price" class="form-control" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Inbound Min Rate<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][inbound_min_rate]" value="{{ $sub->inbound_min_rate  }}" placeholder="Enter Inbound Min Rate" class="form-control" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Inbound Channel Limit<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span>
                                    <input type="text" name="moreFields[0][inbound_channel_limit]" value="{{ $sub->inbound_channel_limit  }}" placeholder="Enter Inbound Channel Limit" class="form-control" disabled="true"/>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
               
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    select.error {
    border-color: red !important;
    background-color: #FFCCCC !important;
}
    </style>
<script type="text/javascript">
    var i = 0;
   function addDiv() {
        ++i;
        $("#dynamicAddRemove").append('<div class="row with-border mb-2 remove-tr"><div class="col-lg-6 mb-2"><a href="#" class="btn btn-primary add-btn" onclick="addDiv()" name="add"><i class="fa fa-plus-circle"></i></a>&nbsp;&nbsp;<button type="button" class="btn btn-danger remove-tr"><i class="fa fa-minus-circle"></i></button></div><div class="col-lg-6 mb-2"></div><div class="col-lg-6 mb-2"><label class="form-label">Service Type<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><select class="form-control input-sm" name="moreFields[' + i + '][service_type]" onchange="checkSelects()" required="required"><option value="">Select Service Type</option>@foreach($service as $as)<option value="{{$as->id}}" @if( old($as->id) == $as->id ) {{"selected"}} @endif>{{$as->service_type}}</option>@endforeach</select></div></div><div class="col-lg-6 mb-2"></div><div class="col-lg-6 mb-2"><label class="form-label">Did price<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][did_price]" placeholder="Enter Did price" value="0.0000" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">Setup Fee<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][setup_fee]" placeholder="Enter Setup Fee" value="0.0000" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">E911 Price<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][e911_price]" value="0.0000" placeholder="Enter E911 Price" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">Inbound SMS Price<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][inbound_sms_price]" placeholder="Enter EInbound SMS Price" value="0.0000" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">CNAM Price<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][cnam_price]" placeholder="Enter CNAM Price" value="0.0000" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">Inbound Min Rate<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="fab fa-odnoklassniki" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][inbound_min_rate]" placeholder="Enter Inbound Min Rate" value="0.0000" class="form-control number" required/></div></div><div class="col-lg-6 mb-2"><label class="form-label">Inbound Channel Limit<span class="text-red"> *</span></label><div class="input-group"><span class="input-group-text"><i class="far fa-keyboard" aria-hidden="true"></i></span><input type="text" name="moreFields[' + i + '][inbound_channel_limit]" placeholder="Enter Inbound Channel Limit" value="0" class="form-control number" required/></div></div></div>');
    }

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('.remove-tr').remove();
    });
    $(document).ready(function(){
        $("#validation").validate();
    });

    function checkSelects() {

var $elements = $('select');

$elements
    .removeClass('error')
    .each(function() {
        var selectedValue = this.value;

        $elements
            .not(this)
            .filter(function() {
                //console.log([this.value, selectedValue]);
                //return this.value == selectedValue;
                if (this.value == selectedValue) {
                    $elements.addClass('error');
                    // alert('This Service type is Duplicate.')
                    //return true;
                }

            })
    });
}
    $('.number').keypress(function(event) {
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
			((event.which < 48 || event.which > 57) &&
				(event.which != 0 && event.which != 8))) {
			event.preventDefault();
		}

		var text = $(this).val();

		if ((text.indexOf('.') != -1) &&
			(text.substring(text.indexOf('.')).length > 5) &&
			(event.which != 0 && event.which != 8) &&
			($(this)[0].selectionStart >= text.length - 5)) {
			event.preventDefault();
		}
	});
</script>

@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>