const supabase = supabase.createClient(
  "https://xomfvpoovjhrdmssrlck.supabase.co",
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InhvbWZ2cG9vdmpocmRtc3NybGNrIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzM5NDQ1NDYsImV4cCI6MjA4OTUyMDU0Nn0.kVL1RVbmPDqTiewwb_ZHaOwcyhrCM9h8OzSivtcH774"
);

let modo = "login";

// Cambiar entre login y registro
function cambiarModo(){
  if(modo === "login"){
    modo = "registro";
    titulo.innerText = "Registrarse";
    btn.innerText = "Crear cuenta";
  } else {
    modo = "login";
    titulo.innerText = "Iniciar sesión";
    btn.innerText = "Login";
  }
}

// Acción principal
async function accion(){
  if(modo === "login"){
    login();
  } else {
    registro();
  }
}

// REGISTRO
async function registro(){
  const { data, error } = await supabase.auth.signUp({
    email: email.value,
    password: password.value
  });

  if(error){
    alert(error.message);
    return;
  }

  // Guardar username en tabla profiles
  await supabase.from("profiles").insert({
    id: data.user.id,
    email: email.value,
    password: password.value
  });

  alert("Usuario registrado");
}

// LOGIN
async function login(){
  const { error } = await supabase.auth.signInWithPassword({
    email: email.value,
    password: password.value
  });

  if(error){
    alert(error.message);
    return;
  }

  // Redirigir al chat
  window.location.href = "chat.html";
}