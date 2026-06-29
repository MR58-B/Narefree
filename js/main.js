// AOS init
AOS.init({duration:900, once:true, offset:80});

// Navbar shadow on scroll
window.addEventListener('scroll', () => {
  const nav = document.querySelector('.nf-nav');
  if (window.scrollY > 40) nav.classList.add('shadow'); else nav.classList.remove('shadow');
});

// Counters
const counters = document.querySelectorAll('.counter');
const runCounter = el => {
  const target = +el.dataset.target;
  let n = 0;
  const step = Math.max(1, target / 80);
  const tick = () => {
    n += step;
    if (n >= target) { el.textContent = target + '+'; return; }
    el.textContent = Math.floor(n);
    requestAnimationFrame(tick);
  };
  tick();
};
if (counters.length) {
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { runCounter(e.target); io.unobserve(e.target); } });
  });
  counters.forEach(c => io.observe(c));
}

// Contact form
const form = document.getElementById('contactForm');
if (form) {
  form.addEventListener('submit', e => {
    e.preventDefault();
    document.getElementById('formMsg').classList.remove('d-none');
    form.reset();
  });
}
