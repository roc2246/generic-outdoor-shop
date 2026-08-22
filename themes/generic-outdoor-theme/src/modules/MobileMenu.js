class MobileMenu {
  constructor() {
    this.menuToggle = document.querySelector('.js-menu-toggle')
    this.menuClose = document.querySelector('.js-menu-close')
    this.siteNav = document.querySelector('.site-navigation')
    this.mobileBreakpoint = window.matchMedia('(max-width: 47.99rem)')

    this.events()
    this.updateAccessibilityState()
    this.mobileBreakpoint.addEventListener('change', () => this.updateAccessibilityState())
  }

  events() {
    if (!this.menuToggle || !this.siteNav) return

    this.menuToggle.addEventListener('click', () => this.toggleMenu())

    if (this.menuClose) {
      this.menuClose.addEventListener('click', () => this.closeMenu())
    }

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && this.siteNav.classList.contains('site-navigation--active')) {
        this.closeMenu()
      }
    })
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
    this.siteNav.setAttribute('aria-hidden', 'false')
    if (this.menuClose) this.menuClose.focus()
  }

  closeMenu() {
    this.menuToggle.setAttribute('aria-expanded', 'false')
    this.menuToggle.setAttribute('aria-label', 'Open menu')
    this.siteNav.classList.remove('site-navigation--active')
    this.updateAccessibilityState()
    this.menuToggle.focus()
  }

  updateAccessibilityState() {
    const isMenuOpen = this.siteNav.classList.contains('site-navigation--active')
    const shouldHideMenu = this.mobileBreakpoint.matches && !isMenuOpen

    this.siteNav.setAttribute('aria-hidden', shouldHideMenu ? 'true' : 'false')
  }
}

export default MobileMenu