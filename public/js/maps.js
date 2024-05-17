let map;

  function initMap() {
    // Coordenadas do centro do mapa
    const myLatLng = { lat: -23.55052, lng: -46.633308 };

    // Opções do mapa
    const mapOptions = {
      zoom: 10,
      center: myLatLng,
    };

    // Criar o mapa dentro do contêiner com o ID "map"
    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Adicionar um marcador
    const marker = new google.maps.Marker({
      position: myLatLng,
      map,
      title: "Hello World!",
    });
  }
