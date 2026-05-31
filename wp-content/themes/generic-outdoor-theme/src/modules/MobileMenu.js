class MobileMenu {
  constructor() {
    this.menuToggle = document.querySelector('.js-menu-toggle')
    this.menuClose = document.querySelector('.js-menu-close')
    this.siteNav = document.querySelector('.site-navigation')

    this.events()
  }

  events() {
    if (!this.menuToggle || !this.siteNav) return

    this.menuToggle.addEventListener('click', () => this.toggleMenu())

    if (this.menuClose) {
      this.menuClose.addEventListener('click', () => this.closeMenu())
    }
  }

  toggleMenu() {
    const isOpen = this.menuToggle.getAttribute('aria-expanded') === 'true'

    if (isOpen) {
      this.closeMenu()
    } else {
      this.openMenu()
    }
  }

  openMenu() {
    this.menuToggle.setAttribute('aria-expanded', 'true')
    this.menuToggle.setAttribute('aria-label', 'Close menu')
    this.siteNav.classList.add('site-navigation--active')
  }

  closeMenu() {
    this.menuToggle.setAttribute('aria-expanded', 'false')
    this.menuToggle.setAttribute('aria-label', 'Open menu')
    this.siteNav.classList.remove('site-navigation--active')
  }
}

export default MobileMenu