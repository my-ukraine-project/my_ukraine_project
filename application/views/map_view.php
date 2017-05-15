<script>

        var map;
        var markers = [];

        function initMap() {
            var uluru = {
                lat: 57.8145629,
                lng: 22.5633271
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: uluru,
                mapTypeId: 'terrain',
                scrollwheel: false
            });

            var uluruMarker1 = {
                lat: 57.8145629,
                lng: 22.5633271
            };
            var uluruMarker2 = {
                lat: 47.8145629,
                lng: 32.5633271
            };

            // var marker = new google.maps.Marker({
            //     position: uluruMarker1,
            //     map: map
            // });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                addMarker(event.latLng);
            });
        }

        function addMarker(location) {
            var image = '/img/marker.png';
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: image
            });
            markers.push(marker);
        }

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        function showMarkers() {
            setMapOnAll(map);
        }

        function clearMarkers() {
            setMapOnAll(null);
        }

        function check() {
            console.clear();

            var unsvers = {};
            unsvers["1"] = "56.441667,25.076318";
            unsvers["2"] = "43.202817,27.918644";
            unsvers["3"] = "46.161452,33.692318;46.617810,31.539145";
            unsvers["4"] = "45.459267,29.261461;50.592906,36.595788;45.347877,28.838015";
            unsvers["5"] = "41.000953,39.732214;42.025082,35.140204";
            unsvers["6"] = "44.172328,28.641692;45.255940,30.204699";
            unsvers["7"] = "47.102553,37.557820";
            unsvers["8"] = "45.030087,35.381085";
            unsvers["9"] = "55.737695,37.613198";
            unsvers["10"] = "48.508643,26.492854";
            unsvers["11"] = "50.439324,30.529922";

            var count = 0;
            var countSUM = 1;

            for (var key in markers) {
                var lat = markers[key].position.lat().toString();
                var lng = markers[key].position.lng().toString();
                console.log(lat + " " + lng);

                var value = unsvers[selectId];
                console.log(value);
                // console.log(value.split(',')[1].split('.')[0]);

                if (!value.includes(";")) {
                    if (lat.split('.')[0] == value.split('.')[0] && lng.split('.')[0] == value.split(',')[1].split('.')[0]) {
                        alert('Вітаємо, ви вiрно вказали "' + $("select option:selected").text() + "'!");
                        return;
                    }
                } else {
                    countSUM = value.split(";").length;

                    console.log("SUM " + countSUM);

                    console.log(value.split(";"));


                    value.split(";").forEach(function(item, i, arr) {
                        console.log('-------');
                        console.log(lat.split('.')[0] + " " + item.split('.')[0]);
                        console.log(lng.split('.')[0] + " " + item.split(',')[1].split('.')[0]);
                        console.log('-------');


                        if (lat.split('.')[0] == item.split('.')[0] && lng.split('.')[0] == item.split(',')[1].split('.')[0]) {
                            count++;
                        }
                    });



                    // for (var key3 in value.split(";")) {
                    //     console.log(key3);
                    //     if (lat.split('.')[0] == key3.split('.')[0] && lng.split('.')[0] == key3.split(',')[1].split('.')[0]) {
                    //         count++;
                    //     }
                    // }

                    console.log("TRUE " + count);


                    if (count == countSUM) {
                        alert('Вітаємо, ви вiрно вказали "' + $("select option:selected").text() + "'!");
                        return;
                    }
                }
            }
            alert("Вiрних вiдповiдей " + count + " iз " + countSUM);
        }

        var selectId;

        $(document).ready(function() {

            $("#description").text("Участь Сагайдачного у польсько-шведській війні");
            selectId = "1";

            $("#quest").change(function() {
                var str = "";
                $("select option:selected").each(function() {

                    switch ($(this).val()) {
                        case "option1":
                            str += "Участь Сагайдачного у польсько-шведській війні";
                            selectId = "1";
                            break;
                        case "option2":
                            str += "Морські походи запорожці здійснювали під політичними гаслами боротьби з ворогами Святого Хреста, і головним їхнім об'єктом були багаті османські й татарські міста. Вони атакували декілька фортець одночасно, але основний удар був спрямований по головній цілі походу, при цьому намагалися знищити османський флот у портах і на морі.";
                            selectId = "2";
                            break;
                        case "option3":
                            str += "Запорожці здійснили великий похід на Кримське ханство, під час якого захопили та спалили Перекоп та Очаків.";
                            selectId = "3";
                            break;
                        case "option4":
                            str += "1608р. — на початку 1609 року П.Сагайдачний здійснив морський похід на 16 човнах-«чайках» у гирло Дунаю, під час якого було здійснено напад на Кілію, Білгород та Ізмаїл.";
                            selectId = "4";
                            break;
                        case "option5":
                            str += "У серпні 1614 року запорожці на 40-ка чайках подалися до берегів Османської імперії: захопили Трапезунд, узяли в облогу Синоп, захопили замком, вибили гарнізон і знищили весь флот галер і галеонів, які стояли на рейді.";
                            selectId = "5";
                            break;
                        case "option6":
                            str += "1615 року 80 козацьких чайок підійшли до Константинополя, де спалили вщент гавані Мізевні та Архіокі разом із флотом, що перебував там. Османський султан послав навздогін за козаками цілу флотилію, але в морських битвах біля острова Зміїний та під Очаковом її було розгромлено, а козаки взяли в полон Запропонувати самостійноосманського адмірала Алі-пашу";
                            selectId = "6";
                            break;
                        case "option7":
                            str += "У червні або на початку липня 1616 року П.Сашайдачного було проголошено гетьманом Війська Запорозького. Причиною цього могла стати його обіцянка організувати масштабніший похід, ніж попередній.";
                            selectId = "7";
                            break;
                        case "option8":
                            str += "Взяття запорозькими козаками на чолі з П.Сагайдачним турецької фортеці Кафи.";
                            selectId = "8";
                            break;
                        case "option9":
                            str += "Похід 20-тисячного козацького війська Сагайдачного в Московію на допомогу королевичу Владиславу. Деулінське перемир'я. Приєднання до Польщі Чернігово-Сіверщини та Смоленщини";
                            selectId = "9";
                            break;
                        case "option10":
                            str += "Хотинська війна 1620–1621 років — війна султанської Османської імперії проти Речі Посполитої, яка завершилася 4-тижневою битвою об'єднаних сил українського козацького і польського шляхетського військ проти османсько-татарських загарбників під Хотином (звідси її назва) і поразкою османів.";
                            selectId = "10";
                            break;
                        case "option11":
                            str += "Смерть і поховання гетьмана П.Сагайдачного";
                            selectId = "11";
                            break;
                    }
                    // str += $(this).text() + " ";
                });
                $("#description").text(str);
                deleteMarkers();
            });
        });
    </script>


<div class="container-fluid" id="container">
	<div class="row">
		<div id="sidebar">
			<img src="/img/logo.png" alt="" class="logo">
			<div class="welcome">
				<p>Привiт, <b><?php $var = explode(" ", $data->fio, 2); echo $var[0]; ?></b>!</p>
			</div>
			<div class="main-menu">
				<ul>
					<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
					<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
                    <li><p style="color: #FF7416; text-shadow: 0px 0px 1px #000; font-weight: bold;"> <i class="fa fa-map-marker" aria-hidden="true"></i> Гра на мапі</p></li>
					<li><a href="/Quests"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</a></li>
					<li><a href="/Rating"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</a></li>
					<li><a href="/Settings"> <i class="fa fa-cogs" aria-hidden="true"></i> Налаштування</a></li>
				</ul>
			</div>
			<div class="advance">
				<p>Мої <b>успіхи</b></p>
                <div class="advance-percent"><?= $data->progress ?>%</div>
				<p>пройдено</p>
        <div class="logout">
            <a href="/Main/logout" class="btn btn-danger">Вийти</a>
        </div>
			</div>
		</div>
		<div id="content">
			<div class="container-fluid">

				<div class="row">
					<div class="col-sm-12">
						<h1>Гра на картi</h1></div>				
					</div>
					
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">×</button>
					  <strong>Увага!</strong> Перед проходженням квестів рекомендуємо вам перевірити свої знання за допомогою даної карти.
					</div>

					<div>
            <select id="quest" style="max-width: 450px" class="form-control">
                <option value="option1">Польсько-шведська війна</option>
                <option value="option2">Похід на Варну</option>
                <option value="option3">Битва за Перекоп і Очаків</option>
                <option value="option4">Битва за Кілію, Білгород, Ізмаїл</option>
                <option value="option5">Битва за Трапезунд, Синоп</option>
                <option value="option6">Битва при Константинополі та біля острова Змеїний</option>
                <option value="option7">Гетьманство</option>
                <option value="option8">Битва за Кафу</option>
                <option value="option9">Похід 20-тисячного козацького війська Сагайдачного в Московію</option>
                <option value="option10">Бітва під Хотином</option>
                <option value="option11">Смерть гетьмана</option>
            </select>
        </div>
				
				<br>
        <div class="alert alert-warning">
            <p id="description"></p>
        </div>

        <br/>

        <div id="map" style="height: 70vh;"></div>
        <br>
        <div id="floating-panel">
            <input onclick="clearMarkers();" type="button" value="Cховати позначки">
            <input onclick="showMarkers();" type="button" value="Показати позначки">
            <input onclick="deleteMarkers();" type="button" value="Видалити позначки">
        </div>
				
				<br>
        <button class="btn btn-danger btn-lg" onclick="check();">ПЕРЕВІРИТИ СЕБЕ</button>

				<div class="row">
					<footer id="footer-dashboard">
						<p>Поділися квестами з друзями! <i class="fa fa-arrow-down" aria-hidden="true"></i> </p>
						<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter"></div>
						<div class="footer-menu">
							<ul>
								<li><a href="/"> <i class="fa fa-home" aria-hidden="true"></i> Головна</a></li>
								<li><a href="/Information"> <i class="fa fa-info" aria-hidden="true"></i> Інформація</a></li>
								<li><a href="/Quests"> <i class="fa fa-tasks" aria-hidden="true"></i> Квести</a></li>
								<li><a href="/Rating"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</a></li>
								<li><a href="/Settings"> <i class="fa fa-cogs" aria-hidden="true"></i> Налаштування</a></li>
							</ul>
						</div>
					</footer>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDivmZHbm2P1MFI278_IWoKxSy59UeNOnY&callback=initMap"></script>