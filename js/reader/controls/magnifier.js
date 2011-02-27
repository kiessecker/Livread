Monocle.Controls.Magnifier = function (reader) {
  if (Monocle.Controls == this) {
    return new Monocle.Controls.Magnifier(reader);
  }

  // Constants.
  var k = {
    FONT_SIZE_XL: "300%",
    FONT_SIZE_L: "160%",
    FONT_SIZE_M: "130%",
    NORMAL_FONT_SIZE: Monocle.Styles.content['font-size'] || "100%",
    FONT_SIZE_S: "60%"
  }

  // Properties.
  var p = {
    buttons: [],
    enlarged: 1
  }

  // Public methods and properties.
  var API = {
    constructor: Monocle.Controls.Magnifier,
    constants: k,
    properties: p
  }


  function initialize() {
    p.reader = reader;
  }


  function createControlElements() {
    var btn = document.createElement("div");
    btn.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.button
    );

    btn.magsizefont1 = document.createElement('span');
    btn.magsizefont1.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.magsizefont1
    )
    btn.appendChild(btn.magsizefont1);

    btn.magsizefont2 = document.createElement('span');
    btn.magsizefont2.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.magsizefont2
    )
    btn.appendChild(btn.magsizefont2);

    btn.magsizefont3 = document.createElement('span');
    btn.magsizefont3.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.magsizefont3
    )
    btn.appendChild(btn.magsizefont3);

    btn.magsizefont4 = document.createElement('span');
    btn.magsizefont4.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.magsizefont4
    )
    btn.appendChild(btn.magsizefont4);

    btn.magsizefont5 = document.createElement('span');
    btn.magsizefont5.style.cssText = Monocle.Styles.ruleText(
      Monocle.Styles.Controls.Magnifier.magsizefont5
    )
    btn.appendChild(btn.magsizefont5);


    btn.magsizefont5.innerHTML = btn.magsizefont4.innerHTML = btn.magsizefont3.innerHTML = btn.magsizefont2.innerHTML = btn.magsizefont1.innerHTML = "A";
    btn.appendChild(btn.magsizefont5);

    var evtType = typeof Touch == "object" ? "touchstart" : "mousedown";
    Monocle.addListener(btn, evtType, toggleMagnification, true);

    p.buttons.push(btn);
    return btn;
  }


  function toggleMagnification(evt) {
    if (evt.preventDefault) {
      evt.preventDefault();
      evt.stopPropagation();
    } else {
      evt.returnValue = false;
    }
    var opacities;
 

   switch(p.enlarged) {
	case 0:
	    p.enlarged=1;
	break;
	case 1:
	    p.enlarged=2;
	break;
	case 2:
	    p.enlarged=3;
	break;
	case 3:
	    p.enlarged=4;
	break;
	case 4:
	    p.enlarged=0;
	break;
    }



   switch(p.enlarged) {
	case 0:
	    Monocle.Styles.content['font-size'] = k.FONT_SIZE_S;
	    opacities = [1, 0.4, 0.4, 0.4, 0.4];
	break;
	case 1:
	    Monocle.Styles.content['font-size'] = k.NORMAL_FONT_SIZE;
	    opacities = [0.4, 1, 0.4, 0.4, 0.4];
	break;
	case 2:
	    Monocle.Styles.content['font-size'] = k.FONT_SIZE_M;
	    opacities = [0.4, 0.4, 1, 0.4, 0.4];
	break;
	case 3:
	    Monocle.Styles.content['font-size'] = k.FONT_SIZE_L;
	    opacities = [0.4, 0.4, 0.4, 1, 0.4];
	break;
	case 4:
	    Monocle.Styles.content['font-size'] = k.FONT_SIZE_XL;
	    opacities = [0.4, 0.4, 0.4, 0.4, 1];
	break;
    }


    for (var i = 0; i < p.buttons.length; i++) {
      p.buttons[i].magsizefont1.style.opacity = opacities[0];
      p.buttons[i].magsizefont2.style.opacity = opacities[1];
      p.buttons[i].magsizefont3.style.opacity = opacities[2];
      p.buttons[i].magsizefont4.style.opacity = opacities[3];
      p.buttons[i].magsizefont5.style.opacity = opacities[4];
    }

    p.reader.reapplyStyles();
  }

  API.createControlElements = createControlElements;

  initialize();

  return API;
}


Monocle.Styles.Controls.Magnifier = {
  button: {
    "cursor": "pointer",
    "color": "#555",
    "position": "absolute",
    "top": "2px",
    "right": "10px",
    "padding": "0 2px"
  },
  magsizefont5: {
    "font-size": "19px",
    "opacity": "0.4"
  },
  magsizefont4: {
    "font-size": "17px",
    "opacity": "0.4"
  },
  magsizefont3: {
    "font-size": "15px",
    "opacity": "0.4"
  },
  magsizefont2: {
    "font-size": "13px",
    "opacity": "1"
  },
  magsizefont1: {
    "font-size": "11px",
    "opacity": "0.4"
  }
}

Monocle.pieceLoaded('controls/magnifier');


