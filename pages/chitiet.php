<div id="details">
  <div class="container">
    <div class="details pt-4">
      <div class="details-header mb-4 bg-info p-3">
        <b class="text-light"></b>
      </div>
      <div class="details-content mt-3 ">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="details-content-left">
              <div class="details-content-img mb-3 p-2">
                <img src="" alt="">
              </div>
              <ul class="details-content-img-list d-flex"></ul>
            </div>
          </div>
          <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="details-content-center">
              <!-- <div class="text-info pb-2 font-weight-bold">THÔNG TIN</div> -->
              <div class="details-title text-info font-weight-bold pb-2 pt-2"><span>THÔNG TIN</span></div>
              <ul class="details-content-center-info"></ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
            <div id="map-canvas" style="height: 300px; width: 100%;"></div>
            <?php
            $iddv = $_SESSION['animal_id'];
            $con = new mysqli("localhost", "root", "", "web_animal");
            $con->set_charset("utf8");
            $sql = "SELECT * FROM toado WHERE dongvat_id = " . $iddv . "";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              $i = 1; //Dat bien i truoc tien de khoi tao chay trong while
              while ($row = $result->fetch_assoc()) {
                $toado[$i] = "new google.maps.LatLng(" . $row['toado'] . ")";
                //echo $toado[$i]."<br>";
                $i++;
              }
            }
            $str = "";
            for ($j = 1; $j < $i; $j++) {
              if (empty($str)) {
                $str = $str . $toado[$j];
              } else {
                $str = $str . ", " . $toado[$j];
              }
            }
            //echo $str;
            ?>
            <script type="text/javascript">
              var draggablePolygon;

              function InitMap() {
                var location = new google.maps.LatLng(9.571747, 105.736019);
                var mapOptions = {
                  zoom: 13,
                  center: location,
                  mapTypeId: google.maps.MapTypeId.RoadMap
                };
                var map = new google.maps.Map(document.getElementById('map-canvas'),
                  mapOptions);


                var shapeCoordinates = [
                  <?php
                  echo $str;
                  ?>
                  /*new google.maps.LatLng(9.563974, 105.742907),
                  new google.maps.LatLng(9.574045, 105.734023),
                  new google.maps.LatLng(9.575835, 105.739572),
                  new google.maps.LatLng(9.566833, 105.733836)*/
                ];
                // Construct the polygon
                draggablePolygon = new google.maps.Polygon({
                  paths: shapeCoordinates,
                  draggable: true,
                  editable: true,
                  strokeColor: '',
                  strokeOpacity: 0.8,
                  strokeWeight: 2,
                  fillColor: '#ADFF2F',
                  fillOpacity: 0.5
                });
                draggablePolygon.setMap(map);
                google.maps.event.addListener(draggablePolygon, "dragend", Getpolygoncoordinates);
                google.maps.event.addListener(draggablePolygon.getPath(), "insert_at", Getpolygoncoordinates);
                google.maps.event.addListener(draggablePolygon.getPath(), "remove_at", Getpolygoncoordinates);
                google.maps.event.addListener(draggablePolygon.getPath(), "set_at", Getpolygoncoordinates);
              }

              function Getpolygoncoordinates() {
                var len = draggablePolygon.getPath().getLength();
                var strArray = "";
                for (var i = 0; i < len; i++) {
                  strArray += draggablePolygon.getPath().getAt(i).toUrlValue(5) + "<br>";
                }
                document.getElementById('info').innerHTML = strArray;
              }
            </script>
            <?php
            //echo $_SESSION['animal_id'];
            ?>
          </div>
        </div>
      </div>

      <div class="details-distribution">
        <div class="details-title text-info font-weight-bold pb-2 pt-2"><span>Phân bố</span></div>
        <div class="details-distribution-info"></div>
      </div>

      <div class="details-info">
        <div class="details-title text-info font-weight-bold pb-2 pt-2"><span>Đặc điểm</span></div>
        <div class="details-info-characteristic"></div>
      </div>

      <div class="details-maintain">
        <div class="details-title text-info font-weight-bold pb-2 pt-2"><span>Bảo tồn</span></div>
        <div class="details-maintain-info"></div>
      </div>

      <div class="details-same-family">
        <div class="details-title text-info font-weight-bold pb-2 pt-2"><span>Tương tự</span></div>
        <ul class="details-same-family-list-ul row"></ul>
      </div>
    </div>
  </div>
</div>