class Search {
  constructor() {
    this.resultsDiv = document.querySelector("#search-overlay__results")
    this.openButton = document.querySelector(".js-search-trigger")
    this.closeButton = document.querySelector(".search-overlay__close")
    this.searchOverlay = document.querySelector(".search-overlay")
    this.searchField = document.querySelector("#search-term")

    this.isOverlayOpen = false
    this.isSpinnerVisible = false
    this.previousValue = ""
    this.typingTimer = null

    this.events()
  }

  events() {
    this.openButton.addEventListener("click", () => this.openOverlay())
    this.closeButton.addEventListener("click", () => this.closeOverlay())

    document.addEventListener("keydown", (e) => this.keyPressDispatcher(e))
    this.searchField.addEventListener("keyup", () => this.typingLogic())
  }

  typingLogic() {
    const value = this.searchField.value

    if (value !== this.previousValue) {
      clearTimeout(this.typingTimer)

      if (value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = `<div class="spinner-loader"></div>`
          this.isSpinnerVisible = true
        }

        this.typingTimer = setTimeout(() => this.getResults(), 2000)
      } else {
        this.resultsDiv.innerHTML = ""
        this.isSpinnerVisible = false
      }
    }

    this.previousValue = value
  }

  getResults() {
    this.resultsDiv.innerHTML = "Imagine real search results here..."
    this.isSpinnerVisible = false
  }

  keyPressDispatcher(e) {
    const key = e.key

    const isInputFocused =
      document.activeElement.tagName === "INPUT" ||
      document.activeElement.tagName === "TEXTAREA"

    // "S" key opens search
    if (key === "s" && !this.isOverlayOpen && !isInputFocused) {
      this.openOverlay()
    }

    // ESC closes search
    if (key === "Escape" && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active")
    document.body.classList.add("body-no-scroll")

    console.log("open method ran")
    this.isOverlayOpen = true
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active")
    document.body.classList.remove("body-no-scroll")

    console.log("close method ran")
    this.isOverlayOpen = false
  }
}

export default Search