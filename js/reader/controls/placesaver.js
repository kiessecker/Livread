Monocle.Controls.PlaceSaver = function (reader) {
  if (Monocle.Controls == this) {
    return new Monocle.Controls.PlaceSaver(reader);
  }

  var k = {
    COOKIE_NAMESPACE: "monocle.controls.placesaver.",
    COOKIE_EXPIRES_IN_DAYS: 7 // Set to 0 for session-based expiry.
  }

  // Properties.
  var p = {
  }

  // Public methods and properties.
  var API = {
    constructor: Monocle.Controls.PlaceSaver,
    constants: k,
    properties: p
  }


  function initialize() {
    p.reader = reader;
    applyToBook(p.reader.getBook());
    p.reader.addListener('monocle:turn', savePlaceToCookie);
    p.reader.addListener('monocle:bookChange', applyToBook);
  }


  function applyToBook() {
    p.bkTitle = p.reader.getBook().getMetaData('title');
    p.bkTitle = p.bkTitle.toLowerCase().replace(/[^a-z0-9]/g, '');
    p.bkTitle = livReadEbookBookID;
    p.prefix = k.COOKIE_NAMESPACE +
      p.reader.properties.divs.box.id + "." +
      p.bkTitle + ".";
  }


  function setCookie(key, value, days) {
    var expires = "";
    if (days) {
      var d = new Date();
      d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires="+d.toGMTString();
    }
    var path = "; path=/";
    document.cookie = p.prefix + key + " = " + value + expires + path;
    return value;
  }


  function getCookie(key) {
    if (!document.cookie) {
      return null;
    }
    var regex = new RegExp(p.prefix + key + "=(.+?)(;|$)");
    var matches = document.cookie.match(regex);
    if (matches) {
      return matches[1];
    } else {
      return null;
    }
  }


  function savePlaceToCookie() {
    var place = p.reader.getPlace();
    var magnification=p.reader.properties.controls[1].control.properties.enlarged;


    setCookie(
      "component",
      encodeURIComponent(place.componentId()),
      k.COOKIE_EXPIRES_IN_DAYS
    );
    setCookie(
      "magnification",
      encodeURIComponent(magnification),
      k.COOKIE_EXPIRES_IN_DAYS
    );
    setCookie(
      "percent",
      place.percentageThrough(),
      k.COOKIE_EXPIRES_IN_DAYS
    );
  }


  function savedPlace() {
    var place = {
      component: getCookie('component'),
      percent: getCookie('percent')
    }

    var magnificationcookie = {
      magnification: getCookie('magnification')
    }




    if (place.component && place.percent) {
      place.component = decodeURIComponent(place.component);
      place.percent = parseFloat(place.percent);
	if(magnificationcookie.magnification) {
	    var currmagnification=p.reader.properties.controls[1].control.properties.enlarged;
	    if(parseInt(currmagnification)!=parseInt(magnificationcookie.magnification)){
		// debug: here we call the saved magnitude
	    }


	}


      return place;
    } else {
      return null;
    }
  }


  function restorePlace() {
    var place = savedPlace();
    if (place) {
      p.reader.moveTo({ percent: place.percent, componentId: place.component });
    }
  }


  API.savedPlace = savedPlace;
  API.restorePlace = restorePlace;

  initialize();

  return API;
}


Monocle.pieceLoaded('controls/placesaver');
