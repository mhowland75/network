
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "navBar") {
      x.className += " responsive";
  } else {
      x.className = "navBar";
  }
}
function displayBlock() {
  var element = document.getElementById('sideNav'),
  style = window.getComputedStyle(element),
  top = style.getPropertyValue('width');
  if(top == "0px"){
    document.getElementById('sideNav').style.cssText = 'width:300px';
  }
  else{
    document.getElementById('sideNav').style.cssText = 'width:0px';
  }
}
