<?php 
    include '../../config.php';
    include '../layout/header-only.php';
?>

<div id="details">
  <div class="container">
    <div class="details">
      <div class="details-header">
        <b></b>
      </div>
      <div class="details-content mt-3 ">
        <div class="row">
          <div class="col-5">
            <div class="details-content-left">
              <div class="details-content-img mb-3">
                <img src="" alt="">
              </div>
              <ul class="details-content-img-list d-flex"></ul>
            </div>
          </div>
          <div class="col-5">
            <div class="details-content-center">
              <b>THÔNG TIN</b>
              <ul class="details-content-center-info"></ul>
            </div>
          </div>
          <div class="col-2">
            This is map
          </div>
        </div>
      </div>
      <div class="details-info">
        
      </div>
    </div>
  </div>
</div>


<script>
var api = BASE + '../api.php';

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
</script>
<script>
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

</script>