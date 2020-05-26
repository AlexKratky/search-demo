<template>
  <div id="app">
    <main>
      <div>
        <div class="row">
          <div class="col-12" style="text-align: left !important;">
            <div class="search-box">
              <div class="search-wrapper">
                <div class="search-icon"><i class="icon ion-md-search"></i></div>
                <div class="search-input-wrapper">
                  <input type="text" class="search-input" id="searchVin" placeholder="Search ..." v-model="query" @keyup="fetchResults">
                </div>
              </div>
              <div class="search-result">
                <div v-if="results.length < 1">
                  <a href="#" class="center">Nebyl nalezen žádný záznam</a>
                </div>
                <div v-for="result in results" v-bind:key="result.IDproduct">
                  <a :href="result.url">{{result.name}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      url_base: 'https://demo.panx.dev/search.php',
      query: '',
      results: {},
    }
  },
  methods: {
    fetchResults () {
      this.setResult({});
      fetch(`${this.url_base}?q=${this.query}`)
        .then(res => {
          return res.json();
        }).then(this.setResult)
    },

    setResult(result) {
      this.results = result;
    },

  }
}
</script>

<style>
  h1 {
    color: white;
  }

  body {
    background: linear-gradient(45deg, black, var(--dark))
  }

  .center {
    margin: auto;
    text-align: center;
  }

  .search-box:focus-within .search-result {
    display: block !important;
    opacity: 1;
  }
</style>
