function initTheme() {
  console.log('Generic Outdoor theme: frontend JS initialized');
  // Example: toggle mobile menu
  const btn = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-navigation');
  if (btn && nav) {
    btn.addEventListener('click', () => nav.classList.toggle('is-open'));
  }
}

if (typeof window !== 'undefined') {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTheme);
  } else {
    initTheme();
  }
}

export default initTheme;
