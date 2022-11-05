$(document).ready(function () {

    // validation create number and edit number
    $('#check_validation_did_numbers').validate({ 
        rules: {

            number_did: {
                required: true,
                number: true,
            },
            number_service_type: {
                required: true,
            },
            number_channel_limit: {
                required: true,
            },
            number_country: {
                required: true,

            },

        },
        messages: {
            number_did: {
                required: 'Number is required!',
                number: 'Gatway Name allow only number is required!'
            },
            number_service_type: {
                required: 'Please select Service Type!',
            },
            number_channel_limit: {
                required: 'Channel Limit is required!'
            },
            number_country: {
                required: 'Please select Country!'

            }

        },
    });
    
    // validation import number
    $('#check_validation_did_numbers_import').validate({ 
        rules: {
           
            number_service_type: {
                required: true,
            },
            number_channel_limit: {
                required: true,
            },
            number_country: {
                required: true,

            },

        },
        messages: {
            
            number_service_type: {
                required: 'Please select Service Type!',
            },
            number_channel_limit: {
                required: 'Channel Limit is required!'
            },
            number_country: {
                required: 'Please select Country!'

            }

        },
    });


    let country_get = $('.country_get').data('id');
    let state_set_get = $('.state_set_get').data('id');
    let city_set = $('.city_set').data('id');
    let data = '';
    getState(data, 'number_state',country_get,state_set_get);
    getCities(data, 'number_area',state_set_get,city_set);
});