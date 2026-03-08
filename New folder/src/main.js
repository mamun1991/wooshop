
console.log("Tailwind + Alpine loaded!");

// Scroll-triggered section animations with Intersection Observer
const observerOptions = {
  threshold: 0.05,
  rootMargin: '0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-in');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Wait for DOM to be fully loaded
window.addEventListener('load', () => {
  setTimeout(() => {
    const animatedSections = document.querySelectorAll('[data-scroll-animate]');
    console.log('Found sections to animate:', animatedSections.length);
    animatedSections.forEach((section) => {
      observer.observe(section);
      // Trigger animation immediately if already in viewport
      if (section.getBoundingClientRect().top < window.innerHeight) {
        section.classList.add('animate-in');
        observer.unobserve(section);
      }
    });
  }, 100);
});
