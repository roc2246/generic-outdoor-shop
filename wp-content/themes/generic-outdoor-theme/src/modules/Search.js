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

  events() {
    this.openButton.addEventListener("click", () => this.openOverlay());
    this.closeButton.addEventListener("click", () => this.closeOverlay());

    document.addEventListener("keydown", (e) => this.keyPressDispatcher(e));

    this.searchField.addEventListener("keyup", () => this.typingLogic());

    this.searchOverlay.addEventListener("click", (e) => {
      if (e.target === this.searchOverlay) {
        this.closeOverlay();
      }
    });

    this.resultsDiv.addEventListener("click", (e) => {
      if (e.target.tagName === "A") {
        this.closeOverlay();
      }
    });
  }

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

  renderResults(results) {
    // Clear results container
    while (this.resultsDiv.firstChild) {
      this.resultsDiv.removeChild(this.resultsDiv.firstChild);
    }

    const row = document.createElement('div');
    row.className = 'row';

    // General Information section
    const generalSection = this.createSection('General Information', results.generalInfo, (item) => {
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = item.permalink;
      a.textContent = item.title;
      li.appendChild(a);

      if (item.postType === 'post' && item.authorName) {
        const byText = document.createTextNode(` by ${item.authorName}`);
        li.appendChild(byText);
      }

      return li;
    });
    row.appendChild(generalSection);

    // Products section
    const productsSection = this.createSection('Products', results.products, (item) => {
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = item.permalink;
      a.textContent = item.title;
      li.appendChild(a);

      if (item.price) {
        const span = document.createElement('span');
        span.textContent = ` - $${item.price}`;
        li.appendChild(span);
      }

      return li;
    });
    row.appendChild(productsSection);

    // Services section
    const servicesSection = this.createSection('Services', results.services, (item) => {
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = item.permalink;
      a.textContent = item.title;
      li.appendChild(a);

      return li;
    });
    row.appendChild(servicesSection);

    this.resultsDiv.appendChild(row);
  }

  createSection(title, items, renderItem) {
    const section = document.createElement('div');
    section.className = 'one-third';

    const heading = document.createElement('h2');
    heading.className = 'search-overlay__section-title';
    heading.textContent = title;
    section.appendChild(heading);

    if (items.length === 0) {
      const emptyMsg = document.createElement('p');
      emptyMsg.textContent = `No ${title.toLowerCase()} match that search.`;
      section.appendChild(emptyMsg);
    } else {
      const ul = document.createElement('ul');
      ul.className = 'link-list min-list';
      items.forEach((item) => {
        ul.appendChild(renderItem(item));
      });
      section.appendChild(ul);
    }

    return section;
  }

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
      this.renderResults(results);
      this.isSpinnerVisible = false;
    } catch (err) {
      console.error('Search failed:', err);
      const errorMsg = document.createElement('p');
      errorMsg.textContent = 'Search unavailable. Please try again.';
      this.resultsDiv.innerHTML = '';
      this.resultsDiv.appendChild(errorMsg);
      this.isSpinnerVisible = false;
    }
  }

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

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.body.classList.add("body-no-scroll");

    this.searchField.value = "";
    this.resultsDiv.innerHTML = "";
    this.previousValue = "";

    setTimeout(() => this.searchField.focus(), 300);

    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.body.classList.remove("body-no-scroll");

    this.searchField.blur();

    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <svg
              class="search-overlay__icon"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              aria-hidden="true"
            >
              <path
                d="M10 18a8 8 0 1 1 5.293-14.293A8 8 0 0 1 10 18zm11 3-6-6"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
              />
            </svg>

            <input
              type="text"
              class="search-term"
              placeholder="What are you looking for?"
              id="search-term"
            >

            <button
              type="button"
              class="search-overlay__close"
              aria-label="Close search"
            >
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true"
              >
                <path
                  d="M6 6L18 18M18 6L6 18"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                />
              </svg>
            </button>
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