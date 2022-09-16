<template>
 <div class="reveal h-full">
      <div class="slides h-full">
        <section data-markdown>
          <textarea data-template>
               ## welcome fiba
               A paragraph with some text and a [link](http://hakim.se).
               ---

               ## new day
               ---

               ## Slide 3
          </textarea>
        </section>
        <section data-markdown>
          <textarea data-template>
            ## ALXCOMMUNITY @2022
          </textarea>
        </section>

      </div>
    </div>
</template>



<script>
  import Reveal from "reveal.js";
  import Markdown from "reveal.js/plugin/markdown/markdown.js";
     import Highlight from "reveal.js/plugin/highlight/highlight.js";
     export default {
       mounted() {
         if (true) {
           this.loadReveal()
          }
          console.log(Reveal.plugins)
        },
        
        onBeforeUnmount()  {
          
          
          
          Reveal.initialize({
            
          });
        },
       data() {
        return {
          isPluginInit: false
        }
       },
       methods: {
         loadReveal() {
           Reveal.initialize({
             plugins: [Markdown, Highlight ],
             markdown: {
               breaks: true,
               gfm: true,
              },
            });
         this.isPluginInit = true
        }
       }

     };
     </script>

<style scoped  src="reveal.js/dist/reveal.css"></style>
<style scoped  src="reveal.js/dist/theme/white.css"></style>
<style scoped  src="reveal.js/plugin/highlight/monokai.css"></style>

