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
                             <h4 class="page-title"><i class="fas fa-paste" aria-hidden="true"></i> Edit Gateway Detail</h4>
                        </div>
                         <div class="col-md-6 pull-right mb-1">
                            <a class="btn btn-primary" href="{{ route('gateways.index') }}"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- header end-->
                        
                    <form action="{{ route('gateways.update',$gateway->id) }}" method="POST" id="check_validation">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message ">
                                <label for="for-gatway" class="form-label">Gateway Name<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-dot-circle"></i></span>
                                    <input type="text" class="form-control" name="gateway_name" id="gateway_name" placeholder="Enter Gateway Name" value="{{ $gateway->gateway_name }}" autocomplete=off>
                                </div>

                                @error('gateway_name')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-prefix" class="form-label">Prefix</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control" name="prefix" id="prefix" placeholder="Enter Prefix" value="{{ $gateway->prefix }}" autocomplete=off>
                                </div>

                                @error('prefix')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="{{ $gateway->username }}" autocomplete=off />
                                </div>

                                @error('username')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="{{ $gateway->password }}" autocomplete=off>
                                </div>

                                @error('password')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-auth_username" class="form-label">Auth Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control" name="auth_username" id="auth_username" placeholder="Enter Auth Username" value="{{ $gateway->auth_username }}" autocomplete=off />
                                </div>

                                @error('auth_username')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-realm" class="form-label">Realm</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                    <input type="text" class="form-control" name="realm" id="realm" placeholder="Enter Realm" value="{{ $gateway->realm }}" autocomplete=off />
                                </div>

                                @error('realm')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-from_user" class="form-label">From User</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <input type="text" class="form-control" name="from_user" id="from_user" placeholder="Enter From User" value="{{ $gateway->from_user }}" autocomplete=off />
                                </div>

                                @error('from_user')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-from_domain" class="form-label">From Domain</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" class="form-control" name="from_domain" id="from_domain" placeholder="Enter From Domain" value="{{ $gateway->from_domain }}" autocomplete=off />
                                </div>

                                @error('from_domain')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-proxy" class="form-label">Proxy<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-crosshairs"></i></span>
                                    <input type="text" class="form-control" name="proxy" id="proxy" placeholder="Enter Proxy" value="{{ $gateway->proxy }}" autocomplete=off />
                                </div>

                                @error('proxy')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-register_proxy" class="form-label">Register Proxy</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                                    <input type="text" class="form-control" name="register_proxy" id="register_proxy" placeholder="Enter Register Proxy" value="{{ $gateway->register_proxy }}" autocomplete=off />
                                </div>

                                @error('register_proxy')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-outbound_proxy" class="form-label">Outbound Proxy</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-arrow-circle-up"></i></span>
                                    <input type="text" class="form-control" name="outbound_proxy" id="outbound_proxy" placeholder="Enter Outbound Proxy" value="{{ $gateway->outbound_proxy }}" autocomplete=off />
                                </div>

                                @error('outbound_proxy')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-expire_seconds" class="form-label">Expire Seconds<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <input type="text" class="form-control" name="expire_seconds" id="expire_seconds" placeholder="Enter Expire Seconds" value="{{ $gateway->expire_seconds }}" autocomplete=off />
                                </div>

                                @error('expire_seconds')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">

                                <label for="for-register" class="form-label">Register</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                                    <select class="select2-multiple1 form-control" name="register" title="Register" id="register">
                                        <option value="">Select Register</option>
                                        <option value="TRUE" {{ $gateway->register == 'TRUE' ? 'selected' : '' }}>TRUE</option>
                                        <option value="FALSE" {{ $gateway->register == 'FALSE' ? 'selected' : '' }}>FALSE</option>
                                    </select>
                                </div>
                                @error('register')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-retry_seconds" class="form-label">Retry Reconds<span class="text-red"> *</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <input type="text" class="form-control" name="retry_seconds" id="retry_seconds" placeholder="Enter Retry Reconds" value="{{ $gateway->retry_seconds }}" autocomplete=off />
                                </div>

                                @error('retry_seconds')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-ping" class="form-label">Ping</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-puzzle-piece"></i></span>
                                    <input type="text" class="form-control" name="ping" id="ping" placeholder="Enter Ping" value="{{ $gateway->ping }}" autocomplete=off />
                                </div>

                                @error('ping')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-caller_id_in_from" class="form-label">Caller Id In From</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="text" class="form-control" name="caller_id_in_from" id="caller_id_in_from" placeholder="Enter Caller Id In From" value="{{ $gateway->caller_id_in_from }}" autocomplete=off />
                                </div>

                                @error('caller_id_in_from')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-channels" class="form-label">Channels</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                    <input type="text" class="form-control" name="channels" id="channels" placeholder="Enter Channels" value="{{ $gateway->channels }}" autocomplete=off />
                                </div>

                                @error('channels')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="for-hostname" class="form-label">Hostname</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe-africa"></i></span>
                                    <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Enter hostname" value="{{ $gateway->hostname }}" autocomplete=off />
                                </div>

                                @error('hostname')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-2 validation_message">
                                <label for="example-password" class="form-label">Default Outbound Gateway</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    <select class="select2-multiple1 form-control" name="outbound_default" title="Outbound Default" id="outbound_default">
                                        <option value="">Select Default Outbound Gateway</option>
                                        <option value="YES" {{ $gateway->outbound_default == 'YES' ? 'selected' : '' }}>YES</option>
                                        <option value="NO" {{ $gateway->outbound_default == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>

                                @error('outbound_default')<p class="validation_error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary float-end" type="submit">Update</button>
                    </form>
                        
                </div> 
            </div> 
        </div>
    </div>
</div> 
@endsection
<script src="{{ asset('js/validation.js') }}" defer></script>
