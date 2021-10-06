<template>
	<multi-select-wrapper
		:unique="unique"
		:allow-new="true"
		:allow-duplicates="false"
		:existing-tags="existing"
	>
    	<template v-slot:tags="{ index, tag, remove }">
			<span
				class="inline-block rounded-md mr-1 py-px px-2 font-sans text-xs border"
				:class="[
					tag.color != undefined ? 'bg-'+tag.color+'-100' : 'bg-gray-100',
					tag.color != undefined ? 'text-'+tag.color+'-800' : 'text-gray-800',
				]"
			>
				{{ tag.name }}
				<span class="cursor-pointer" @click.stop="remove( index )">&times;</span>
      		</span>
   		</template>

    	<template v-slot:autocomplete="{ result }">
      		<div class="py-1 px-2 font-sm font-sans bg-white hover:bg-gray-100">
        		<span class="w-2 h-2 inline-block mr-2 rounded-full" :class="'bg-'+result.color+'-500'" />{{ result.name }}
      		</div>
    	</template>
  	</multi-select-wrapper>
</template>

<script>
import MultiSelectWrapper from '../Global/MultiSelectWrapper.vue'
import { EventBus } from '../../event-bus.js'

export default {

    components: {
        MultiSelectWrapper
    },

    props: ['unique', 'existing'],

    data () {
        return {
            tags: []
        }
    },

    mounted () {
        EventBus.on('tags-changed', function (data) {
            if (data.id == this.unique) {
                this.tags = data.tags
            }
		}.bind(this) );
	}
}
</script>
