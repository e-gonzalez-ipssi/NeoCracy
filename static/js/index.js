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

// document.addEventListener("mousemove", parallax);

// function parallax(e){
//   this.querySelectorAll('.layer').forEach(layer => {
//     const speed = layer.getAttribute('data-speed')

//     const x = (window.innerWidth - e.pageX*speed)/100
//     const y = (window.innerHeight - e.pageY*speed)/100

//     layer.style.transform = 'translateX(${x}px) translateY(${y}px)'
//   })
// };