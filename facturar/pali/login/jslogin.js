var pwd = document.getElementById('pwd');
var eye = document.getElementById('eye');

eye.addEventListener('click',togglePass);

function togglePass(){

   eye.classList.toggle('active');

   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type = 'password';
}

// Form Validation
function checkStuff() {

  var nombre = document.form1.nombre.value;
  var password = document.form1.password.value;
  var msg = document.getElementById('msg');


  const pattern = new RegExp('^[A-Z]+$', 'i');

/*    if(!pattern.test(input.nombre)){
      msg.innerHTML = " Solo letras. ";
      document.form1.nombre.focus();
      return false;
    }*/
  
/*  if (nombre == "") {
    msg.style.display = 'block';
    msg.innerHTML = "Plisss.. 'el nombre'.";
    document.form1.nombre.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }
  
   if (password == "") {
    msg.innerHTML = "Plisss.. 'la contraseña'.";
    document.form1.password.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }
*/

/*  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(email.value)) {
    msg.innerHTML = "Please enter a valid email";
    document.form1.nombre.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }*/
}
