//Cart menu left
let left_menu_cart = document.querySelector("#cart_left_menu");
document.querySelector(".cart_button").onclick = function () {
  if (left_menu_cart.style.display == "none") {
    left_menu_cart.style.display = "block";
  } else {
    left_menu_cart.style.display = "none";
  }
};

//Account Info
let option_menu_left = document.querySelector("#option_menu_left");
document.querySelector(".hamburguer_option").onclick = function () {
  if (option_menu_left.style.display == "none") {
    option_menu_left.style.display = "block";
  } else {
    option_menu_left.style.display = "none";
  }
};
