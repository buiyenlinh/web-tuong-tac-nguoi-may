
var api = BASE + 'api.php';

function myPost(action, data, callback) {
    if (data) {
        data = 'action=' + action + '&' + data;
    } else {
        data = 'action=' + action;
    }

    $.ajax({
        url: api,
        type: 'post',
        cache: false,
        data: data,
        dataType: 'json'
    }).done(function(json) {
        callback(json);
    })
}



$(function() {

})