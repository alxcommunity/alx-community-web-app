<template>
  <div id="app">
    <div class="reveal">
      <div class="slides">
        <section data-markdown>
          <textarea data-template>
            # Slide 1
            > A paragraph with some text and a [link](http://hakim.se).
          </textarea>
        </section>
        <section data-markdown>
          <textarea data-template>
            ```js [1-2|3|4]
            let a = 1;
            let b = 2;
            let c = x => 1 + 2 + x;
            c(3);
            ```
          </textarea>
        </section>
        <section>Slide 1</section>
        <section>Slide 2</section>
      </div>
    </div>
  </div>
</template>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/reveal.js/3.6.0/js/reveal.js"></script> -->
<style>
  @import "../../revealcss.css";
</style>

<script>

import Reveal from 'reveal.js';
import Markdown from 'reveal.js/plugin/markdown/markdown.esm.js';



export default {
  name: "App",
  mounted() {

    let deck = new Reveal({
   plugins: [ Markdown ]
    })
deck.initialize();

  },
  methods: {
    loadReveal() {
    Reveal.initialize();
  }
  },
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  height: 90vh;
  /* background: #000; */
}
</style>
