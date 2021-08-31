
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
            for (let i in json.data) {
                var item = `
                    <li class="col-md-3 col-sm-6 col-12">
                        <div class="home-list-ul-item text-center p-3 mb-3 mt-3">
                            <div class="home-list-ul-item-img">
                                <a href="chi-tiet/` + json.data[i].duongdan + `">
                                    <img src="` + BASE_IMG + json.data[i].hinh1 + `"/>
                                </a>
                            </div>
                            <div class="home-list-ul-item-name mt-2">` + json.data[i].tenkhoahoc + `</div>
                        </div>
                    </li>
                `
                $('.home-list-ul').append(item);
            }
        } else {
            console.log(json.error);
        }
    })
}

// Lấy thông tin 1 con vật
function getAnimalInfo(animal_id) {
    myPost('get-animal-info', 'animal-id=' + animal_id, function(json) {
        if (json.status == 'OK') {
            console.log(json.data)
            $('.details-header b').text(json.data.tenkhoahoc);
            $('.details-content-img img').attr('src', BASE_IMG + json.data.hinh1);

            showAnimalImgList(json.data.hinh1);
            showAnimalImgList(json.data.hinh2);
            showAnimalImgList(json.data.hinh3);
            showAnimalImgList(json.data.hinh4);
            showAnimalImgList(json.data.hinh5);

            var details = `
                <li class="pb-1"><b>Giới: </b>` + json.data.gioi + `</li>
                <li class="pb-1"><b>Ngành: </b>` + json.data.nganh + `</li>
                <li class="pb-1"><b>Lớp: </b>` + json.data.lop + `</li>
                <li class="pb-1"><b>Bộ: </b>` + json.data.bo + `</li>
                <li class="pb-1"><b>Họ: </b>` + json.data.ho + `</li>
                <li class="pb-1"><b>Tên địa phương: </b>` + json.data.tendiaphuong + `</li>
                <li class="pb-1"><b>Tên khoa học: </b>` + json.data.tenkhoahoc + `</li>
                <li class="pb-1"><b>Tên tiếng việt: </b>` + json.data.tentiengviet + `</li>
                <li class="pb-1"><b>Tên địa phương: </b>` + json.data.tendiaphuong + `</li>
            `
            $('.details-content-center-info').append(details);

            var info =  `
                <p><b>Đặc điểm hình thái: </b> ` + json.data.hinhthai + `</p>
                <p><b>Đặc điểm sinh thái: </b> ` + json.data.sinhthai + `</p>
                <p><b>Sinh cảnh: </b> ` + json.data.sinhcanh + `</p>
            `
            $('.details-info').append(info);
        }
    })
}

function showAnimalImgList(itemData) {
    var li = document.createElement('li');
    var img = document.createElement('img');
    img.setAttribute('src', BASE_IMG + itemData);
    img.onclick = function () {
        showAnimalImgInDetails(itemData);
    }
    li.append(img);

    if (itemData != null) {
        $('.details-content-img-list').append(li);
    }
}

// Hiển thị hình ảnh được chọn trong trang chi-tiet
function showAnimalImgInDetails(img) {
    $('.details-content-img img').attr('src', BASE_IMG + img);
}

$(function() {
    // Lấy danh sách động vật
    getListAnimals();
})