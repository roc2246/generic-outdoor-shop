import axios from "axios";

class Search {
  constructor() {
    this.addSearchHTML();

    this.resultsDiv = document.querySelector("#search-overlay__results");
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector("#search-term");

    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue = "";
    this.typingTimer = null;

    this.events();
  }

  // EVENTS
  events() {
    this.openButton.addEventListener("click", () => this.openOverlay());
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    this.closeButton.addEventListener("click", () => {
      console.log("TEST");
    });

    document.addEventListener("keydown", (e) => this.keyPressDispatcher(e));
    this.searchField.addEventListener("keyup", () => this.typingLogic());
  }

  // TYPING LOGIC
  typingLogic() {
    const value = this.searchField.value;

    if (value !== this.previousValue) {
      clearTimeout(this.typingTimer);

      if (value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = `<div class="spinner-loader"></div>`;
          this.isSpinnerVisible = true;
        }

        this.typingTimer = setTimeout(() => this.getResults(), 750);
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = value;
  }

  // FETCH RESULTS (WordPress REST API)

  async getResults() {
    try {
      const base = wpSite.root_url;
      const query = encodeURIComponent(this.searchField.value);

      const response = await fetch(
        `${base}/wp-json/genericOutdoor/v1/search?term=${query}`,
      );

      if (!response.ok) {
        throw new Error("Search request failed");
      }

      const results = await response.json();

      this.resultsDiv.innerHTML = `
      <div class="row">
        <div class="one-third">
          <h2 class="search-overlay__section-title">General Information</h2>

          ${
            results.generalInfo.length
              ? `<ul class="link-list min-list">`
              : `<p>No general information matches that search.</p>`
          }

          ${results.generalInfo
            .map(
              (item) => `
                <li>
                  <a href="${item.permalink}">
                    ${item.title}
                  </a>
                  ${
                    item.postType === "post" && item.authorName
                      ? ` by ${item.authorName}`
                      : ""
                  }
                </li>
              `,
            )
            .join("")}

          ${results.generalInfo.length ? `</ul>` : ``}
        </div>

        <div class="one-third">
          <h2 class="search-overlay__section-title">Products</h2>

          ${
            results.products.length
              ? `<ul class="link-list min-list">`
              : `<p>No products match that search.</p>`
          }

          ${results.products
            .map(
              (item) => `
                <li>
                  <a href="${item.permalink}">
                    ${item.title}
                  </a>
                  ${item.price ? `<span> - $${item.price}</span>` : ""}
                </li>
              `,
            )
            .join("")}

          ${results.products.length ? `</ul>` : ``}
        </div>

        <div class="one-third">
          <h2 class="search-overlay__section-title">Services</h2>

          ${
            results.services.length
              ? `<ul class="link-list min-list">`
              : `<p>No services match that search.</p>`
          }

          ${results.services
            .map(
              (item) => `
                <li>
                  <a href="${item.permalink}">
                    ${item.title}
                  </a>
                </li>
              `,
            )
            .join("")}

          ${results.services.length ? `</ul>` : ``}
        </div>
      </div>
    `;

      this.isSpinnerVisible = false;
    } catch (err) {
      this.resultsDiv.innerHTML = "<p>Unexpected error; please try again.</p>";
      this.isSpinnerVisible = false;
    }
  }
  
  // KEYBOARD SHORTCUTS
  keyPressDispatcher(e) {
    const isInputFocused =
      document.activeElement.tagName === "INPUT" ||
      document.activeElement.tagName === "TEXTAREA";

    if (e.key === "s" && !this.isOverlayOpen && !isInputFocused) {
      this.openOverlay();
    }

    if (e.key === "Escape" && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  // OPEN
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.body.classList.add("body-no-scroll");

    this.searchField.value = "";

    setTimeout(() => this.searchField.focus(), 300);

    console.log("open method ran");
    this.isOverlayOpen = true;
    return false
  }

  // CLOSE
  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.body.classList.remove("body-no-scroll");

    console.log("close method ran");
    this.isOverlayOpen = false;
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
      `,
    );
  }
}

export default Search;
