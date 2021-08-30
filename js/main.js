
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

// --------------------------- Lấy danh sách động vật --------------------------------
function getListAnimals() {
    myPost('get-list-animals', '', function(json) {
        if(json.status == 'OK') {
            console.log(json.data);
            for (let i in json.data) {
                var li = document.createElement('li');
                var div = document.createElement('div');
                div.className = 'home-list-ul-item';
                var div_img = document.createElement('div');
                var div_name = document.createElement('div');
                var img = document.createElement('img');
                img.setAttribute('src' , BASE + json.data[i].hinh1);
                div_img.append(img);
                li.append(div_img);

                div.append(div_img, div_name);
                $('.home-list-ul').append(div);
            }
        } else {
            console.log(json.error);
        }
    })
}

$(function() {
    // Lấy danh sách động vật
    getListAnimals();
})