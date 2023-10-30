
/*const marques = document.getElementsByClassName('marque');
//alert(card[11]);

for(let i = 0; i < 4; i++){
    marques[i].addEventListener("click", () => {
        marques[i].classList.add("marque-clicked");   
    });
}*/

//=============================================// fonctions //===============================================================//

function validateForm() {
  let x = document.forms["myForm"]["email"].value;
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(x)) {
    alert("Email is not valid!");
  }
}

function remouve_basket(){
  alert(supprime);
}

function set_basket_sum(){
 
}

//=============================================================================================================================//

const imgMenu = document.getElementById("icone-menu");
const subMenu = document.getElementById("subMenu");
const body = document.getElementsByTagName("body")[0];

const imgmenuleft = document.getElementById("icone-menu-rigth");
const menu = document.getElementsByClassName("menu")[0];

imgMenu.addEventListener("click", () => {
  if(menu.classList.contains("open-menu")){
      menu.classList.toggle("open-menu");
  }
    subMenu.classList.toggle("open-sub-menu");
});

imgmenuleft.addEventListener("click", () => {
  if(subMenu.classList.contains("open-sub-menu")){
      subMenu.classList.toggle("open-sub-menu");
  }
    menu.classList.toggle("open-menu");
});

var button_fav = document.getElementById("add-favorite");
var button_fav_img = document.getElementById("img-fav");

button_fav.addEventListener("click", () => {
    if(button_fav_img.classList.contains("img-fav-true")){
        button_fav_img.setAttribute("src", "images/love-removebg-preview.png");
        button_fav_img.classList.replace("img-fav-true", "img-fav-false");

    }else{
      button_fav_img.setAttribute("src", "images/black_heart.png");
      button_fav_img.classList.replace("img-fav-false", "img-fav-true");
    }
});

/*let age = prompt('age?', 18);

let message = (age < 3) ? 'Hi, baby!' :
  (age < 18) ? 'Hello!' :
  (age < 100) ? 'Greetings!' :
  'What an unusual age!';

alert( message );*/


let password = document.getElementById("field-password");
let form = document.getElementsByClassName("auth-form")[0];
let p = document.createElement("p");
p.innerText = "Mot de passe trop court(minimun 8 caracteres)"
p.classList.add("password-test");
password.addEventListener("input", () => {
  //alert("ecriture");
    if(password.value.length < 8) {
      form.appendChild(p);
    }else{
      form.removeChild(p);
    } 
})

checkPassword = document.getElementById("see-password");
checkPassword.addEventListener("click", () => {
    if(checkPassword.checked === true){
      password.type = "text";
    }else{
      password.type = "password";
    }
})

