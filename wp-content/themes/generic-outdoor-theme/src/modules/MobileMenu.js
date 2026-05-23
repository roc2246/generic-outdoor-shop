class MobileMenu {
  constructor() {
    this.menuToggle = document.querySelector('.js-menu-toggle')
    this.siteNav = document.querySelector('.site-navigation')

    this.events()
  }

  events() {
    if (!this.menuToggle || !this.siteNav) return

    this.menuToggle.addEventListener('click', () => this.toggleMenu())
  }

  toggleMenu() {
    const isOpen = this.menuToggle.getAttribute('aria-expanded') === 'true'

    this.menuToggle.setAttribute('aria-expanded', String(!isOpen))
    this.menuToggle.setAttribute('aria-label', isOpen ? 'Open menu' : 'Close menu')
    this.siteNav.classList.toggle('site-navigation--active')
  }
}

export default MobileMenu
