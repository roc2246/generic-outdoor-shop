class Search {
  constructor() {
    this.addSearchHTML()

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

  // EVENTS
  events() {
    this.openButton.addEventListener("click", () => this.openOverlay())
    this.closeButton.addEventListener("click", () => this.closeOverlay())

    document.addEventListener("keydown", (e) => this.keyPressDispatcher(e))
    this.searchField.addEventListener("keyup", () => this.typingLogic())
  }

  // TYPING LOGIC
  typingLogic() {
    const value = this.searchField.value

    if (value !== this.previousValue) {
      clearTimeout(this.typingTimer)

      if (value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = `<div class="spinner-loader"></div>`
          this.isSpinnerVisible = true
        }

        this.typingTimer = setTimeout(() => this.getResults(), 750)
      } else {
        this.resultsDiv.innerHTML = ""
        this.isSpinnerVisible = false
      }
    }

    this.previousValue = value
  }

  // FETCH RESULTS (WordPress REST API)
  async getResults() {
    try {
      const base = wpSite.root_url
      const query = this.searchField.value

      const [postsRes, pagesRes] = await Promise.all([
        fetch(`${base}/wp-json/wp/v2/posts?search=${query}`),
        fetch(`${base}/wp-json/wp/v2/pages?search=${query}`)
      ])

      const posts = await postsRes.json()
      const pages = await pagesRes.json()

      const combinedResults = [...posts, ...pages]

      this.resultsDiv.innerHTML = `
        <h2 class="search-overlay__section-title">General Information</h2>

        ${
          combinedResults.length
            ? `<ul class="link-list min-list">`
            : `<p>No general information matches that search.</p>`
        }

        ${combinedResults
          .map(
            item => `
              <li>
                <a href="${item.link}">
                  ${item.title.rendered}
                </a>
              </li>
            `
          )
          .join("")}

        ${combinedResults.length ? `</ul>` : ``}
      `

      this.isSpinnerVisible = false

    } catch (err) {
      this.resultsDiv.innerHTML =
        "<p>Unexpected error; please try again.</p>"
    }
  }

  // KEYBOARD SHORTCUTS
  keyPressDispatcher(e) {
    const isInputFocused =
      document.activeElement.tagName === "INPUT" ||
      document.activeElement.tagName === "TEXTAREA"

    if (e.key === "s" && !this.isOverlayOpen && !isInputFocused) {
      this.openOverlay()
    }

    if (e.key === "Escape" && this.isOverlayOpen) {
      this.closeOverlay()
    }
  }

  // OPEN
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active")
    document.body.classList.add("body-no-scroll")

    this.searchField.value = ""

    setTimeout(() => this.searchField.focus(), 300)

    console.log("open method ran")
    this.isOverlayOpen = true
  }

  // CLOSE
  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active")
    document.body.classList.remove("body-no-scroll")

    console.log("close method ran")
    this.isOverlayOpen = false
  }

  // INJECT HTML
  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>

        <div class="container">
          <div id="search-overlay__results"></div>
        </div>
      </div>
      `
    )
  }
}

export default Search