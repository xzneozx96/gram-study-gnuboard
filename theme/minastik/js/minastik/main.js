AOS.init({
  duration: 800,
  once: true,
  disable: function () {
    let maxWidth = 576;
    return window.innerWidth < maxWidth;
  },
});

const services_swiper = new Swiper(".services--main", {
  loop: false,

  allowTouchMove: false,

  effect: "fade",
  fadeEffect: {
    crossFade: true,
  },
});

const workflow_swiper = new Swiper(".workflow--main", {
  navigation: {
    nextEl: ".workflow--swiper-next",
    prevEl: ".workflow--swiper-prev",
  },
});

// animate the banner decorator
const animated_decor = document.querySelector(".banner_decor");
const banner_hero = document.querySelector(".banner_hero--main");

// animate services
const controllers = Array.from(document.querySelectorAll(".service_item"));

let maxWidth = 991;
if (window.innerWidth > maxWidth) {
  banner_hero.addEventListener("mousemove", (e) => {
    let xAxis = (window.innerWidth / 2 - e.pageX) / 25;
    let yAxis = (window.innerHeight / 2 - e.pageY) / 25;
    animated_decor.style.transform = `translate(${xAxis / 5}%, ${yAxis / 5}%)`;
  });

  let myInterval = setInterval(() => {
    const active_ele_id = controllers.findIndex((ele) =>
      ele.classList.contains("active")
    );

    if (active_ele_id === 0) {
      controllers[0].classList.remove("active");
      controllers[1].classList.add("active");
      services_swiper.slideTo(1);
    }

    if (active_ele_id === 1) {
      controllers[1].classList.remove("active");
      controllers[2].classList.add("active");
      services_swiper.slideTo(2);
    }

    if (active_ele_id === 2) {
      controllers[2].classList.remove("active");
      controllers[0].classList.add("active");
      services_swiper.slideTo(0);
    }
  }, 8000);

  // activate service animation on click
  controllers.forEach((ele) => {
    ele.addEventListener("click", () => {
      clearInterval(myInterval);

      // remove active class on all other elements
      controllers.forEach((ele) => {
        ele.classList.remove("active");
      });

      // add active class on clicked element
      ele.classList.add("active");

      // get id of the active element
      const active_ele_id = controllers.findIndex((ele) =>
        ele.classList.contains("active")
      );

      switch (active_ele_id) {
        case 0:
          services_swiper.slideTo(0);
          break;
        case 1:
          services_swiper.slideTo(1);
          break;
        case 2:
          services_swiper.slideTo(2);
          break;
      }
    });
  });
}

if (window.innerWidth <= maxWidth) {
  controllers.forEach((ele) => {
    ele.classList.remove("active");
  });
}

function manualActiveSection($event) {
  if (event) {
    const anchor_elements = Array.from(document.querySelectorAll(".nav-link"));
    anchor_elements.forEach((element) => {
      element.classList.remove("active");
    });

    event.target.classList.add("active");
  }

  hideMobileMenu();
}

// control mobile menu
const mobile_menu = document.querySelector(".side_menu--wrap");

function showMobileMenu() {
  mobile_menu.classList.add("show");
}

function hideMobileMenu() {
  mobile_menu.classList.remove("show");
}

function visitSite(url) {
  window.open(url, "_blank");
}

if (window.location.pathname === "/index.html") {
  window.location.href = "/";
}
