window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    document.querySelector(".header_area").classList.add("white_nav");
  } else {
    document.querySelector(".header_area").classList.remove("white_nav");
  }
});
