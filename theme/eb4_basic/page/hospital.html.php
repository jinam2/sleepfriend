<?php
/**
 * page file : /theme/THEME_NAME/page/hostpital.html.php
 */
if (!defined('_EYOOM_')) exit;

$sido_list = [
  '11' => '서울특별시',
  '26' => '부산광역시',
  '27' => '대구광역시',
  '28' => '인천광역시',
  '29' => '광주광역시',
  '30' => '대전광역시',
  '31' => '울산광역시',
  '36' => '세종특별자치시',
  '41' => '경기도',
  '42' => '강원도',
  '43' => '충청북도',
  '44' => '충청남도',
  '45' => '전라북도',
  '46' => '전라남도',
  '47' => '경상북도',
  '48' => '경상남도',
  '50' => '제주특별자치도',
];

$bcode_list = [
    '11' => ['sido_nm' => '서울특별시', 'sigungu' => []],
    '26' => ['sido_nm' => '부산광역시', 'sigungu' => []],
    '27' => ['sido_nm' => '대구광역시', 'sigungu' => []],
    '28' => ['sido_nm' => '인천광역시', 'sigungu' => []],
    '29' => ['sido_nm' => '광주광역시', 'sigungu' => []],
    '30' => ['sido_nm' => '대전광역시', 'sigungu' => []],
    '31' => ['sido_nm' => '울산광역시', 'sigungu' => []],
    '36' => ['sido_nm' => '세종특별자치시', 'sigungu' => []],
    '41' => ['sido_nm' => '경기도', 'sigungu' => []],
    '42' => ['sido_nm' => '강원도', 'sigungu' => []],
    '43' => ['sido_nm' => '충청북도', 'sigungu' => []],
    '44' => ['sido_nm' => '충청남도', 'sigungu' => []],
    '45' => ['sido_nm' => '전라북도', 'sigungu' => []],
    '46' => ['sido_nm' => '전라남도', 'sigungu' => []],
    '47' => ['sido_nm' => '경상북도', 'sigungu' => []],
    '48' => ['sido_nm' => '경상남도', 'sigungu' => []],
    '50' => ['sido_nm' => '제주특별자치도', 'sigungu' => []],
];

foreach($bcode_list as $key => $data) {
    //$sql = "select sigungu_nm, dong_cd2 as bcode from sido_dong_data where dong_cd2 like '{$key}%000000'  and dong_cd2 <> '{$key}00000000' ";
    $sql = "select sigungu_nm, dong_cd2 as bcode, dong_nm, dong_nm2 from sido_dong_data where dong_cd2 like '{$key}%' and right(dong_cd2, 5) = '00000' and dong_cd = dong_cd2 and dong_nm2 <> '' and sigungu_nm <> '' ";
    $bcode_list[$key]['sigungu'] = sql_fetch_all($sql);
}

$sql = "select * from sleep_place where category = 'hospital' and (address_bcode is not null or address_bcode <> '') order by display_order desc, address_bcode asc ";

$place_list = [];

$res = sql_query($sql);

while($row = sql_fetch_array($res)) {
    if($row['address_lat'] && $row['address_lon']) {
       if($row['address1'] && $row['address2']) {
           $row['address'] = $row['address1'] ." ".$row['address2'];
       } else if($row['address3']) {
           $row['address'] = $row['address3'];
       } else {
           continue;
       }
       $place_list[] = $row;
    }
}


//print_r2($bcode_list);
?>
<script>

</script>
<style>
    ul.place li {
        cursor:pointer;
    }
</style>
<div class="sub-page page-store"><div class="sub_inc">

	<div class="tab">
		<button class="tablinks" onclick="openMap(event, 'map1')" id="defaultOpen">Map</button>
		<button class="tablinks" onclick="openMap(event, 'map2')">List</button>
	</div>

	<!--  지도 -->
	<div id="map1" class="tabcontent">

		<div class="map" id="map_area">

		</div>

	</div>

	<!--  매장리스트 -->
	<div id="map2" class="tabcontent">
		<div class="store">
			<div class="search">
                <div class="input">
                    <select name="sel_sido">
                        <option value="">전체</option>
                        <?php foreach($sido_list as  $key => $value) {?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <select name="sel_sigungu">
                        <option value="">전체</option>
                    </select>
                </div>
				<div class="input input2">
					<input type="text" name="search_name" value="" placeholder="병원이름">
					<button><i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</div>

			<div class="list">
				<ul class="place">
                    <?php foreach($place_list as $row) { ?>
					<li data-bcode="<?=$row['address_bcode']?>" data-sido="<?=$row['sido']?>" data-sigungu="<?=$row['sigungu']?>" data-lat="<?=$row['address_lat']?>" data-lon="<?=$row['address_lon']?>" data-title="<?=$row['store_name']?>" data-tel="<?=$row['tel']?>">
						<strong><?=$row['store_name']?></strong>
						<p class="address"><?=$row['address']?></p>
						<p class="tel"><?=$row['tel']?></p>
					</li>
                    <?php } ?>
				</ul>
			</div>
		</div>

	</div>

	<script>
	function openMap(evt, mapName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(mapName).style.display = "block";
	  evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
	</script>

</div></div>


<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id'];?>&libraries=clusterer,services"></script>

<script>
    var map = null;
    var allMarkers = [];
    var allInfoWindows = [];
    var sale_positions = [];

    var bcode = <?php echo json_encode($bcode_list, JSON_UNESCAPED_UNICODE);?>;
    function map_load_list(sido, sigungu, keyword) {

        positions = [];

        var sel_bcode = sido + sigungu;

        if(!sido || sido == '') {
            $("ul.place > li").css({"display" : "block"});
            $("ul.place > li").addClass("view");

        } else if(!sigungu || sigungu == '') {
            sel_bcode = sido;
            let option_list = bcode[sido]['sigungu'].map((item, index) => {
                return item.bcode.substring(0,2) == sido ?  '<option value="' + item.bcode.substring(0,5) + '">' + item.sigungu_nm  + '</option>' : null;
            });
            $("ul.place > li").filter(':not([data-bcode^="' + sel_bcode + '"])').removeClass("view").css({"display" : "none"});

            $("ul.place > li").filter('[data-bcode^="' + sel_bcode + '"]').addClass("view").css({"display" : "block"});
            let output = '<option value="">전체</option>' + "\n" + option_list.join("\n");
            $("select[name=sel_sigungu]").empty().html(output);
        } else {
            sel_bcode = sigungu;
            $("ul.place > li").filter(':not([data-bcode^="' + sel_bcode + '"])').removeClass("view").css({"display" : "none"});
            $("ul.place > li").filter('[data-bcode^="' + sel_bcode + '"]').addClass("view").css({"display" : "block"});
        }

        if(keyword) {
            $("ul.place > li:visible").each(function(index, item){
                title =  $(this).data("title");
                if(title.indexOf(keyword) == -1 && title.toLowerCase().indexOf(keyword.toLowerCase()) == -1) {
                    $(this).removeClass("view").css({"display" : "none"});
                }
            });
        }

        $("ul.place > li.view").each(function(index, item){
            lat = $(this).data("lat");
            lon = $(this).data("lon");
            title = $(this).data("title");
            tel = $(this).data("tel");
            address = $(this).find(".address").html();
            data = {
                title : title,
                tel : tel,
                lat : lat,
                lon : lon,
                address : address,
            };
            positions[index] = data;
        });


        sale_positions = positions;

        var center_lat = positions[0] ? positions[0].lat : 37.5642135;
        var center_lon = positions[0] ? positions[0].lon : 127.001698;


        map.setCenter(new kakao.maps.LatLng(center_lat, center_lon));
        if((!sido || sido == '') && !keyword) {
            map.setLevel(12);
        } else if(keyword) {
            map.setLevel(4);
        } else {
            map.setLevel(10);
        }

        resetAllMarkers();
        resetAllInfoWindows();
        //사진/[카테고리]타이틀/주소/상담: 전화번호
        for (i = 0; i < positions.length; i++) {

            let latlng = new kakao.maps.LatLng(positions[i].lat, positions[i].lon);

            var marker = new kakao.maps.Marker({
                map: map,
                position: latlng,
                clickable: true
            });

            allMarkers.push(marker);

            var content = '<div class="map_marker_wrap">' +
                '    <div class="info">' +
                '        <div class="title">' + positions[i].title +
                '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
                '        </div>' +
                '        <div class="body">' +
                '            <div class="desc">' +
                '                <div class="ellipsis">' + positions[i].address + '</div>' +
                '                <div class="phone">' + positions[i].tel + '</div>' +
                '            </div>' +
                '        </div>' +
                '    </div>' +
                '</div>';

            var infowindow = new kakao.maps.InfoWindow({
                content: content,
                removable: true,
            });

            allInfoWindows.push(infowindow);

            //kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
            //kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
            kakao.maps.event.addListener(marker, 'click', makeOverListener(map, marker, infowindow));
        }

    }

    // 인포윈도우를 표시하는 클로저를 만드는 함수
    function makeOverListener(map, marker, infowindow) {
        return function () {
            if (allInfoWindows) {
                for (i = 0; i < allInfoWindows.length; i++) {
                    allInfoWindows[i].close();
                }
            }
            infowindow.open(map, marker);
        };
    }

    // 인포윈도우를 닫는 클로저를 만드는 함수
    function makeOutListener(infowindow) {
        return function () {
            infowindow.close();
        };
    }

    function resetAllMarkers() {
        if (allMarkers) {
            for (i = 0; i < allMarkers.length; i++) {
                marker = allMarkers[i];
                marker.setMap(null);

            }
        }
        allMarkers = []; //init
    }

    function resetAllInfoWindows() {
        if (allInfoWindows) {
            for (i = 0; i < allInfoWindows.length; i++) {
                infowindow = allInfoWindows[i];
                infowindow.close();
            }
        }
        allInfoWindows = []; //init
    }

    $(function() {
        map = new kakao.maps.Map(document.getElementById('map_area'), { // 지도를 표시할 div
            center: new kakao.maps.LatLng(37.5642135, 127.0016985), // 지도의 중심좌표
            level: 10 // 지도의 확대 레벨
        });

        customOverlay = new kakao.maps.CustomOverlay({}),
        infowindow = new kakao.maps.InfoWindow({removable: true});

       $("select[name=sel_sido]").change(function(e) {
          var sido = $(this).val();
          var keyword  = $("input[name=search_name]").val();
          map_load_list(sido, '', keyword);
       });

        $("select[name=sel_sigungu]").change(function(e) {
            var sido = $("select[name=sel_sido]").val();
            var sigungu = $(this).val();
            var keyword  = $("input[name=search_name]").val();
            map_load_list(sido, sigungu, keyword);
        });


       $("div.list ul > li").click(function(e) {
           center_lat = $(this).data('lat');
           center_lon = $(this).data('lon');

           if($("#map2").is(':visible')) {
               $("#map2").css({"display":"none"});
               $("#map1").css({"display":"block"});
               $(".tab button:nth-child(1)").addClass("active");
               $(".tab button:nth-child(2)").removeClass("active");
           }

           map.setCenter(new kakao.maps.LatLng(center_lat, center_lon));
           map.setLevel(4);

       });

       $("input[name=search_name]").on("keyup",function(key){
           if(key.keyCode==13) {
               sido = $("select[name=sel_sido]").val();
               sigungu = $("select[name=sel_sigungu]").val();
               keyword  = $(this).val();
               map_load_list(sido, sigungu, keyword);
           }
       });

        map_load_list('', ''); //all pos
    });
</script>
