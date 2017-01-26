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
  //que no esten los campos vacios
  if (passw2.length == 0 || passw3.length == 0){
    alert("Los campos de la password no pueden quedar vacios");
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
}
