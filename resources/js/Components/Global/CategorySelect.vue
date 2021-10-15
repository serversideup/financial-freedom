<template>
    <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
        <option value=""></option>
        <option v-for="category in flattened"
            :key="'category-'+category.id"
            v-bind:value="category.id"
            v-text="category.name"/>
    </select>
</template>

<script>

export default {
    computed: {
        flattened(){
            let flattened = [];

            for( let i = 0; i < this.$page.props.categories.length; i++ ){
                let category = JSON.parse( JSON.stringify( this.$page.props.categories[i] ) );
                let subCategories = JSON.parse( JSON.stringify( this.$page.props.categories[i].sub_categories ) );

                category.sub_categories = null;

                flattened.push( category );

                for( let k = 0; k < subCategories.length; k++ ){
                    flattened.push( subCategories[k] );
                }
            }

            return flattened;
        }
    }
}
</script>