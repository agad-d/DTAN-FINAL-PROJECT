//employee-user login
const btns = document.querySelectorAll('.pagebtn');
const frames = document.querySelectorAll('.frames');
const navToggle = document.getElementById('navToggle');
const sidenav = document.querySelector('.sidenav');
const sidenavOverlay = document.getElementById('sidenavOverlay');

var frameActive = function (manual) {
  btns.forEach((btn) => {
    btn.classList.remove('active');
  });
  frames.forEach((slide) => {
    slide.classList.remove('active');
  });

  btns[manual].classList.add('active');
  frames[manual].classList.add('active');
};

btns.forEach((btn, i) => {
  btn.addEventListener('click', () => {
    frameActive(i);
    // auto-close the drawer on mobile after picking a page
    if (window.innerWidth <= 900) {
      closeSidenav();
    }
  });
});

function openSidenav() {
  sidenav.classList.add('open');
  sidenavOverlay.classList.add('show');
}

function closeSidenav() {
  sidenav.classList.remove('open');
  sidenavOverlay.classList.remove('show');
}

if (navToggle) {
  navToggle.addEventListener('click', () => {
    if (sidenav.classList.contains('open')) {
      closeSidenav();
    } else {
      openSidenav();
    }
  });
}

if (sidenavOverlay) {
  sidenavOverlay.addEventListener('click', closeSidenav);
}