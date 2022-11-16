$(document).ready(function () {
    $('#check_validation').validate({ // initialize the plugin
        rules: {
           
            firstname: {
                required: true,
                maxlength: 40,
            },
            lastname: {
                required: true,
                maxlength: 40,
            },
            name: {
                required: true,
                maxlength: 40,
            },
            email: {
                required: true,
                email: true,
                maxlength: 40,  
            },
            phoneno: {
                required: true,
                minlength: 10,
                number: true,
            },
            status: {
                required: true,                
            },
            role_id:{
                required: true,
            },
            password: {
                required: true,                
            },
            confirm_password: {
                required: true,                
            },
            current_password: {
                required: true,                
            },
            username: {
                required: true,                
            },
            initial_increment: {
                required: true,    
                maxlength: 20,            
            },
            pulse_rate: {
                required: true,
                maxlength: 20,                
            },
            monthly_payment: {
                required: true,  
                decimal: true,              
            },
            monthly_mins: {
                required: true,
                maxlength: 20,                
            },
            sip_account_price: {
                required: true,     
                decimal: true,           
            },
            end_point_price: {
                required: true,      
                decimal: true,          
            },
            outbound_sms_price: {
                required: true,    
                decimal: true,            
            },
            per_channel_price:{
                 decimal: true,   
             },
            rateplan_id: {
                required: true,                
            },
            plan_name: {
                required: true,
                maxlength: 40,                
            },
            cc: {
                required: true,
                maxlength: 20,                
            },
            max_call_length: {
                required: true,
                maxlength: 20,                
            },
            code: {
                required: true, 
                maxlength: 30,
                number: true,               
            },
            description: {
                maxlength: 50,
            },
            buy_rate: {
                required: true, 
                maxlength: 20,
                number: true,               
            },
            bill_plan_name: {
                required: true, 
                unique: true,               
            },
            type:{
                required: true,
            },
            SofiaRate_sale_percentage:
            {
                number: true,
                maxlength: 30,
            },
            sale_percentage: {
                number: true,
                maxlength: 20,
            },
            bill_plan_type: {
                required: true,
            },
            origination_rate_plan: {
                required: true,
            },
            contact_no: {
                required: true,
                minlength: 10,
            },
            company_name: {
                required: true,
            },
            address: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            },
            postal_code: {
                required: true,
            },
            isdefault: {
                required: true,                
            },
            lead_file: {
                required: true,                
            },
            freeswitch_host: {
                required: true,
                maxlength: 100,                 
            },
            freeswitch_password: {
                required: true,
                maxlength: 50,                 
            },
            freeswitch_port: {
                required: true,  
                maxlength: 10,              
            },
            rate: {
                required: true,  
                maxlength: 15,
            },              
            billplan_method: {
                required: true,                
            },
            origination_bill_plan_id: {
                required: true,                
            },
            bill_plan_id: {
                required: true,                
            },
            call_per_seconds: {
                number: true,
                required: true,                
            },
        },
        messages: {
            name: 'Name cannot be blank.',
            status: 'This field is required.',
            role_id: 'This field is required.',
            type: 'This field is required.',
            bill_plan_type: 'This field is required.',
            origination_rate_plan: 'This field is required.',
            state: 'This field is required.',
            
            freeswitch_host: {
                required: 'Freeswitch Host cannot be blank.',
                maxlength: 'The port must be at least 50.'
            },
            freeswitch_password: {
                required: 'Freeswitch Password cannot be blank.',
                maxlength: 'The port must be at least 100.'
            },
            freeswitch_port: {
                required: 'Freeswitch Port cannot be blank.',
                maxlength: 'The port must be at least 10.'
            },
            rate: {
                required: 'Rate "%" cannot be blank..',
                maxlength: 'The Rate must be at least 15.'
            },
            billplan_method: 'This field is required.',
            origination_bill_plan_id: 'This field is required.',
            bill_plan_id: 'This field is required.',

        }

    });
});