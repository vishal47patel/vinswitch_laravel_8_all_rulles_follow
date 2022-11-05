$(document).ready(function () {
    $('#check_validation_gateway').validate({ // initialize the plugin
        rules: {
           
            gateway_name: {
                required: true
            },
            expire_seconds: {
                required: true,
                number: true
            },
            proxy: {
                required: true,
            },
            register: {
                required: true,               
                
            },
            retry_seconds: {
                required: true,
                number: true                
            },        
           
        },
        messages: {
            gateway_name: {
                required: 'Gatway Name is required!'
            },
            expire_seconds: {
                required: 'Expire Second is required!',
                number: 'Expire Second allow only number is required!'
            },
            proxy: {
                required: 'Proxy is required!'
            },
            register: {
                required: 'Register is required!'            
                
            },
            retry_seconds: {
                required: 'Retry Seconds is required!',
                number: 'Retry Seconds allow only number is required!'             
            },
        },
    });
});