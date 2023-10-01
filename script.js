// ........................................................ Intersection Observer

const section__content = document.querySelectorAll('.section__content');

const showOptions = {
  rootMargin: '0px',
  threshold: 0.005,
};

const observer = new IntersectionObserver((entries, showOnScroll) => {
  entries.forEach((entry) => {
    console.log(entry);
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
      //   entry.target.classList.remove('hidden');
    } else {
      entry.target.classList.remove('show');
      //   entry.target.classList.add('hidden');
    }
  });
}, showOptions);

section__content.forEach((el) => observer.observe(el));

// ........................................................ Theme Switcher

let themeSwitchIcon = document.querySelector('#themeSwitch-icon');

themeSwitchIcon.addEventListener('click', function () {
  this.classList.toggle('fa-sun');
  document.body.classList.toggle('night-mode');
});

// ........................................................ Read More

let more = document.querySelectorAll('.more');
for (let i = 0; i < more.length; i++) {
  more[i].addEventListener('click', function () {
    more[i].parentNode.classList.toggle('active');
  });
}
