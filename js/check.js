function validationPass(){
  passw2=document.getElementById("password").value;//clave
  passw3=document.getElementById("password2").value;
  //evitar espacios en blanco
  var espacios=false;
  var cont=0;
  while (!espacios && (cont < passw2.length) || (cont < passw3.length)){
    if (passw2.charAt(cont) == " " || passw3.charAt(cont) == " ")
    espacios = true;
    cont++;
  }
  if (espacios){
    alert ("La contraseña no puede contener espacios en blanco");
    return false;
  }
  //que ambas contraseñas coincidan
  if (passw2 != passw3){
    alert("Las passwords deben de coincidir");
    return false;
  }else{
      return true;
      //return false;
    }
};

function alertlogout() {
    var logout = confirm("Are you sure you want to log out?");
    if (logout == true) {
        window.location.href = "php/logout.php";
    }
};
