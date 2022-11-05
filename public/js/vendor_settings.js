$(document).ready(function () {

    // validation create number and edit number
    $('#check_validation_vendor_settings').validate({ 
        rules: {

            setting_key: {
                required: true,
            },
            setting_value: {
                required: true,
            },           

        },
        messages: {
            setting_key: {
                required: 'Setting Key is required!',
            },
            setting_value: {
                required: 'Setting Value is required!',
            }, 

        },
    });
    
    // validation import number
    $('#check_validation_vendor_settings_update').validate({ 
        rules: {
            setting_value: {
                required: true,
            },           

        },
        messages: {            
            setting_value: {
                required: 'Setting Value is required!',
            }, 

        },
    });   
});