// variable
let modal2 = document.querySelector(".modal-container2");
let btn2 = document.getElementById("myBtn2");
let closeBtn2 = document.querySelectorAll(".btn2");

// EventListener
btn2.addEventListener("click", () => {
  modal2.classList.add("show");
});

closeBtn.forEach((eachBtn) => {
  eachBtn.addEventListener("click", () => {
    modal2.classList.remove("show");
  });
});

window.onclick = function (event) {
  if (event.target == modal2) {
    modal2.classList.remove("show");
  }
};
