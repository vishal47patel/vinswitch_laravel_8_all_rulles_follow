var base_url = $("#base_url").val();

// data = this => pass when call html inline function => value (this or '')
// feildname = number_state => pass state feild id that you need to load states=> value (state)
// country_id = UAE => pass country id (optional feild) (feild for edit form)
// state_id_selected = 1 => pass state id for default selected(optional feild) (feild for edit form)
function getState(data, feildname, country_id = '', state_id_selected = '') {

    let country;
    if (country_id != '') {
        country = country_id;
    } else {
        country = data.value;
    }

    $('#' + feildname).html('<option>select</option>');
    let url = base_url + "/country/" + country + "/get-states";
    $.get(url, function (data, status) {

        let states = data.states;

        if (status && status == 'success') {
            let option = '';

            $.each(states, function (key, val) {
                let selected = '';
                if (state_id_selected != '' && val.state_id == state_id_selected) {
                    selected = 'selected';
                }
                option += '<option value="' + val.state_id + '" ' + selected + '>' + val.Name + ' [' + val.ID + ']</option>';
            });

            if (option != '') {
                $('#' + feildname).html('<option>select</option>' + option);
            }

        }

    });
}

// data = this => pass when call html inline function => value (this or '')
// feildname = number_state => pass state feild id that you need to load cities => value (city)
// state_id = 1 => pass state id (optional feild) (feild for edit form)
// city_id_selected = 1 => pass country id for default selected (optional feild) (feild for edit form)
function getCities(data, feildname = 'city', state_id = '', city_id_selected = '') {
    $('#' + feildname).html('<option>select</option>');

    let state;
    if (state_id != '') {
        state = state_id;
    } else {
        state = data.value;
    }

    let url = base_url + "/state/" + state + "/get-cities";
    $.get(url, function (data, status) {
        let cities = data.cities;

        if (status && status == 'success') {

            let option = '';
            $.each(cities, function (key, val) {
                let selected = '';
                if (city_id_selected != '' && val.ID == city_id_selected) {
                    selected = 'selected';
                }
                option += '<option value="' + val.ID + '" ' + selected + '>' + val.city_name + '</option>';
            });

            if (option != '') {
                $('#' + feildname).html('<option>select</option>' + option);
            }

        }

    });
}

// reset search form 
function resetForm(formName = "feildWiseSearchForm") {
    $('#' + formName).closest('form').find("input, textarea, select").val("");
    let origin = window.location.origin;
    let pathname = window.location.pathname;
    
    let nextURL = origin + pathname;
    let nextTitle = 'Reset search form';
    let nextState = { additionalInformation: 'Reset search form' };

    window.history.pushState(nextState, nextTitle, nextURL);
    window.history.replaceState(nextState, nextTitle, nextURL);
    window.location.replace(nextURL);

}

$(document).ready(function () {

});