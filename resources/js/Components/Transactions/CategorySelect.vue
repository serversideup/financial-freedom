<template>
    <div class="relative">
        <input type="text" 
              @focus="prepareInput()"
              @keypress="filter()"
              @keyup.down="incrementActiveIndex()"
              @keyup.up="decrementActiveIndex()"
              @keydown.enter.prevent="selectCategory()"
              v-model="search" 
              class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300"/>

        <div v-if="showResults" class="absolute max-h-60 w-96 overflow-y-scroll bg-white z-50 shadow-sm rounded-md border border-gray-300">
            <div class="p-2 group cursor-pointer flex items-center hover:bg-blue-600 hover:text-white"
                v-for="( category, categoryIdx ) in filteredCategories"
                v-bind:key="category.id"
                v-bind:class="{
                    'bg-blue-600': activeIndex == categoryIdx,
                    'text-white': activeIndex == categoryIdx     
                }"
                @click="selectCategory( categoryIdx )">
                    <svg v-show="category.parent_id"
                         v-bind:class="{
                            'fill-white': activeIndex == categoryIdx,
                            'fill-gray-500': activeIndex != categoryIdx 
                         }"
                         class="ml-5 mr-1 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 32 32"><path d="M 5 5 L 5 22 L 24.0625 22 L 19.78125 26.28125 L 21.21875 27.71875 L 27.21875 21.71875 L 27.90625 21 L 27.21875 20.28125 L 21.21875 14.28125 L 19.78125 15.71875 L 24.0625 20 L 7 20 L 7 5 Z"></path></svg>
                    {{ category.name }}
                </div>
        </div>
    </div>
</template>

<script>
/**
 * - Focus show,
 * - tab select and hide
 * - click select and hide
 * - blur? nothing for now
 * - enter select and hide
 * - up nav, up
 * - down nav, down
 */
export default {
    props: {
        modelValue: String
    },

    emits: ['update:modelValue'],

    data(){
        return {
            search: '',
            showResults: false,
            filteredCategories: [],
            activeIndex: 0,
            selectedCategory: {}
        }
    },

    mounted(){
        this.filteredCategories = this.$page.props.categories
    },

    watch: {
        search(){
            // Handles deletion from the field
            if( this.search == '' ){
                this.selectedCategory = {};
                this.filter();
            }
        }
    },

    methods: {
        selectCategory( index = null ){
            if( !index ){
                this.selectedCategory = this.filteredCategories[ this.activeIndex ];
            }else{
                this.selectedCategory = this.filteredCategories[ index ];
            }

            this.search = this.selectedCategory.name;
            this.filteredCategories = [];
            this.activeIndex = 0;
            this.showResults = false;
            this.$emit('update:modelValue', this.selectedCategory.id);
        },

        prepareInput(){
            this.activeIndex = 0;
            this.showResults = true;
            this.search = '';
            this.filter();
            this.$emit('update:modelValue', "");
        },

        filter(){
            this.activeIndex = 0;

            if( this.search != '' ){
                this.filteredCategories = this.filteredCategories.filter( function( category ){
                    let name = category.name.toLowerCase();
                    return name.search( this.search.toLowerCase() ) > -1;
                }.bind(this));
            }else{
                this.filteredCategories = this.$page.props.categories;
            }
        },

        incrementActiveIndex(){
            if( this.activeIndex + 1 < this.filteredCategories.length ){
                this.activeIndex = this.activeIndex + 1;
            }
        },

        decrementActiveIndex(){
            if( this.activeIndex - 1 >= 0 ){
                this.activeIndex--;
            }
        },
    }
}
</script>