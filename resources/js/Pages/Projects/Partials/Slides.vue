<template>
    <div id="app" ref="wrapper">
        <div class="reveal">
            <div class="slides">
                <section data-markdown data-separator="^\n\n\n"
         		data-separator-vertical="^\n\n">
                    <textarea data-template>
    			        {{project.overview}} 
                      </textarea>
                </section>
                <section data-markdown>
                    <textarea data-template>
                    @ALX COMMUNITY
                    </textarea
                    >
                </section>
            </div>
        </div>
    </div>
</template>
<script>
import Reveal from "reveal.js";
import Markdown from "reveal.js/plugin/markdown/markdown.esm.js";

export default {
    props: ['project'],
    async beforeUnmount() {
        this.rep = null;
    },
    async mounted() {
        console.log(this.$el.querySelector("section"));
        console.log();
        if (!this.rep) {
            this.rep = new Reveal({
                plugins: [Markdown],
            });
            this.rep.initialize();
        }
    },

    data() {
        return {
            rep: null,
        };
    },
};
</script>

<style src="reveal.js/dist/reveal.css"></style>
<style src="reveal.js/dist/theme/white.css"></style>

<style>
#app {
    height: 100vh;
    background: #f3f4f6;
    overflow-y: auto;
}
</style>
