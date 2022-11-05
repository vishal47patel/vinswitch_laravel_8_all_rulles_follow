$(document).ready(function () {
    $('#check_validation_vendors').validate({ // initialize the plugin
        rules: {
           
            vendor_name: {
                required: true
            },
            vendor_code: {
                required: true,
                number: true
            },
            did_type: {
                required: true,
            },
            
            priority: {
                required: true,
                number: true                
            },        
           
        },
        messages: {
            vendor_name: {
                required: 'Vendor Name is required!'
            },
            vendor_code: {
                required: 'Vendor Code is required!',
                number: 'Vendor Code allow only number is required!'
            },
            did_type: {
                required: 'Did Type is required!'
            },
            
            priority: {
                required: 'Priority is required!',
                number: 'Priority allow only number is required!'             
            },
        },
    });
});