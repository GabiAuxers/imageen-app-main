var rutaAdmin = "/admin";
if (location.host == "localhost") rutaAdmin = "/admin";

var RutaMedia = "https://app.imageen.net/media";
var fecha = new Date();
var dia = fecha.getDate();
var mes = fecha.getMonth() + 1;
var navidad=0;
if ( (mes==12 && dia>19) || (mes==1 && dia<7)){
	navidad = 1;
}

function checkForm() {
	var error = 0;

	if (document.getElementById("box-nombre").value == "") {
		error += 1;
		document.getElementById("err-box-nombre").style.display = "";
	}
	if (document.getElementById("box-apellidos").value == "") {
		error += 1;
		document.getElementById("err-box-apellidos").style.display = "";
	}
	if (document.getElementById("box-email").value == "") {
		error += 1;
		document.getElementById("err-box-email").style.display = "";
	}
	if (document.getElementById("box-telefono").value == "") {
		error += 1;
		document.getElementById("err-box-telefono").style.display = "";
	}

	if (error == 0) {
		dataString = "nombre=" + encodeURIComponent(document.getElementById("box-nombre").value) +
			"&apellidos=" + encodeURIComponent(document.getElementById("box-apellidos").value) +
			"&email=" + encodeURIComponent(document.getElementById("box-email").value) +
			"&telefono=" + encodeURIComponent(document.getElementById("box-telefono").value) +
			"&check=" + encodeURIComponent(document.getElementById("check-permisos").checked);
		$.ajax({
			type: "POST",
			url: "_edituser.php",
			data: dataString,
			success: function (response) {
				$('#datos-personales').offcanvas("hide");
				$('#confirma-datos-personales').modal("show");
			}
		});
	}
}

function checkForm2() {
	var error = 0;

	if (document.getElementById("box-email2").value == "") {
		error += 1;
		document.getElementById("err-box-email2").style.display = "";
	}

	if (error == 0) {
		dataString = 
			"&email=" + encodeURIComponent(document.getElementById("box-email2").value);
		$.ajax({
			type: "POST",
			url: "_editusermail.php",
			data: dataString,
			success: function (response) {
				openMembership4();
			}
		});
	}
}

function checkForm3() {
	var error = 0;

	//Cupón 19 de enero
	if (document.getElementById("box-club").value != "IMACOM0123") {
		error += 1;
		document.getElementById("err-box-club").style.display = "";
	}

	if (error == 0) {
		dataString = 
			"&club=2";
		$.ajax({
			type: "POST",
			url: "_edituserclub.php",
			data: dataString,
			success: function (response) {
				openMembership6();
			}
		});
	}
}

function checkForm4() {
	var error = 0;

	if (document.getElementById("box-email3").value == "") {
		error += 1;
		document.getElementById("err-box-email3").style.display = "";
	}

	if (error == 0) {
		dataString = 
			"&email=" + encodeURIComponent(document.getElementById("box-email3").value);
		$.ajax({
			type: "POST",
			url: "_editusermail.php",
			data: dataString,
			success: function (response) {
				openMembership10();
			}
		});
	}
}

function openSendTrue() {
	$("#correctSend").offcanvas("show");
}

function openSendFalse() {

	$("#incorrectSend").offcanvas("show");
}

function checkFormValoracion() {
	dataString = "app=" + encodeURIComponent(document.getElementById("rango-app").value) +
		"&contenidos=" + encodeURIComponent(document.getElementById("rango-contenidos").value) +
		"&precio=" + encodeURIComponent(document.getElementById("rango-precio").value) +
		"&verbatim=" + encodeURIComponent(document.getElementById("texto-verbatim").value);
	$.ajax({
		type: "POST",
		url: "_addvaloracionapp.php",
		data: dataString,
		success: function (response) {
			$('#pagina-valoracion').offcanvas("hide");
			$('#confirma-pagina-valoracion').modal("show");
		}
	});
}

function login(FBUser, l, v) {

	//Sacar dispositivo movil y sistema operativo
	var parser = new UAParser();
	var result = parser.getResult();
	var sistemaOperativo = result.os.name + " " + result.os.version;
	var esDispositivoMovil = ["Android", "iOS"].includes(result.os.name) ? "Si" : "No";

	fetch("./_login.php", {
		method: "POST",
		body: JSON.stringify({
			"uid": FBUser.uid,
			"nombre": FBUser.displayName,
			"email": FBUser.email,
			"foto": FBUser.photoURL,
			"telefono": FBUser.phoneNumber,
			"provider": FBUser.providerData[0].providerId,
			"l": l,
			"sistema_operativo": sistemaOperativo,
			"dispositivo_movil": esDispositivoMovil
		}),
		headers: {
			'Content-Type': 'application/json'// AQUI indicamos el formato
		}
	})
		.then(response => response.text())
		.then(data => {
			var sBrowser, sUsrAg = navigator.userAgent;

			if (sUsrAg.indexOf("Chrome") > -1) {
				sBrowser = "1";
			} else if (sUsrAg.indexOf("Safari") > -1) {
				sBrowser = "2";
			} else if (sUsrAg.indexOf("Opera") > -1) {
				sBrowser = "3";
			} else if (sUsrAg.indexOf("Firefox") > -1) {
				sBrowser = "4";
			} else if (sUsrAg.indexOf("MSIE") > -1) {
				sBrowser = "5";
			}

			if (sBrowser == 2) {
				if (navigator.geolocation) goContents(); else goContents(false);
			} else {
				//alert("p");
				navigator.permissions.query({ name: 'geolocation' })
				.then(function (result) {
					if (result.state == 'prompt') {
						if (v == 1) {
							$("#askGeo").modal('show');
						} else {
							cambiarVisual(2, l);
						}
					} else if (result.state == 'granted') {
						if (v == 1) {
							if (navigator.geolocation) goContents(); else goContents(false);
						} else {
							goContents(false);
						}
					} else if (result.state == 'denied') {
						goContents(false);
					}
				})
				.catch(function (error) {
					console.log("Error al pedir los permisos de navegación: ", error);
					goContents(false);
				})
			}
		});
}

function loginAnonimo(l, v) {
		//Sacar dispositivo movil y sistema operativo
	var parser = new UAParser();
	var result = parser.getResult();
	var sistemaOperativo = result.os.name + " " + result.os.version;
	var esDispositivoMovil = ["Android", "iOS"].includes(result.os.name) ? "Si" : "No";

	if (navidad==1){
		fetch("./_login.php", {
			method: "POST",
			body: JSON.stringify({
				"uid": "anonimo",
				"nombre": "Imageener",
				"email": "imageener@imageen.net",
				"foto": "https://app.imageen.net/imagenes/Avatar barbaN.png",
				"telefono": "555555555",
				"provider": "anonimo",
				"l": l,
				"sistema_operativo": sistemaOperativo,
				"dispositivo_movil": esDispositivoMovil
			}),
			headers: {
				'Content-Type': 'application/json'// AQUI indicamos el formato
			}
		})
			.then(response => response.text())
			.then(data => {
				var sBrowser, sUsrAg = navigator.userAgent;
	
				if (sUsrAg.indexOf("Chrome") > -1) {
					sBrowser = "1";
				} else if (sUsrAg.indexOf("Safari") > -1) {
					sBrowser = "2";
				} else if (sUsrAg.indexOf("Opera") > -1) {
					sBrowser = "3";
				} else if (sUsrAg.indexOf("Firefox") > -1) {
					sBrowser = "4";
				} else if (sUsrAg.indexOf("MSIE") > -1) {
					sBrowser = "5";
				}
	
				if (sBrowser == 2) {
					if (navigator.geolocation) goContents(); else goContents(false);
				} else {
					// Revisión de navegador de facebook o instagram para carga en su webview ya sea en android o en iOS sin problemas
					if (!navigator.userAgent.includes("Instagram") && !navigator.userAgent.includes("FBAN") && !navigator.userAgent.includes("FBAV")) {
						//alert("p");
						navigator.permissions.query({ name: 'geolocation' })
						.then(function (result) {
							if (result.state == 'prompt') {
								if (v == 1) {
									getLocation();
									//$("#askGeo").modal('show');	
								} else {
									cambiarVisual(2, l);
								}
							} else if (result.state == 'granted') {
								if (v == 1) {
									if (navigator.geolocation) goContents(); else goContents(false);
								} else {
									goContents(false);
								}
							} else if (result.state == 'denied') {
								goContents(false);
							}
						})
						.catch(function (error) {
							console.log("Error al pedir los permisos de navegación: ", error);
							goContents(false);
						})
					}
					else {
						goContents(false);
					}
				}
			});
	}else{
		fetch("./_login.php", {
			method: "POST",
			body: JSON.stringify({
				"uid": "anonimo",
				"nombre": "Imageener",
				"email": "imageener@imageen.net",
				"foto": "https://app.imageen.net/imagenes/Avatar barba.png",
				"telefono": "555555555",
				"provider": "anonimo",
				"l": l,
				"sistema_operativo": sistemaOperativo
			}),
			headers: {
				'Content-Type': 'application/json'// AQUI indicamos el formato
			}
		})
			.then(response => response.text())
			.then(data => {
				var sBrowser, sUsrAg = navigator.userAgent;
	
				if (sUsrAg.indexOf("Chrome") > -1) {
					sBrowser = "1";
				} else if (sUsrAg.indexOf("Safari") > -1) {
					sBrowser = "2";
				} else if (sUsrAg.indexOf("Opera") > -1) {
					sBrowser = "3";
				} else if (sUsrAg.indexOf("Firefox") > -1) {
					sBrowser = "4";
				} else if (sUsrAg.indexOf("MSIE") > -1) {
					sBrowser = "5";
				}
	
				if (sBrowser == 2) {
					if (navigator.geolocation) goContents(); else goContents(false);
				} else {
					// Revisión de navegador de facebook o instagram para carga en su webview ya sea en android o en iOS sin problemas
					if (!navigator.userAgent.includes("Instagram") && !navigator.userAgent.includes("FBAN") && !navigator.userAgent.includes("FBAV")) {
						//alert("p");
						navigator.permissions.query({ name: 'geolocation' })
						.then(function (result) {
							if (result.state == 'prompt') {
								if (v == 1) {
									getLocation();
									//$("#askGeo").modal('show');	
								} else {
									cambiarVisual(2, l);
								}
							} else if (result.state == 'granted') {
								if (v == 1) {
									if (navigator.geolocation) goContents(); else goContents(false);
								} else {
									goContents(false);
								}
							} else if (result.state == 'denied') {
								goContents(false);
							}
						})
						.catch(function (error) {
							console.log("Error al pedir los permisos de navegación: ", error);
							goContents(false);
						})
					}
					else {
						goContents(false);
					}
				}
			});
	}
}


function showWithPosition(position) {

	var dataString = "";
	$.ajax({
		type: "POST",
		url: "_getCustomer.php",
		async: false,
		data: dataString,
		success: function (data) {
			var jsonData = JSON.parse(data);
			customer = jsonData.message0;
			latitud_cliente = parseFloat(jsonData.message1);
			longitud_cliente = parseFloat(jsonData.message2);
			zoom_cliente = parseFloat(jsonData.message3);
		}
	});

	latitud_centro = position.coords.latitude;
	longitud_centro = position.coords.longitude;
	//zoom_centro = 10;
	zoom_centro = 6;


	const urlParams = new URLSearchParams(window.location.search);
	if (urlParams.has('v')) {
		var dataString = "";
		$.ajax({
			type: "POST",
			url: "_getCity.php?v=" + urlParams.get('v'),
			async: false,
			data: dataString,
			success: function (data) {
				var jsonData = JSON.parse(data);
				ciudad = jsonData.message0;
				latitud_centro = parseFloat(jsonData.message1);
				longitud_centro = parseFloat(jsonData.message2);
				zoom_centro = 13;
			}
		});
	}


	var map;

	if (customer == null) {

		map = new google.maps.Map(document.getElementById("map"), {
			center: { lat: latitud_centro, lng: longitud_centro },
			zoom: zoom_centro,
			mapId: "68a191843ca59b75",//"8819c0f19a42bdec",//"a09bef3d947f314a", //"c5aad8c7bc9f7049",
			//mapTypeId: 'satellite',
			scaleControl: false,
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			fullscreenControl: false,
			fullscreenControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position: google.maps.ControlPosition.LEFT_TOP,
			},
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.RIGHT_CENTER,
			},
			gestureHandling: "greedy",
		});

		var marker = new google.maps.Marker({ position: { lat: position.coords.latitude, lng: position.coords.longitude }, map: map })
	} else {
		if (latitud_cliente == '') {
			latitud_cliente = latitud_centro;
			longitud_cliente = longitud_centro;
		}
		map = new google.maps.Map(document.getElementById("map"), {
			center: { lat: latitud_cliente, lng: longitud_cliente },
			zoom: zoom_cliente,
			mapId: "68a191843ca59b75",//"8819c0f19a42bdec",//"a09bef3d947f314a", //"c5aad8c7bc9f7049",
			//mapTypeId: 'satellite',
			scaleControl: false,
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			fullscreenControl: false,
			fullscreenControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position: google.maps.ControlPosition.LEFT_TOP,
			},
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.RIGHT_CENTER,
			},
			gestureHandling: "greedy",
		});
		var marker = new google.maps.Marker({ position: { lat: position.coords.latitude, lng: position.coords.longitude }, map: map })
	}

	var myLat = position.coords.latitude;
	var myLng = position.coords.longitude;
	map.centro = { lat: myLat, lng: myLng };
	const centerControlDiv = document.createElement("div");
	CenterControl(centerControlDiv, map);
	map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(centerControlDiv);

	var markers = [];
	for (var i = 0; i < data.points.length; i++) {
		var dataPoints = data.points[i];
		var latLng = new google.maps.LatLng(dataPoints.latitud, dataPoints.longitud);
		var nombre = dataPoints.nombre;
		var nombreb = nombre.replace(/~/g, "'");
		var categoria = dataPoints.categoria;
		var tipo = dataPoints.tipo;
		var descripcion = dataPoints.descripcion;
		if (descripcion != '') {
			var descripcionb = descripcion.replace(/~/g, "'");
		} else {
			var descripcionb = '';
		}
		var link = dataPoints.link;
		var codigo = dataPoints.codigo;
		var imagen = dataPoints.imagen;
		var cliente = dataPoints.cliente;
		var idioma = dataPoints.idioma;
		var contenidos = dataPoints.contenidos;
		var icono = dataPoints.icono;
		var iconog = dataPoints.iconog;
		var direccion = dataPoints.direccion;
		if (direccion != '') {
			var direccionb = direccion.replace(/~/g, "'");
		} else {
			var direccionb = '';
		}

		var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
			new google.maps.LatLng({
				lat: dataPoints.latitud,
				lng: dataPoints.longitud
			}),
			new google.maps.LatLng({
				lat: myLat,
				lng: myLng
			})
		);

		var distance = parseInt(distanceInMeters)
		distance = distance / 1000;
		distance = distance.toFixed(2);
		distance = String(distance);
		distance = distance.replace(".", ",");

		if (tipo == '0') { //POI Imageen
			var marker = new google.maps.Marker({ map: map, //title: nombreb, label: { text: nombreb, color: "#2765A0", fontFamily: "'Raleway', sans-serif", fontWeight: "bold" }, 
			position: latLng, icon: { url: rutaAdmin + "/data/imagenes/" + icono, labelOrigin: { x: 18, y: 40 } }, animation: "DROP" });
			marker.parametros = { "codigo": codigo, "imagen": imagen, "cliente": cliente, "nombre": nombreb, "distancia": distance, "materiales": contenidos, "descripcion": descripcionb, "icono": iconog, "direccion": direccion, "tipo": "imageen" };

		} else { // POI cliente
			var marker = new google.maps.Marker({ map: map, //title: nombreb, 
			position: latLng, icon: { url: rutaAdmin + "/data/imagenes/" + icono, labelOrigin: { x: 18, y: 40 } } });
			marker.parametros = { "codigo": codigo, "imagen": imagen, "cliente": cliente, "nombre": nombreb, "distancia": distance, "materiales": contenidos, "descripcion": direccionb, "icono": iconog, "direccion": direccion, "tipo": "cliente", "localizacion": link };
		}

		google.maps.event.addListener(marker, 'click', function () {

		//TODO: Bypass mapa en caso de geolocalización para más adelante
		//if (cliente == ''){
			//loadContents(this.parametros);
		//}else{
			showInfoBox(this.parametros);
		//}

		});
		markers.push(marker);
	}
	var markerCluster = new markerClusterer.MarkerClusterer({ map: map, markers: markers, imagePath: './imagenes/m', gridSize: 30 });
	deleteMapPosition();
}

function CenterControl(controlDiv, map) {
	const controlUI = document.createElement("div");

	controlUI.style.backgroundColor = "#fff";
	controlUI.style.border = "2px solid #fff";
	controlUI.style.borderRadius = "3px";
	controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
	controlUI.style.cursor = "pointer";
	controlUI.style.margin = "10px";
	controlUI.style.paddingTop = "7px";
	controlUI.style.textAlign = "center";
	controlUI.title = "Click para centrar en tu posición";
	controlUI.style.height = "38px";
	controlUI.style.width = "38px";
	controlDiv.appendChild(controlUI);

	const controlText = document.createElement("div");

	controlText.style.color = "rgb(25,25,25)";
	controlText.style.fontFamily = "Roboto,Arial,sans-serif";
	controlText.style.fontSize = "16px";
	//controlText.style.lineHeight = "38px";		
	controlText.style.paddingLeft = "5px";
	controlText.style.paddingRight = "5px";
	controlText.innerHTML = "<i class='ri-focus-3-line ri-lg align-middle'></i>";
	controlUI.appendChild(controlText);

	controlUI.addEventListener("click", () => {
		map.panTo(map.centro);
	});

}

function showWithoutPosition() {
	var dataString = "";
	$.ajax({
		type: "POST",
		url: "_getCustomer.php",
		async: false,
		data: dataString,
		success: function (data) {
			var jsonData = JSON.parse(data);
			customer = jsonData.message0;
			latitud_cliente = parseFloat(jsonData.message1);
			longitud_cliente = parseFloat(jsonData.message2);
			zoom_cliente = parseFloat(jsonData.message3);
		}
	});

	// Centro de España
	latitud_centro = 40.239748;
	longitud_centro = -4.239292;
	zoom_centro = 6;

	const urlParams = new URLSearchParams(window.location.search);
	if (urlParams.has('v')) {
		var dataString = "";
		$.ajax({
			type: "POST",
			url: "_getCity.php?v=" + urlParams.get('v'),
			async: false,
			data: dataString,
			success: function (data) {
				var jsonData = JSON.parse(data);
				ciudad = jsonData.message0;
				latitud_centro = parseFloat(jsonData.message1);
				longitud_centro = parseFloat(jsonData.message2);
				zoom_centro = 13;
			}
		});
	}


	var map;

	if (customer == null) {
		map = new google.maps.Map(document.getElementById("map"), {
			center: { lat: latitud_centro, lng: longitud_centro },
			zoom: zoom_centro,
			mapId: "68a191843ca59b75",//"8819c0f19a42bdec",//"a09bef3d947f314a", //"c5aad8c7bc9f7049",
			//mapTypeId: 'satellite',
			scaleControl: false,
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			fullscreenControl: false,
			fullscreenControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position: google.maps.ControlPosition.LEFT_TOP,
			},
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.RIGHT_CENTER,
			},
			gestureHandling: "greedy",
		});

	} else {
		if (latitud_cliente == '') {
			latitud_cliente = latitud_centro;
			longitud_cliente = longitud_centro;
		}
		map = new google.maps.Map(document.getElementById("map"), {
			center: { lat: latitud_cliente, lng: longitud_cliente },
			zoom: zoom_cliente,
			mapId: "68a191843ca59b75",//"8819c0f19a42bdec",//"a09bef3d947f314a", //"c5aad8c7bc9f7049",
			//mapTypeId: 'satellite',
			scaleControl: false,
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			fullscreenControl: false,
			fullscreenControlOptions: {
				position: google.maps.ControlPosition.TOP_LEFT,
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position: google.maps.ControlPosition.LEFT_TOP,
			},
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.RIGHT_CENTER,
			},
			gestureHandling: "greedy",
		});
	}

	var markers = [];
	for (var i = 0; i < data.points.length; i++) {
		var dataPoints = data.points[i];
		var latLng = new google.maps.LatLng(dataPoints.latitud, dataPoints.longitud);
		var nombre = dataPoints.nombre;
		var nombreb = nombre.replace(/~/g, "'");
		var categoria = dataPoints.categoria;
		var tipo = dataPoints.tipo;
		var descripcion = dataPoints.descripcion;
		if (descripcion != '') {
			var descripcionb = descripcion.replace(/~/g, "'");
		} else {
			var descripcionb = '';
		}
		var link = dataPoints.link;
		var codigo = dataPoints.codigo;
		var imagen = dataPoints.imagen;
		var cliente = dataPoints.cliente;
		var idioma = dataPoints.idioma;
		var contenidos = dataPoints.contenidos;
		var icono = dataPoints.icono;
		var iconog = dataPoints.iconog;
		var direccion = dataPoints.direccion;
		if (direccion != '') {
			var direccionb = direccion.replace(/~/g, "'");
		} else {
			var direccionb = '';
		}

		if (tipo == '0') {
			var marker = new google.maps.Marker({ map: map, //title: nombreb, label: { text: nombreb, color: "#2765A0", fontFamily: "'Raleway', sans-serif", fontWeight: "bold" },
			 position: latLng, icon: { url: rutaAdmin + "/data/imagenes/" + icono, labelOrigin: { x: 18, y: 40 } }, animation: "DROP" });
			marker.parametros = { "codigo": codigo, "imagen": imagen, "cliente": cliente, "nombre": nombreb, "distancia": null, "materiales": contenidos, "descripcion": descripcionb, "icono": iconog, "direccion": direccion };
		} else {
			var marker = new google.maps.Marker({ map: map, //title: nombreb,
			 position: latLng, icon: { url: rutaAdmin + "/data/imagenes/" + icono, labelOrigin: { x: 18, y: 40 } } });
			//TODO: Revisar correccion.  Anterior version: marker.parametros = { "codigo": codigo, "imagen": imagen, "cliente": cliente, "nombre": nombreb, "distancia": null, "materiales": contenidos, "descripcion": direccionb, "icono": iconog };
			marker.parametros = { "codigo": codigo, "imagen": imagen, "cliente": cliente, "nombre": nombreb, "distancia": null, "materiales": contenidos, "descripcion": direccionb, "icono": iconog,"direccion": direccion, "tipo": "cliente", "localizacion": link};
		}

		
		google.maps.event.addListener(marker, 'click', function () {
		//TODO: Bypass mapa en caso de no geolocalización para más adelante
		//if (tipo == ''){
			//loadContents(this.parametros);
		//}else{
			//loadPoint(this.parametros);
			showInfoBox(this.parametros);

		//}
		});

		markers.push(marker);
	}
	var markerCluster = new markerClusterer.MarkerClusterer({ map: map, markers: markers, imagePath: './imagenes/m', gridSize: 30 });
	deleteMapPosition();
}

$(document).ready(function() {
	// Mostrar el fondo oscuro al abrir el modal
	$('#modalPremium').on('show.bs.modal', function() {
	  $('.modal-background').addClass('show');
	});
  
	// Ocultar el fondo oscuro al cerrar el modal
	$('#modalPremium').on('hidden.bs.modal', function() {
	  $('.modal-background').removeClass('show');
	});
  });
//new features -- funciones que se encargan de hacer un post para mostrar los parametros en ?section=ficha
function showInfoBox(parametros) {
	//console.log("showInfoBox called with", parametros);
    $.ajax({
        type: "POST",
        url: "info_box.php",
        data: parametros,
        success: function (data) {
            $("#info-box").html(data);
            $("#info-box").show();
        }
    });
}
function showFicha(parametros) {
    //console.log("showFicha called with", parametros);
    $.ajax({
        type: "POST",
        url: "_search_contents.php",
        data: parametros,
        success: function () {
            // Cambiar la ubicación a ?section=ficha
            window.location.href = "?section=ficha";
        }
    });
}
function showListado(parametros) {
    //console.log("showListado called with", parametros);
    $.ajax({
        type: "POST",
        url: "list.php",
        data: parametros,
        success: function () {
            // Cambiar la ubicación a ?section=ficha
            window.location.href = "?section=ficha";
        }
    });
}
//ocultar el cuadro de informacion de google maps
function ocultarInfoBox() {
	$('#info-box', window.parent.document).css('display', 'none');
}
//function loadPoint(data) {
//	gtag('event', 'page_view', { 'page_title': data['nombre'], 'page_location': '/loadPoint/' + data['nombre'] });
//	$("#content_point").load("./_load_point.php", data);
//	$("#pointx").modal("show");
//}

function deleteMapPosition() {
	if (document.getElementById("map")) {
		document.getElementById("map").style.removeProperty('position');
	}
}

function deleteMapPosition2() {
	if (document.getElementById("map2")) {
		document.getElementById("map2").style.removeProperty('position');
	}
}

function getLocation() {
	if (navigator.geolocation) goContents(); else goContents(false);
}

function isGeolocation(l) {
	var sBrowser, sUsrAg = navigator.userAgent;

	if (sUsrAg.indexOf("Chrome") > -1) {
		sBrowser = "1";
	} else if (sUsrAg.indexOf("Safari") > -1) {
		sBrowser = "2";
	} else if (sUsrAg.indexOf("Opera") > -1) {
		sBrowser = "3";
	} else if (sUsrAg.indexOf("Firefox") > -1) {
		sBrowser = "4";
	} else if (sUsrAg.indexOf("MSIE") > -1) {
		sBrowser = "5";
	}

	//alert("Browser: " + sBrowser);				
	if (sBrowser == "2") {
		if (navigator.geolocation) goContents(); else goContents(false);
	} else {
		navigator.permissions.query({ name: 'geolocation' }).then(function (result) {
			// Will return ['granted', 'prompt', 'denied']
			if (result.state == "prompt") {
				$("#askGeo").modal('show');
			} else if (result.state == 'granted') {
				goContents();
			} else {
				if (l == 1) {
					cTxt1 = "¡Geolocalización denegada!";
					cTxt2 = "Esta aplicación tiene la geolocalización denegada en tu navegador. Para reactivarla, por favor, elimina todos los permisos de esta aplicación en tu navegador, en la sección Privacidad/Permisos";
				} else if (l == 2) {
					cTxt1 = "Geolocation denied!";
					cTxt2 = "This application has geolocation denied in your browser. To reactivate it, please remove all the permissions of this application in your browser, in the Privacy / Permissions section";
				} else if (l == 3) {
					cTxt1 = "Géolocalisation refusée!";
					cTxt2 = "Cette application a la géolocalisation refusée dans votre navigateur. Pour la réactiver, veuillez supprimer toutes les autorisations de cette application dans votre navigateur, dans la section Confidentialité / Autorisations";
				} else if (l == 4) {
					cTxt1 = "Geolocalització denegada!";
					cTxt2 = "Aquesta aplicació té la geolocalització denegada al teu navegador. Per reactivar-la, si us plau, elimina tots els permisos d'aquesta aplicació al navegador, a la secció Privacitat / Permisos";
				}
				Swal.fire(cTxt1, cTxt2, "warning")
					.then((value) => { goContents(false); });
			}
		})
	}
}

function showError(error) {
	switch (error.code) {
		case error.PERMISSION_DENIED:
			console.log("Permiso denegado");
			goContents(false);
			break;
		case error.POSITION_UNAVAILABLE:
			console.log("Posición no disponible");
			goContents(false);
			break;
		case error.TIMEOUT:
			console.log("Posición no disponible por timeout");
			goContents(false);
			break;
		case error.UNKNOWN_ERROR:
			console.log("Posición no disponible por error");
			goContents(false);
			break;
	}
}

function clickSuscripcion(suscripcion) {
	var nuevaSeleccionada = "ficha-sus-" + suscripcion;
	var elementos = document.getElementsByClassName("ficha-suscripcion-seleccionada");
	elementos[0].className = "ficha-suscripcion";
	document.getElementById(nuevaSeleccionada).className = "ficha-suscripcion-seleccionada";
}

function clickSuscripcion2(suscripcion) {
	var nuevaSeleccionada = "ficha-sus2-" + suscripcion;
	var elementos = document.getElementsByClassName("ficha-suscripcion2-seleccionada");
	elementos[0].className = "ficha-suscripcion2";
	document.getElementById(nuevaSeleccionada).className = "ficha-suscripcion2-seleccionada";
}

function goToCheckout(URLCheckout) {
	var elementos = document.getElementsByClassName("ficha-suscripcion-seleccionada");
	const form = document.createElement('form');
	form.method = 'POST';
	form.action = URLCheckout;
	const hiddenField = document.createElement('input');
	hiddenField.type = 'hidden';
	hiddenField.name = 'suscripcion';
	hiddenField.value = elementos[0].dataset.stripe;
	form.appendChild(hiddenField);
	document.body.appendChild(form);
	form.submit();
}

function goToCheckout2(URLCheckout) {
	var elementos = document.getElementsByClassName("ficha-suscripcion2-seleccionada");
	const form = document.createElement('form');
	form.method = 'POST';
	form.action = URLCheckout;
	const hiddenField = document.createElement('input');
	hiddenField.type = 'hidden';
	hiddenField.name = 'suscripcion';
	hiddenField.value = elementos[0].dataset.stripe;
	form.appendChild(hiddenField);
	document.body.appendChild(form);
	form.submit();
}

function sizemap() {
	var x = screen.height;
	var map = document.getElementById('map');
	if(x != null && map != null){
		map.style.height = x + 'px';
	}
}

function sizemap2() {
	var x = screen.height;
	document.getElementById('map2').style.height = (x - 180) + 'px';
}

function dfile(f) {
	if (f != '') {
		post_data = { 'f': f };
		$.post('_dele_file_map.php', post_data);
	}
}

function changeLng(l, l2) {
	var dataString = "l=" + l + "&l2=" + l2;
	$.ajax({
		type: "POST",
		url: "_changelng.php",
		data: dataString,
		success: function (data) {
			goContents();
		}
	});
}
  
function cambiarSwitch(v, l) {
	var dataString = "v=" + v;
	$.ajax({
		type: "POST",
		url: "_changevisual.php",
		data: dataString,
		success: function (data) {
			if (v == 2) {
				document.getElementById("modo-listado-checkbox").checked = true;
				document.getElementById("modo-mapa-checkbox").checked = false;
				goContents();
			} else {
				document.getElementById("modo-listado-checkbox").checked = false;
				document.getElementById("modo-mapa-checkbox").checked = true;
				isGeolocation(l);
			}
		}
	});
}

//Get CONTENTS function modificaa la urlSearchParams para poder redirigir al mapa
function goContents(localizacion = true) {
	const urlParams = new URLSearchParams();
	if (!localizacion) {
	  urlParams.append("t", "3");
	}
	if (urlParams.toString() != '') location.href = "contents.php?" + urlParams.toString();
	else location.href = "contents.php";
  }
//function loadPoint(data) {
//	gtag('event', 'page_view', { 'page_title': data['nombre'], 'page_location': '/loadPoint/' + data['nombre'] });
//	$("#content_point").load("./_load_point.php", data);
//	$("#pointx").modal("show");
//}

function loadPointBD(codigo) {
	$("#content_point").load("./_load_point_bd.php", { "codigo": codigo });
	$("#pointx").modal("show");
}

function loadContents(data) {
	$("#contents_list").load("./_load_content_point.php", data);
	$("#contentx").modal("show");
}

function loadContentsBD(media) {
	$("#contents_list").load("./_load_content_point_media.php", { "media": media });
	//$("#contentx").modal("show");
	$("#contents_list").load("./_load_content_point_bd.php", { "media": media });
}

function loadContentsBD2(media) {
	$("#acceso-no-autorizado").offcanvas("show");
	$("#contents_list").load("./_load_content_point_media.php", { "media": media });
	$("#contentx").modal("show");
}

function loadContentsBD3(media) {
	$("#acceso-no-autorizado-club").offcanvas("show");
	$("#contents_list").load("./_load_content_point_media.php", { "media": media });
	$("#contentx").modal("show");
}

function loadContentsBDMapList(media) {
	$("#contents_list").load("./_load_content_point_bd.php", { "media": media });
}

function loadContentsBDMapList2(media) {
	$("#acceso-no-autorizado").offcanvas("show");
	//mostramos el mapa
}

function loadContentsBDMapList3(media) {
	$("#acceso-no-autorizado-club").offcanvas("show");
	//mostramos el mapa
}

function loadContentsBDPointBD(media, codigo) {
	$("#content_point").load("./_load_point_bd.php", { "codigo": codigo });
	$("#pointx").modal("show");
	$("#contents_list").load("./_load_content_point_bd.php", { "media": media });
}

function loadContentsBDPointBD2(media, codigo) {
	$("#acceso-no-autorizado").offcanvas("show");
	$("#content_point").load("./_load_point_bd.php", { "codigo": codigo });
	$("#pointx").modal("show");
}

function loadContentsBDPointBD3(media, codigo) {
	$("#acceso-no-autorizado-club").offcanvas("show");
	$("#content_point").load("./_load_point_bd.php", { "codigo": codigo });
	$("#pointx").modal("show");
}

function loadGuide() {
	$("#guia-tutorial-frame").load("_loadguide.php");
}

function openMembership() {
	$('#datos-personales').offcanvas("hide");
	$("#membership").offcanvas("show");
}

function openMembership2() {
	$("#membership").offcanvas("show");
}

function openMembership3() {
	$("#datos-personales2").offcanvas("show");
}

function openMembership4() {
	$('#datos-personales2').offcanvas("hide");
	$("#membership").offcanvas("show");
}

function openMembership5() {
	$("#miembro-club").offcanvas("show");
}

function openMembership6() {
	$('#miembro-club').offcanvas("hide");
	$("#miembro-club-check").offcanvas("show");
}

function openMembership7() {
	$('#miembro-club').offcanvas("hide");
	$("#oferta-cupon").offcanvas("show");
}

function openMembership8() {
	$("#oferta-cupon").offcanvas("hide");
	$("#membership2").offcanvas("show");
}

function openMembership9() {
	$("#oferta-cupon").offcanvas("hide");
	$("#datos-personales3").offcanvas("show");
}

function openMembership10() {
	$('#datos-personales3').offcanvas("hide");
	$("#membership2").offcanvas("show");
}

function openLogin() {
	$("#login").offcanvas("show");
	setCookie("cliente", "1", 200);
}

function openLogin2() {
	$("#login").offcanvas("show");
	setCookie("cliente", "4", 200);
}

function searchtxt(t, l) {
	$("#results").load("_search_contents.php?" + jQuery.param({ t: t, l: l }));
}

var videoStartTime;
function addWatch(p, m, v, f, l, n, i, t, a) {
	videoStartTime = new Date();
	document.getElementById("puntuar").style.display = "none";
	$('#s1').attr('src', 'imagenes/star0.png');
	$('#s2').attr('src', 'imagenes/star0.png');
	$('#s3').attr('src', 'imagenes/star0.png');
	$('#s4').attr('src', 'imagenes/star0.png');
	$('#s5').attr('src', 'imagenes/star0.png');

	$("#p5").attr("onclick", "markPoints('" + p + "','" + m + "',5," + l + ",'" + n + "')");
	$("#p4").attr("onclick", "markPoints('" + p + "','" + m + "',4," + l + ",'" + n + "')");
	$("#p3").attr("onclick", "markPoints('" + p + "','" + m + "',3," + l + ",'" + n + "')");
	$("#p2").attr("onclick", "markPoints('" + p + "','" + m + "',2," + l + ",'" + n + "')");
	$("#p1").attr("onclick", "markPoints('" + p + "','" + m + "',1," + l + ",'" + n + "')");
	post_data = { 'p': p, 'm': m, 'v': v };
	gtag('event', 'page_view', { 'page_title': 'Vídeo ' + t, 'page_location': '/video/' + f });
	gtag('event', 'video_view', { 'event_category': t, 'event_label': f });

	$.post('_addwatch.php', post_data);
	

	var iframe = document.createElement('iframe');
	iframe.id = "video";
	iframe.class = "embed-responsive-item";
	iframe.style = 'position:absolute; top:0; left:0; width:100%; height:100%;';
	iframe.name = 'TOUR NAME';
	iframe.width = '100%';
	iframe.height = '100%';
	iframe.frameborder = '0';
	iframe.allowfullscreen = 'true';
	iframe.allow = 'fullscreen; accelerometer; gyroscope; magnetometer; vr; xr; xr-spatial-tracking; autoplay; camera; microphone';
	document.getElementById("padreiframe").appendChild(iframe);


	$("#v3dvista").modal("show");
	if (i) {
		$("#instrucciones_texto").html(i);
		$("#instrucciones").modal("show");
		$("#instrucciones").on("hidden.bs.modal", function () {
			console.debug("modal cerrada");
			arrancaVideo(RutaMedia + '/' + f + '/index.htm');
		});
	}
	else {
		arrancaVideo(RutaMedia + '/' + f + '/index.htm');
	}

}
// Esta función se ejecutará cuando el usuario cierre el vídeo para controlar el tiempo que ha estado viéndolo
function closeVideo() {
    var videoEndTime = new Date();
    var timeSpent = videoEndTime - videoStartTime;  // Esto será en milisegundos

    // Convierte el tiempo gastado en minutos y segundos
    var totalSecondsSpent = Math.floor(timeSpent / 1000);  // Convierte milisegundos a segundos
    var minutesSpent = Math.floor(totalSecondsSpent / 60);  // Convierte segundos a minutos
    var secondsSpent = totalSecondsSpent % 60;  // Calcula los segundos restantes después de extraer los minutos

    console.log("Time spent: " + minutesSpent + " minutes and " + secondsSpent + " seconds");

    // Aquí debes hacer una solicitud AJAX para enviar este tiempo al servidor
    var data = { minutesSpent: minutesSpent, secondsSpent: secondsSpent, timeSpent: totalSecondsSpent};

    fetch('registrar_tiempo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


function arrancaVideo(f) {
	document.getElementById('video').src = f;
}

function markPoints(a, b, c, d, e) {
	$('#s1').attr('src', 'imagenes/star0.png');
	$('#s2').attr('src', 'imagenes/star0.png');
	$('#s3').attr('src', 'imagenes/star0.png');
	$('#s4').attr('src', 'imagenes/star0.png');
	$('#s5').attr('src', 'imagenes/star0.png');

	if (c == 1) {
		$('#s1').attr('src', 'imagenes/star1.png');
	} else if (c == 2) {
		$('#s1').attr('src', 'imagenes/star1.png');
		$('#s2').attr('src', 'imagenes/star1.png');
	} else if (c == 3) {
		$('#s1').attr('src', 'imagenes/star1.png');
		$('#s2').attr('src', 'imagenes/star1.png');
		$('#s3').attr('src', 'imagenes/star1.png');
	} else if (c == 4) {
		$('#s1').attr('src', 'imagenes/star1.png');
		$('#s2').attr('src', 'imagenes/star1.png');
		$('#s3').attr('src', 'imagenes/star1.png');
		$('#s4').attr('src', 'imagenes/star1.png');
	} else if (c == 5) {
		$('#s1').attr('src', 'imagenes/star1.png');
		$('#s2').attr('src', 'imagenes/star1.png');
		$('#s3').attr('src', 'imagenes/star1.png');
		$('#s4').attr('src', 'imagenes/star1.png');
		$('#s5').attr('src', 'imagenes/star1.png');
	}
	document.getElementById("puntuar").style.display = "";
	$("#puntuar").attr("onclick", "addPoints('" + a + "','" + b + "'," + c + "," + d + ",'" + e + "')");
}

function openPoints() {
	$('#video').attr('src', "");
	$('#video').remove();
	$('#v3dvista').modal('hide');
	$('#addpoints').modal('show');
	//TODO: Posibilidad de mostrar oferta del cupón o recopilación de contactos
	//$("#oferta-cuponb").offcanvas("show");
	//$("#recopilacion-contactos").offcanvas("show");
	
	//$('#valoraapp').modal('show');
}

function addPoints(p, m, x, l, n) {
	$('#s1').attr('src', 'imagenes/star0.png');
	$('#s2').attr('src', 'imagenes/star0.png');
	$('#s3').attr('src', 'imagenes/star0.png');
	$('#s4').attr('src', 'imagenes/star0.png');
	$('#s5').attr('src', 'imagenes/star0.png');
	var dataString = "m=" + m + '&p=' + p + '&x=' + x;
	$.ajax({
		type: "POST",
		url: "_addpoints.php",
		async: false,
		data: dataString,
		success: function (data) {
			if (l == 1) {
				cTxt1 = "¡Muchas gracias, " + n + "!";
				cTxt2 = "Tu puntuación nos ayuda a mejorar nuestros contenidos";
			} else if (l == 2) {
				cTxt1 = "Thanks so much, " + n + "!";
				cTxt2 = "Your score helps us improve our content";
			} else if (l == 3) {
				cTxt1 = "Merci beaucoup, " + n + "!";
				cTxt2 = "Votre score nous aide à améliorer notre contenu";
			} else if (l == 4) {
				cTxt1 = "Moltes gràcies, " + n + "!";
				cTxt2 = "La teva puntuació ens ajuda a millorar els nostres continguts";
			}
			Swal.fire(cTxt1, cTxt2, "success")
				.then((value) => { $('#addpoints').modal('hide'); });
		}
	});
}

function askClose(l, n) {
	if (l == 1) {
		cTxt1 = "¡Espera un momento, " + n + "!";
		cTxt2 = "La próxima vez que vengas a vernos accederás más rápido si no cierras la sesión ni borras las cookies. ¿Qué deseas hacer?";
		cRes1 = "No cerrar sesión";
		cRes2 = "Sí, quiero cerrar sesión";
		cDes1 = "Sesión cerrada. ¡Muchas gracias!";
	} else if (l == 2) {
		cTxt1 = "Just a moment, " + n + "!";
		cTxt2 = "The next time you come to see us, you will access faster if you do not close the session or delete the cookies. What do you want to do?";
		cRes1 = "Don't log out";
		cRes2 = "Yes, I want log out";
		cDes1 = "Session closed. Thank you so much!";
	} else if (l == 3) {
		cTxt1 = "Merci beaucoup, " + n + "!";
		cTxt2 = "La prochaine fois que vous viendrez nous voir, vous accéderez plus rapidement si vous ne fermez pas la session ou ne supprimez pas les cookies. Que veux-tu faire?";
		cRes1 = "Ne pas fermer la session";
		cRes2 = "Oui, je veux fermer la session";
		cDes1 = "Session fermé. Merçi beaucoup!";
	} else if (l == 4) {
		cTxt1 = "Espera un moment, " + n + "!";
		cTxt2 = "La propera vegada que vinguis a veure'ns accediràs més ràpid si no tanques la sessió ni esborres les cookies. Què vols fer?";
		cRes1 = "No tancar la sessió";
		cRes2 = "Sí, vull tancar la sessió";
		cDes1 = "Sessió tancada. Moltes gràcies!";
	}

	Swal.fire({
		title: cTxt1,
		text: cTxt2,
		icon: 'warning',
		showDenyButton: true,
		confirmButtonText: cRes2,
		denyButtonText: cRes1,
		confirmButtonColor: '#2765A0',
		denyButtonColor: '#646363',
	}).then((respuesta) => {
		if (respuesta.isConfirmed) {
			Swal.fire({
				text: cDes1,
				icon: "success",
				confirmButtonColor: '#2765A0',
			});
			setTimeout(function () {
				$.ajax({
					type: "POST",
					url: "_logout.php",
					data: "",
					success: function (data) {
						location.href = './default.php' + window.location.search;
					},
				});
			}, 3000);
		}
	});
}

function closePoint() {
	$("#pointx").modal("hide");
}

function onLoadDefault() {
	$.post("_showcookies.php", function (data) {
		console.log(data.retorno);
		retorno = data.retorno;
		if (retorno == 0) {
			$('#cookiesAlert').modal('show');
		}
		if (ui.isPendingRedirect()) {
			$('#spinnerBotonIniciarSesion').show();
			$('#botonIniciarSesion').attr("disabled", true);
			$('#textoBotonIniciarSesion').text("Accediendo...");
			try {
				ui.start('#firebaseui-auth-container', uiConfig);
			}
			catch (error) {
				console.error(error);
			}
		}
		/*// Pass your reCAPTCHA v3 site key (public key) to activate(). Make sure this
		// key is the counterpart to the secret key you set in the Firebase console.
		appCheck.activate(
			'6LfKl-ceAAAAAPorRFe3XPD_kPMdACFBNyFrcPNh',
			// Optional argument. If true, the SDK automatically refreshes App Check
			// tokens as needed.
			true);*/
	}, "json");
	window.addEventListener('beforeinstallprompt', (e) => {
		// Prevent Chrome 67 and earlier from automatically showing the prompt
		e.preventDefault();
	});
}

function saveCookie() {
	var dataString = "";
	$.ajax({
		type: "POST",
		url: "_savecookie.php",
		async: false,
		data: dataString,
		success: function (data) {
		}
	})
}

function onLoadContents(v, d, p, m, u, a) {
	var cliente= getCookie("cliente");
	if (cliente == 2) {
		if (u == 3) {
			openMembership2();
		}else{
			openMembership7();
		}		
		setCookie("cliente", "0", 200);
	} else if (cliente == 3) {
		if (u == 3) {
			openMembership3();
		}else{
			openMembership9();
		}
		setCookie("cliente", "0", 200);
	} else if (cliente == 5) {
		openMembership5();
		setCookie("cliente", "0", 200);
	} 

	var envio= getCookie("envio");
	if (envio == 1) {
		openSendTrue();
		setCookie("envio", "0", 200);
	} else {
		if (envio == 2) {
			openSendFalse();
			setCookie("envio", "0", 200);
		}else{
			setCookie("envio", "0", 200);
		}
	} 

	
	if (v == 1 && navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showWithPosition, showError);
		sizemap();
	} else if (v == 3) {
		showWithoutPosition();
		sizemap();
	}

	if (d) {
		$.ajax({
			type: "POST",
			url: "_changepidedatos.php",
			success: function (response) {
				$('#pide-datos-personales').modal("show");
			}
		});
	}
	/*appCheck.activate('6LfKl-ceAAAAAPorRFe3XPD_kPMdACFBNyFrcPNh', true);*/

	var sBrowser, sUsrAg = navigator.userAgent;

	if (sUsrAg.indexOf("Chrome") > -1) {
		sBrowser = "1";
	} else if (sUsrAg.indexOf("Safari") > -1) {
		sBrowser = "2";
	} else if (sUsrAg.indexOf("Opera") > -1) {
		sBrowser = "3";
	} else if (sUsrAg.indexOf("Firefox") > -1) {
		sBrowser = "4";
	} else if (sUsrAg.indexOf("MSIE") > -1) {
		sBrowser = "5";
	}

	if (sBrowser != 2) {
		window.addEventListener('beforeinstallprompt', (e) => {
			// Prevent Chrome 67 and earlier from automatically showing the prompt
			e.preventDefault();
			// Stash the event so it can be triggered later.
			deferredPrompt = e;
			// Update UI to notify the user they can add to home screen
			const addBtn = document.querySelector('.add-button');
			addBtn.style.display = 'block';

			if (Math.random() < 1 / 5) { //Una de cada 5 veces saca el tooltip de descargar la app
				const addBtnAnchor = document.querySelector('#add-button-anchor');
				var tooltip = bootstrap.Tooltip.getOrCreateInstance(addBtnAnchor);
				tooltip.show();
				setTimeout(function () {
					tooltip.hide()
				}, 10000);
			}

			addBtn.addEventListener('click', (e) => {
				// hide our user interface that shows our A2HS button
				addBtn.style.display = 'none';
				// Show the prompt
				deferredPrompt.prompt();
				// Wait for the user to respond to the prompt
				deferredPrompt.userChoice.then((choiceResult) => {
					if (choiceResult.outcome === 'accepted') {
						console.log('User accepted the A2HS prompt');
					} else {
						console.log('User dismissed the A2HS prompt');
					}
					deferredPrompt = null;
				});
			});
		});
	} else {
		const addBtnIos = document.querySelector('.add-button-ios');
		if (navigator.standalone && addBtnIos != null) {
			addBtnIos.style.display = 'none';
		} else if(addBtnIos != null) {
			addBtnIos.style.display = 'block';
			if (Math.random() < 1 / 5) { //Una de cada 5 veces saca el tooltip de descargar la app
				const addBtnAnchor = document.querySelector('#add-button-ios-anchor');
				var tooltip = bootstrap.Tooltip.getOrCreateInstance(addBtnAnchor);
				tooltip.show();
				setTimeout(function () {
					tooltip.hide()
				}, 10000);
			}
		}
	}
	if (m != ""){
		if (m) {
			if (p) {
				//Carga de contenido directo y salida en selector de medios especificado en barra de direcciones
				if (a>u){
					if (a==2){
						loadContentsBDPointBD3(m, p);
					}else{
						loadContentsBDPointBD2(m, p);
					}
				}else{
					loadContentsBDPointBD(m, p);
				}
			}else{
				if (m.includes('maplist')){
					const str = m;
					const newStr = str.substring(7);
					m=newStr;
					//Carga de contenido directo y salida a mapa o lista (se debe incluir delante del codigo material maplist)
					if (a>u){
						if (a==2){
							loadContentsBDMapList3(m);
						}else{
							loadContentsBDMapList2(m);
						}
					}else{
						loadContentsBDMapList(m);
					}
				}else{
					//Carga de contenido directo y salida en selector de medios del mismo punto
					if (a>u){
						if (a==2){
							loadContentsBD3(m);
						}else{
							loadContentsBD2(m);
						}
					}else{
						loadContentsBD(m);
					}
				}
			}
		}
	}else{
		//Carga de punto especificado en la barra de direcciones
		if (p) loadPointBD(p);
	}
}

function abreDatosPersonales() {
	$('#datos-personales').offcanvas("show");
}

function shareMedia() {
	$('#video').attr('src', "");
	$('#video').remove();
	$('#v3dvista').modal('hide');
	$('#share').modal('show');
}

function abrirVentana(url) {
	window.open(url, "Comparte IMAGEEN", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
}

function getCookie(cname) {
    var nameEQ = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) { var c = ca[i]; while (c.charAt(0)==' ') c = c.substring(1,c.length); if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length); } return null;
}

function saveCookie(){
	var dataString = "";
	$.ajax({
		type: "POST",
		url: "_savecookie.php",
		async: false,
		data: dataString,
		success: function(data) {
		}  
	})  
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
	//document.cookie = cname + "=" + cvalue + "; " + expires;
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

//TODO: Prueba copia
function copiarPortapapeles() {
	navigator.clipboard.writeText("hola");
}
