function myFunction() {
    var x =  document.getElementById("dayNight2");
    var y =  document.getElementById("nightDay");
    if (x.style.display === "none") {
      x.style.display = "block";
    } 
    
    else {
      x.style.display = "block";
    }

    if (y.style.display === "none") {
      y.style.display = "block";
    } 
    
    else {
      y.style.display = "block";
    }
  }

function myFunction2() {
  var x =  document.getElementById("dayNight2");
  var y =  document.getElementById("nightDay");
  if (x.style.display === "none") {
    x.style.display = "block";
    x.value
  } 
  
  else {
    x.style.display = "none";
  }

  if (y.style.display === "none") {
    y.style.display = "block";
    y.value
  } 
  
  else {
    y.style.display = "none";
  }
};

function connexion(){
  
  var btn = document.getElementById("Connexion");

  var modal = document.getElementById("connect");
  
  var span = document.getElementsByClassName("close")[0];
  
  
  modal.style.display = "block";
 
  
  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  }
  
  function inscription(){
    
    var btn = document.getElementById("Inscription");
  
    var modal = document.getElementById("register");
    
    var span = document.getElementsByClassName("closes")[0];
    
    
    modal.style.display = "block";
    
    
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }


  document.getElementById('switchTheme').addEventListener('click', function () {
    let htmlClasses = document.querySelector('html').classList;
    let moon = document.getElementById("moon");
    let sun = document.getElementById("sun");
    let body = document.getElementById("body")
    let logo = document.getElementById("logo")
    let logoW = document.getElementById("logoW")
    let f1 = document.querySelector(".f1");
    let f2 = document.querySelector(".f2");
    let f3 = document.querySelector(".f3");
    let f4 = document.querySelector(".f4");
    let f5 = document.querySelector(".f5");
    let f6 = document.querySelector(".f6");
    let f7 = document.querySelector(".f7");
    let f8 = document.querySelector(".f8");
    let connect = document.getElementById("Connexion");
    let register = document.getElementById("Inscription");
    if (localStorage.theme == 'dark') {
        htmlClasses.remove('dark');
        localStorage.removeItem('theme');
        moon.style.display = "none";
        logoW.style.display = "none";
        logo.style.display = "block";
        sun.style.display = "block";
        body.style.background = "linear-gradient(#fcfffe, #e0edfd)";
        f1.style.background = "linear-gradient(#222831, #c0d3f0)";
        f2.style.background = "linear-gradient(#222831, #c0d3f0)";
        f3.style.background = "linear-gradient(#222831, #c0d3f0)";
        f4.style.background = "linear-gradient(#222831, #c0d3f0)";
        f5.style.background = "linear-gradient(#222831, #c0d3f0)";
        f6.style.background = "linear-gradient(#222831, #c0d3f0)";
        f7.style.background = "linear-gradient(#222831, #c0d3f0)";
        f8.style.background = "linear-gradient(#222831, #c0d3f0)";
        register.style.boxShadow = "0 15px 30px 0 rgba(0, 0, 0, 0.11), 0 5px 15px 0 rgba(0, 0, 0, 0.08)";
        connect.style.boxShadow = "0 15px 30px 0 rgba(0, 0, 0, 0.11), 0 5px 15px 0 rgba(0, 0, 0, 0.08)";
  
    } else {
        htmlClasses.add('dark');
        localStorage.theme = 'dark';
        moon.style.display = "block";
        sun.style.display = "none";
        logo.style.display = "none";
        logoW.style.display = "block";
        body.style.background = "linear-gradient(#303030, #222831)";
        f1.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f2.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f3.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f4.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f5.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f6.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f7.style.background = "linear-gradient(#e0e9f8, #222831) ";
        f8.style.background = "linear-gradient(#e0e9f8, #222831) ";
        register.style.boxShadow = " 0 15px 30px 0 #353535, 0 5px 15px 0 #404040";
        connect.style.boxShadow = " 0 15px 30px 0 #353535, 0 5px 15px 0 #404040";
    }
});
