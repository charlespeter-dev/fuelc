// $(document).ready(function(){
//   $('.store-container2').slick({
//     slidesToShow: 4,
//     slidesToScroll: 2,
//     centerMode: true,
//     focusOnSelect: true
//   });
// });

$('#search-btn').click(function(){
    event.preventDefault();
    // console.log($('#exampleInputEmail1').val());
  
    window.location.replace("mapbox/?add=" + $('#exampleInputEmail1').val()); 
   });
  
  
   function sideScrollv3(){
    const slider = document.querySelector(".slick-carousel-container");
    let isDown = false;
    let startX;
    let scrollLeft;
    
    slider.addEventListener("mousedown", e => {
      isDown = true;
      slider.classList.add("active");
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener("mouseleave", () => {
      isDown = false;
      slider.classList.remove("active");
    });
    slider.addEventListener("mouseup", () => {
      isDown = false;
      slider.classList.remove("active");
    });
    slider.addEventListener("mousemove", e => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = x - startX;
      slider.scrollLeft = scrollLeft - walk;
    });
  
  }
  sideScrollv3();
  
  function frontEndLogic(){
    $("body").on("click", ".holder", function(){
  
      if($(this).data('active') === 'true'){
        // console.log('drawer is active');
        $(this).data('active', 'false');
        $(this).removeClass('active');
  //       $(this).find('.drinks-list-container').addClass('hide');
     
        $(this).find('.arrow-icon').addClass('fa-chevron-circle-up');
        $(this).find('.arrow-icon').removeClass('fa-chevron-circle-down');
        $('.slick-carousel-container').removeClass('change-height');
      }else{
        globalClose();
        // console.log('drawer is closed');
        $(this).data('active', 'true');
        $(this).addClass('active');
  //       $(this).find('.drinks-list-container').removeClass('hide');
        $(this).find('.arrow-icon').addClass('fa-chevron-circle-down');
        $(this).find('.arrow-icon').removeClass('fa-chevron-circle-up');
        $(this).find('.title').html( );
        $('.slick-carousel-container').addClass('change-height');
      }
  
      function globalClose(){
        $('.holder').data('active','false');
        $('.holder').removeClass('active');
  //       $('.drinks-list-container').addClass('hide');
        $('.arrow-icon').addClass('fa-chevron-circle-up');
        $('.arrow-icon').addClass('fa-chevron-circle-down')
      }
    });
  
  }
  
  // function clickONMapLogic(itemID){
  //   let idName = '#num-'+itemID;
  //   console.log('id name :', idName)
  
  //   $('.holder').data('active','false');
  //   $('.holder').removeClass('active');
  // //   $('.drinks-list-container').addClass('hide');
  //   $('.arrow-icon').addClass('fa-chevron-circle-up');
  //   $('.arrow-icon').addClass('fa-chevron-circle-down')
  
  
  
  //   $(idName).data('active', 'true');
  //   $(idName).addClass('active');
  // //   $(idName).find('.drinks-list-container').removeClass('hide');
  //   $(idName).find('.arrow-icon').addClass('fa-chevron-circle-down');
  //   $(idName).find('.arrow-icon').removeClass('fa-chevron-circle-up');
  //  console.log($(idName).data('fullName'));
  //   $(idName).find('.title').html( );
  //   $('.slick-carousel-container').addClass('change-height');
  
  
  // }
  frontEndLogic();
  //! Load Map
  let currentLng = 37.7790262;
  let currentLat = -122.419906;
  
  
  
  // filter by search
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  let productFilter = urlParams.get('product');
  let AddressSearch = urlParams.get('add');
  
  
  if(productFilter ){
    className= '.'+productFilter.replace(/ /g,"_");
    $('.all-product').removeClass('act')
  $(className ).addClass('act');
  }
  
  // send a POST request
  // axios({
  //   method: 'post',
  //   url: 'https://maps.googleapis.com/maps/api/geocode/json?address=361+ogle+st+costa+mesa&key=AIzaSyBY_O-oEm5UedYRuanSEkdvFNnu_b_ITvk',
   
  // });
  
  
  if(AddressSearch){
  
    axios.post('https://maps.googleapis.com/maps/api/geocode/json?address='+AddressSearch+'&key=AIzaSyBY_O-oEm5UedYRuanSEkdvFNnu_b_ITvk',)
    .then((response) => {
      currentLat = response.data.results[0].geometry.location.lat
      currentLng = response.data.results[0].geometry.location.lng
  
      map.flyTo({
        center: [currentLng,  currentLat ]
        });
  
    }, (error) => {
      console.log('error :',error);
    });
  
  }else{
    // get current Location
  
    var result;
      
  function getPosition() {
      // Store the element where the page displays the result
      result = document.getElementById("result");
      
      // If geolocation is available, try to get the visitor's position
      if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {timeout:10000});
          result.innerHTML = "Getting the position information...";
      } else {
          alert("Sorry, your browser does not support HTML5 geolocation.");
      }
  };
  getPosition();
  // Define callback function for successful attempt
  function successCallback(position) {
      result.innerHTML = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
  
      currentLng = position.coords.longitude;
      currentLat = position.coords.latitude;
  
      map.flyTo({
        center: [currentLng,  currentLat ]
        });
      getDistsance(currentLng,  currentLat)
    }
  
  // Define callback function for failed attempt
  function errorCallback(error) {
      if(error.code == 1) {
          result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
      } else if(error.code == 2) {
          result.innerHTML = "The network is down or the positioning service can't be reached.";
      } else if(error.code == 3) {
          result.innerHTML = "The attempt timed out before it could get the location data.";
      } else {
          result.innerHTML = "Geolocation failed due to unknown error.";
      }
  }
  
  
  }
  
  
  
  // console.log('this is the url string', productFilter);
  
  
  // if null get direction
  
  
    mapboxgl.accessToken = 'pk.eyJ1IjoidGFjb3RydWNrYWQiLCJhIjoiY2tuaTFjaHQyMjY4dzJxbWlvc2trcDVpZyJ9.bbG7L07tN9VvMXxim7_2GQ';
    var map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/tacotruckad/ckrb62jtr08ft17k0llkxl7ff', // style URL
    center: [ currentLat , currentLng ], // starting position [lng, lat]
    zoom: 13, // starting zoom
    maxZoom: 13  
    });
  
  // VC - TTC
    map.on('load', () => { 
          // Adds Geocoder Search Field
    const geocoder = new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
      mapboxgl: mapboxgl,
        placeholder: 'Enter a location'
      });
  
      document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
    
    // Add zoom and rotation controls to the map.
      const nav = new mapboxgl.NavigationControl();
      map.addControl(nav, 'top-left');
  
  
    // disable map zoom when using scroll
      map.scrollZoom.disable();
        
    geocoder.on('result', ({ result }) => {
    const searchResult = result.geometry;
    
      const options = { units: 'miles' };
      for (const store of stores.features) {
        store.properties.distance = turf.distance(
          searchResult,
          store.geometry,
          options
        );
      }
      
    stores.features.sort((a, b) => {
    if (a.properties.distance > b.properties.distance) {
      return 1;
    }
    if (a.properties.distance < b.properties.distance) {
      return -1;
    }
    return 0; // a must be equal to b
  });
              
        const listings = document.getElementById('listings');
  while (listings.firstChild) {
    listings.removeChild(listings.firstChild);
  }
  buildLocationList(stores);
        
        if (properties.distance) {
    const roundedDistance = Math.round(properties.distance * 100) / 100;
    details.innerHTML += `<div><strong>${roundedDistance} miles away</strong></div>`;
  }
        
        const activeListing = document.getElementById(
    `listing-${stores.features[0].properties.id}`
  );
  activeListing.classList.add('active');
        
        
  });
        
    });
  
  
    /* 
  Add an event listener that runs
    when a user clicks on the map element.
  */
  
  // map.on('click', function(e) {
  //   console.log('hello world')
  //   // If the user clicked on one of your markers, get its information.
  //   var features = map.queryRenderedFeatures(e.point, {
  //     layers: ['jul-2021-locations'] // replace with your layer name
  //   });
  //   if (!features.length) {
  //     return;
  //   }
  //   var feature = features[0];
  
  //   // Code from the next step will go here.
  //   console.log('clickedid :', feature.id);
  
  //   clickONMapLogic(feature.id);
  // });
  
  
  map.on('load', function() {
   
  if(productFilter){
    map.setFilter('jul-2021-locations', ['==', productFilter , '1']);
  }
  
    // map.setFilter('jul-2021-locations', ['==', 'VODKA', '1']);
    setTimeout(function(){ 
      
      console.log( map.queryRenderedFeatures(point,{
        layers: ['jul-2021-locations'] // replace with your layer name
      }));
      let stores= map.queryRenderedFeatures({
        layers: ['jul-2021-locations'] // replace with your layer name
      });
      stores.forEach(element => generateCards(element));
     }, 1000);
   
  
   
  
  
    });
  
  
  
    map.on('zoom', function () {
      // $('.store-container2').html('');
  $('.slick-carousel-container'). addClass('hide');
  
  
  var timeoutHandle = window.setTimeout(function(){ 
    $('.slick-carousel-container').removeClass('hide');
   }, 600);
  
  
  window.clearTimeout(timeoutHandle);
  
  
  timeoutHandle = window.setTimeout(function(){ 
    $('.slick-carousel-container').removeClass('hide');
    // reset cards 
    $(".store-container2").html("");
  
    let stores= map.queryRenderedFeatures({
      layers: ['jul-2021-locations'] // replace with your layer name
    });
      console.log('VC - STORES', stores);
    stores.forEach(element => generateCards(element));
    // frontEndLogic();
   }, 600);
  
  
  
    });
  
  
  //   map.on('mousedown', function () {
  //     $(".store-container2").html("");
  //     $('.slick-carousel-container'). addClass('hide');
  //     });
       
  //     map.on('mouseup', function () {
  //       $('.slick-carousel-container').removeClass('hide');
  //       let stores= map.queryRenderedFeatures({
  //         layers: ['jul-2021-locations'] // replace with your layer name
  //       });
  //       stores.forEach(element => generateCards(element));
  //       // frontEndLogic();
  //     });
       
  
      
     function searchLocation(ele){
  
      if(event.key === 'Enter') {
        event.preventDefault();
        // alert(ele.value);       
  //       window.location.replace("mapbox/?add=" + ele.value);
  //       VC-TTC Replaced 
        window.history.replaceState(null, null, "?add=" + ele.value);
    }
      }
  
    //   $('.searchaddress').click(function(event) {
    //     event.preventDefault();
    //    console.log($('#exampleInputEmail1').val())
    // });
  
    
  
  // $("body").on("click", "#search-btn", function(){
  //   console.log('please work ');
  // }):
   
    // $('.searchaddress').click(function( event ) {
    //   event.preventDefault();
    //   console.log('sjkdbfhsaf hkjshfjkhsa')
    //   console.log($('#exampleInputEmail1').val())
    // });
  
      // $('#searchInput').keypress(function (e) {
      //   if (e.which == 13) {
      //     $('form#login').submit();
      //     return false;    //<---- Add this line
      //   }
      // });
  
  function generateCards(currentFeature){
     let StoreName = currentFeature.properties['Retail Accounts'];
    let ShortName = StoreName;
    let BlackcherryLine = currentFeature.properties['BOX BCHERRY'];
    let BOX_MANGO = currentFeature.properties['BOX MANGO'];
    let BOX_MOJITO = currentFeature.properties['BOX MOJITO'];
    let BOX_WATER = currentFeature.properties['BOX WATER'];
    let MIXER_BLOODY = currentFeature.properties['MIXER BLOODY'];
    let MIXER_MOJITO = currentFeature.properties['MIXER MOJITO'];
    let MIXER_VODKA = currentFeature.properties['MIXER VODKA'];
  
    let RUM = currentFeature.properties['RUM'];
    let SPICED= currentFeature.properties['SPICED'];
    let SPIKED_ICE = currentFeature.properties['SPIKED ICE'];
    let VODKA = currentFeature.properties['VODKA'];
      
  // VC-TTC ADDITION
    let StoreAddress = currentFeature.properties['Address'];
    let StoreCity = currentFeature.properties['City'];
  
  
    let card = `
    <div  class="store">
    <div id="num-${currentFeature.id}" class="holder">
        <div class="row title-container">
            <div class="col-7">
                <h2 class="title">
                    ${StoreName} 
                </h2>
                  <span>${StoreAddress} ${StoreCity}</span>
            </div>
            <div class="col-5">
                <p class="distance hide"> 12 MI</p>
                
                <a target="_blank" class="directions-link" href="https://www.google.com/maps?daddr=${currentFeature.properties['Address'] + ' ' + currentFeature.properties['City']}"><i class="fas fa-directions"></i><span class="directions-text">DIRECTIONS</span></a>
            </div>
        </div>
  
        <div class="drinks-list-container row  ">
            <div class="col-4 ${ SPICED ? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/spiced-rum@2x.png" alt="">
                <p class="product-name"> Spiced Rum </p>
            </div>
            <div class="col-4 ${ RUM? '' : 'hide'} ">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/white-rum@2x.png" alt="">
                <p class="product-name"> White Rum </p>
            </div>
            <div class="col-4 ${ VODKA? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/vodca@2x.png" alt="">
                <p class="product-name"> Organic Premium Vodka </p>
            </div>
  
            <div class="col-4 ${ BlackcherryLine? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/07/blackcherry-bottle-4.png"
                    alt="">
                <p class="product-name"> BLACK CHERRY LIMEADE</p>
            </div>
            <div class="col-4 ${ BOX_MANGO? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/05/boxtail_mango_hero.png"
                    alt="">
                <p class="product-name"> Mango Punch </p>
            </div>
            <div class="col-4 ${ BOX_MOJITO? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/05/boxtail_mojito_hero.png"
                    alt="">
                <p class="product-name"> Minted Mojito </p>
            </div>
  
            <div class="col-4 ${ BOX_WATER? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/05/box-copy-3.png" alt="">
                <p class="product-name"> Watermelon Tini </p>
            </div>
            <div class="col-4 hide">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/perfect-margarita.png" alt="">
                <p class="product-name"> Perfect Margarita </p>
            </div>
            <div class="col-4 ${ SPIKED_ICE? '' : 'hide'}" >
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/spiked-ice.png" alt="">
                <p class="product-name"> Spiked Ice </p>
            </div>
            <div class="col-4 ${ MIXER_VODKA? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/vodkarita-mix@2x.png" alt="">
                <p class="product-name"> Vodkarita Mix </p>
            </div>
  
            <div class="col-4 ${ MIXER_BLOODY? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/bloodyMarry@2x.png" alt="">
                <p class="product-name"> Bloody Mary Mix </p>
            </div>
            <div class="col-4 ${ MIXER_MOJITO? '' : 'hide'}">
                <img class="product-img"
                    src="/wp-content/uploads/2021/06/Mojito-mix@2x.png" alt="">
                <p class="product-name"> Mojito Mix </p>
            </div>
  
        </div>
  
  
    </div>
  </div>
  `
  
  // $('.store-container2').slick('slickAdd',card);
  
    $('.store-container2').append( card );
    // frontEndLogic();
    
  }
  
  
  