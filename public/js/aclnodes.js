$(document).ready(function () {
    $('#check_validation_aclnodes').validate({ // initialize the plugin
        rules: {
           
            cidr: {
                required: true
            },
            type: {
                required: true,
            },
            list_id: {
                required: true,
            },      
           
        },
        messages: {
            cidr: {
                required: 'CIDR cannot be blank.'
            },
            type: {
                required: 'Type cannot be blank.'
            },
            list_id: {
                required: 'List cannot be blank. '
            },
        },
    });
});