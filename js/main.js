
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
    $('.home-list-ul').text('');
    myPost('get-list-animals', '', function(json) {
        if(json.status == 'OK') {
            $('.home-list-sum').text('Tổng cộng có ' + json.data.length + ' con vật.');
            for (let i in json.data) {
                createItemAnimal(json.data[i], '.home-list-ul');
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
                <li class="pb-1"><b>Giá trị sử dụng: </b>` + json.data.giatri + `</li>
            `
            $('.details-content-center-info').append(details);

            var characteristic =  `
                <p><b>Đặc điểm hình thái: </b> ` + json.data.hinhthai + `</p>
                <p><b>Đặc điểm sinh thái: </b> ` + json.data.sinhthai + `</p>
                <p><b>Sinh cảnh: </b> ` + json.data.sinhcanh + `</p>
            `
            $('.details-info-characteristic').append(characteristic);

            var maintain = `
                <p><b>Theo IUCN: </b> ` + json.data.iucn + `</p>
                <p><b>Theo sách đỏ Việt Nam: </b> ` + json.data.sachdo + `</p>
                <p><b>Theo Nghị định 32/2006/NĐCP: </b> ` + json.data.nghidinh + `</p>
                <p><b>Theo CITES (40/2013/TT-BNNPTNT): </b> ` + json.data.cities + `</p>
            `
            $('.details-maintain-info').append(maintain);


            var distribution = `
                <p><b>Phân bố: </b> ` + json.data.phanbo + `</p>
                <p><b>Địa điểm: </b> ` + json.data.diadiem + `</p>
            `
            $('.details-distribution-info').append(distribution);
            // Show con vật tương tự
            getAnimalsListSameFamily(json.data.id);
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

// Lấy danh sách các động vật tương tự - họ, bộ
function getAnimalsListSameFamily(animal_id) {
    myPost('get-animal-list-same-family', 'animal_id=' + animal_id, function(json) {
        if (json['status'] == 'OK') {
            console.log('getAnimalsListSameFamily');
            console.log(json.data);

            for (let i in json.data) {
                var item = `
                    <li class="col-md-3 col-sm-6 col-12">
                        <div class="home-list-ul-item text-center p-3 mb-3 mt-3">
                            <div class="home-list-ul-item-img">
                                <a href="` + json.data[i].duongdan + `">
                                    <img src="` + BASE_IMG + json.data[i].hinh1 + `"/>
                                </a>
                            </div>
                            <div class="home-list-ul-item-name mt-2">` + json.data[i].tenkhoahoc + `</div>
                        </div>
                    </li>
                `
                $('.details-same-family-list-ul').append(item);
            }
            
        }
    })
}

// Hiển thị hình ảnh được chọn trong trang chi-tiet
function showAnimalImgInDetails(img) {
    $('.details-content-img img').attr('src', BASE_IMG + img);
}

function searchAnimal() {
    var text = $('.header-search-animal').val();
    if (text == '') {
        alert('Vui lòng nhập thông tin tìm kiếm!');
        return;
    }
    myPost('search-animal', 'text=' + text, function(json) {
        if (json.status == 'OK') {
            console.log(json);
            var locate = window.location.href;
           
                // Ở trang chi tiết
            if (locate != 'http://localhost/tuongtacnguoimay/web-tuong-tac-nguoi-may/') {
                $('.details-search-sum').text('Có ' + json.data.length + ' kết quả tương ứng cho tìm kiếm của bạn.');
                $('.details-search-result').text('');
                for (let i in json.data) {
                    createItemAnimal(json.data[i], '.details-search-result');
                }
                $('.details-search-button').click();
            } 
                // Ở trang chủ
            else {
                $('.home-list-sum').text('Có ' + json.data.length + ' kết quả tương ứng cho tìm kiếm của bạn.');
                $('.home-list-ul').text('');
                for (let i in json.data) {
                    createItemAnimal(json.data[i], '.home-list-ul');
                }
            }
        }
    })
}

function createItemAnimal(itemData, parentsElement) {
    var item = `
        <li class="col-md-3 col-sm-6 col-12">
            <div class="home-list-ul-item text-center p-3 mb-3 mt-3">
                <div class="home-list-ul-item-img">
                    <a href="` + BASE + 'chi-tiet/' + itemData.duongdan + `">
                        <img src="` + BASE_IMG + itemData.hinh1 + `"/>
                    </a>
                </div>
                <div class="home-list-ul-item-name mt-2">` + itemData.tenkhoahoc + `</div>
            </div>
        </li>
    `
    $(parentsElement).append(item);
}

$(function() {
    // Lấy danh sách động vật
    getListAnimals();
    // Search
    $('.header-search-animal-button').on('click', function() {
        searchAnimal();
    })

    $('.header-search-animal').on('keypress', function(e) {
        if (e.code == 'Enter') {
            searchAnimal();
        }
    })
})