
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

// ---------- CHuyển đổi chuỗi ---------- vd: yen linh -> yen-linh
function toString(str) {
    var AccentsMap = [
      "aàảãáạăằẳẵắặâầẩẫấậ",
      "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
      "dđ", "DĐ",
      "eèẻẽéẹêềểễếệ",
      "EÈẺẼÉẸÊỀỂỄẾỆ",
      "iìỉĩíị",
      "IÌỈĨÍỊ",
      "oòỏõóọôồổỗốộơờởỡớợ",
      "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
      "uùủũúụưừửữứự",
      "UÙỦŨÚỤƯỪỬỮỨỰ",
      "yỳỷỹýỵ",
      "YỲỶỸÝỴ"    
    ];
    for (var i=0; i<AccentsMap.length; i++) {
      var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
      var char = AccentsMap[i][0];
      str = str.replace(re, char);
    }
    str = str.trim();
    str = str.replace(/\s+/g, '-').toLowerCase();
    str = str.replace(/[\[\]&#,+()$~%.'":*?<>{}]/g, '');
    return str;
}

// --------------------------- Lấy danh sách động vật --------------------------------
function getListAnimals() {
    $('.home-list-ul').text('');
    myPost('get-list-animals', '', function(json) {
        if(json.status == 'OK') {
            console.log(json.data)
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

            for (let i in json.data.img) {
                if (i ==0) {
                    $('.details-content-img img').attr('src', BASE_IMG + json.data.img[i].duongdan);
                }
                showAnimalImgList(json.data.img[i]);
            }
            var details = `
                <li class="pb-1"><b>Giới: </b>` + json.data.info.gioi + `</li>
                <li class="pb-1"><b>Ngành: </b>` + json.data.info.nganh + `</li>
                <li class="pb-1"><b>Lớp: </b>` + json.data.info.lop + `</li>
                <li class="pb-1"><b>Bộ: </b>` + json.data.info.bo + `</li>
                <li class="pb-1"><b>Họ: </b>` + json.data.info.ho + `</li>
                <li class="pb-1"><b>Tên địa phương: </b>` + json.data.info.tendiaphuong + `</li>
                <li class="pb-1"><b>Tên khoa học: </b>` + json.data.info.tenkhoahoc + `</li>
                <li class="pb-1"><b>Tên tiếng việt: </b>` + json.data.info.tentiengviet + `</li>
                <li class="pb-1"><b>Tên địa phương: </b>` + json.data.info.tendiaphuong + `</li>
                <li class="pb-1"><b>Giá trị sử dụng: </b>` + json.data.info.giatri + `</li>
            `
            $('.details-content-center-info').append(details);

            var characteristic =  `
                <p><b>Đặc điểm hình thái: </b> ` + json.data.info.hinhthai + `</p>
                <p><b>Đặc điểm sinh thái: </b> ` + json.data.info.sinhthai + `</p>
                <p><b>Sinh cảnh: </b> ` + json.data.info.sinhcanh + `</p>
            `
            $('.details-info-characteristic').append(characteristic);

            var maintain = `
                <p><b>Theo IUCN: </b> ` + json.data.info.iucn + `</p>
                <p><b>Theo sách đỏ Việt Nam: </b> ` + json.data.info.sachdo + `</p>
                <p><b>Theo Nghị định 32/2006/NĐCP: </b> ` + json.data.info.nghidinh + `</p>
                <p><b>Theo CITES (40/2013/TT-BNNPTNT): </b> ` + json.data.info.cities + `</p>
            `
            $('.details-maintain-info').append(maintain);


            var distribution = `
                <p><b>Phân bố: </b> ` + json.data.info.phanbo + `</p>
                <p><b>Địa điểm: </b> ` + json.data.info.diadiem + `</p>
            `
            $('.details-distribution-info').append(distribution);
            // Show con vật tương tự
            getAnimalsListSameFamily(json.data.info.id);
        }
    })
}

function showAnimalImgList(itemData) {
    var li = document.createElement('li');
    var img = document.createElement('img');
    img.setAttribute('src', BASE_IMG + itemData.duongdan);
    img.onclick = function () {
        showAnimalImgInDetails(itemData.duongdan);
    }
    li.append(img);
    $('.details-content-img-list').append(li);
}

// Lấy danh sách các động vật tương tự - họ, bộ
function getAnimalsListSameFamily(animal_id) {
    myPost('get-animal-list-same-family', 'animal_id=' + animal_id, function(json) {
        if (json['status'] == 'OK') {
            console.log('getAnimalsListSameFamily');
            console.log(json.data);

            for (let i in json.data) {
                createItemAnimal(json.data[i], '.details-same-family-list-ul');
            }
            
        }
    })
}

// Hiển thị hình ảnh được chọn trong trang chi-tiet
function showAnimalImgInDetails(img) {
    $('.details-content-img img').attr('src', BASE_IMG + img);
}

function getSearchAnimal(text) {
    myPost('get-search-animal', 'text=' + text, function(json) {
        if (json.status == 'OK') {
            console.log('search');
            console.log(json.data);
            $('.search-list-sum').text('Có ' + json.data.length + ' kết quả tương ứng cho tìm kiếm của bạn.');
            $('.search-list-ul').text('');
            for (let i in json.data) {
                createItemAnimal(json.data[i], '.search-list-ul');
            }
        }
    })
}

function createItemAnimal(itemData, parentsElement) {
    var item = `
        <li class="col-md-3 col-sm-6 col-12">
            <div class="home-list-ul-item text-center p-3 mb-3 mt-3">
                <div class="home-list-ul-item-img">
                    <a href="` + BASE + 'chi-tiet/' + itemData.animal.duongdan + `">
                        <img src="` + BASE_IMG + itemData.img.duongdan + `"/>
                    </a>
                </div>
                <div class="home-list-ul-item-name mt-2">` + itemData.animal.tenkhoahoc + `</div>
            </div>
        </li>
    `
    $(parentsElement).append(item);
}

function searchAnimal() {
    var text = $('.header-search-animal').val();
    if (text == '') {
        alert('Vui lòng nhập thông tin tìm kiếm!');
        return;
    }
    window.location = BASE + 'tim-kiem/' + toString(text);
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