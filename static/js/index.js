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
//}

function connexion(){

  // Get the modal
  var modal = document.getElementById("myModal");
  
  // Get the button that opens the modal
  var btn = document.getElementById("Connexion");
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  }
  
  function inscription(){
  
    // Get the modal
    var modal = document.getElementById("myModal2");
    
    // Get the button that opens the modal
    var btn = document.getElementById("Inscription");
    
    // Get the <span> element that closes the modal
    var span = document.getElementById("close");
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }
