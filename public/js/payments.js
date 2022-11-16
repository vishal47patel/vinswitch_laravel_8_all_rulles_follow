$(document).ready(function () {

    // validation create number and edit number
    $('#check_validation').validate({ 
        rules: {

            account_number: {
                required: true,
                number: true,
            },
            status: {
                required: true,
            },
            date: {
                required: true,
            },
            summary: {
                required: true,

            },

        },
        messages: {
            account_number: {
                required: 'Account Number is required!',
                number: 'Account Number allow only number is required!'
            },
            status: {
                required: 'Status is required!',
                
            },
            date: {
                required: 'Date is required!'
            },
            summary: {
                required: 'Summary is required!'

            }

        },
    });    
});