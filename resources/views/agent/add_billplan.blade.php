<div class="row">                         
    <div class="col-lg-12 mb-2">
        <label for="for-expire_seconds" class="form-label">Bill Plan Type<span class="text-red"> *</span></label>
        <div class="input-group">
        <span class="input-group-text"><i class="fa fa-bars"></i></span>
        <select class="form-control" name="billplan_id"  title="Type" id="AgentBillplan_billplan_id">
            <option disabled selected>Select Bill Plan Type</option>
            @foreach ($billplans as $billplan)
            <option value="{{$billplan->id}}" {{ old('billplan_id') == $billplan->id ? 'selected' : '' }}>{{$billplan->name}}</option>
            @endforeach
        </select>
        </div>
    @error('type')<p class="validation_error">{{ $message }}</p> @enderror
    </div>
    <div class="col-lg-12 mb-2">
        <label for="example-password" class="form-label">Commission(%)<span class="text-red"> *</span></label>
        <div class="input-group">
            <span class="input-group-text"><b>%</b></span>
            <input type="text" class="form-control" name="commission" id="AgentBillplan_commission" placeholder="Enter Commission(%)" value="{{ old('commission',0) }}" autocomplete = off>
        </div>
        @error('commission')<p class="validation_error">{{ $message }} </p>@enderror
    </div>
</div>

                  



