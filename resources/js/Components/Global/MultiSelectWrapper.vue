<template>
    <div class="form-input w-full flex flex-wrap sm:text-sm sm:leading-5">
        <span
            v-for="(tag, index) in selected"
            :key="unique+'-tag-'+index"
        >
            <slot name="tags" :index="index" :tag="tag" :remove="remove" />
        </span>

        <input :id="unique"
            v-model="current"
            type="text"
            class="appearance-none focus:outline-none text-grey text-sm w-1/4"
            :class="{ 'duplicate-warning' : duplicateFlag }"
            :placeholder="placeholder"
            @keyup="search"
            @keyup.enter="select()"
            @keydown.tab.stop.prevent="select"
            @keydown.up="changeIndex( 'up' )"
            @keydown.delete="backspace()"
            @keydown.down="changeIndex( 'down' )"
        >

        <div
            v-show="showAutocomplete"
            class="absolute text-left z-50 cursor-pointer bg-white pt-5px pb-5px shadow border border-input border-1px z-top overflow-y-auto max-h-40 max-w-40"
        >
            <div
                v-for="(result, index) in results"
                :key="unique+'-'+index"
                @click.stop="selectFromAutocomplete( result )"
            >
                <slot name="autocomplete" :result="result" />
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../../event-bus.js';
import TagsAPI from '../../api/tags.js';
const debounce = require('lodash.debounce')

export default {
    /*
        unique - The unique identifier so we can hook into the proper events
        placeholder - Placeholder for the input element
        allowNew - Determines if we should allow new tags that aren't from the API
        allowDuplicates - Determines if we should allow duplicate tags or not

    */
    props: [
        'unique',
        'placeholder',
        'allowNew',
        'allowDuplicates',
        'existingTags'
    ],

    /*
        current - The current tag being searched for
        existingSelectedTag - The tag selected from the autocomplete
        selected - The collection of selected elements
        results - The search results returned from the API
        duplicateFlag - Determines if the selected element is a duplicate.
        notAllowNew - Flag if someone is trying to create a tag that doesn't exit
    */
    data () {
        return {
            current: '',
            existingSelectedTag: null,
            selected: [],
            results: [],
            duplicateFlag: false,
            notAllowNew: false
        }
    },

    mounted(){
        this.initializeTags();
    },

    computed: {
        showAutocomplete () {
            return this.results.length != 0 && this.current != '';
        }
    },

    methods: {
        initializeTags(){
            if( this.existingTags ){
                this.selected = this.existingTags;
                this.fireUpdate();
            }
        },

        search: debounce(async function ( e ) {
            const noSearchKeys = ['ArrowDown', 'ArrowUp', 'Enter']

            if (!noSearchKeys.includes(e.key)) {
                let tags = await TagsAPI.index({
                    search: this.current
                });

                this.results = tags.data;
            }
        }, 300),

        select () {
            if (this.existingSelectedTag == null && this.allowNew) {
                this.createNewTag();
            } else if (this.existingSelectedTag == null && !this.allowNew) {
                // Display error
            } else {
                this.appendSelectedTag();
            }
        },

        selectFromAutocomplete( tag ){
            this.existingSelectedTag = tag;
            this.select();
        },

        createNewTag(){
            if (this.current != '') {
                this.selected.push({
                    name: this.cleanTagName(this.current)
                });

                this.resetSearch()
                this.fireUpdate()
            }
        },

        appendSelectedTag(){
            this.selected.push(this.existingSelectedTag)

            this.resetSearch()
            this.fireUpdate()
        },

        resetSearch () {
            this.current = '';
            this.existingSelectedTag = null;
            this.results = [];
        },

        backspace () {
            if (this.current == '') {
                this.selected.pop()

                this.fireUpdate()
            }
        },

        changeIndex (direction) {

        },

        remove (index) {
            this.selected.splice(index, 1)

            this.fireUpdate()
        },

        fireUpdate () {
            EventBus.emit('tags-changed', {
                id: this.unique,
                tags: this.selected
            });
        },

        cleanTagName (tagName) {
            let cleanTag = tagName.toLowerCase()

            cleanTag = cleanTag.trim().replace(/[^a-zA-Z0-9]/g, '-')
            cleanTag = cleanTag.replace(/-{2,}/, '-')
            cleanTag = this.trimCharacter(cleanTag, '-')

            return cleanTag
        },

        trimCharacter (string, character) {
            if (character === ']') c = '\\]'
            if (character === '\\') c = '\\\\'
            return string.replace(new RegExp(
                '^[' + character + ']+|[' + character + ']+$', 'g'
            ), '')
        },

        focusTagInput () {
            document.getElementById(this.unique).focus()
        }
    }
}
</script>
