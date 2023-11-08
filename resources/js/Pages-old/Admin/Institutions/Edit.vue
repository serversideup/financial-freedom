<template>
    <app-layout>
        <div class="flex flex-col">
            <main class="flex-1 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="relative max-w-4xl mx-auto md:px-8 xl:px-0">
                    <div class="pt-10 pb-16">
                        <div class="px-4 sm:px-6 md:px-0">
                            <h1 class="text-3xl leading-9 font-extrabold text-gray-900">Platform Settings</h1>
                        </div>
                        
                        <admin-nav/>
                        
                        <div class="mt-5 space-y-6 divide-y divide-gray-200">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ institution.name }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                                    Manage institution settings.
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="institution_name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                        Name
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                                            <input v-model="form.institution_name" id="institution_name" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="photo" class="block text-sm leading-5 font-medium text-gray-700">
                                        Logo
                                    </label>
                                    <div class="mt-2 sm:mt-0 sm:col-span-2">
                                        <div class="flex items-center">
                                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                                <img v-show="showInstitutionImagePreview" :src="institutionImagePreview" class="w-full h-full rounded-full"/>
                                                <svg v-show="!showInstitutionImagePreview" class="h-full w-full text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                            </span>
                                            <span class="ml-5 rounded-md shadow-sm">
                                                <input ref="institutionImageFile" v-on:change="handleInstitutionImageUpload()" accept="image/*" id="institutionImage" name="institution-image" style="position: absolute; top: -500px;" type="file"/>
                                                <button v-on:click="chooseInstitutionImage()" type="button" class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                                    Change
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 border-t border-gray-200 pt-5">
                                    <div class="flex justify-end">
                                        <span class="inline-flex rounded-md shadow-sm">
                                            <Link href="/admin/institutions/" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                                Cancel
                                            </Link>
                                        </span>
                                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                                            <button type="button" v-on:click="update()" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                                                Update
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 space-y-6 divide-y divide-gray-200">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    CSV Header Mappings
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                                    Manage mappings for importing from a CSV
                                </p>
                            </div>
                            <div class="mt-6 sm:mt-5">
                                
                                
                                <div class="mt-8 border-t border-gray-200 pt-5">
                                    <div class="flex justify-end">

                                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                                            <button type="button" v-on:click="update()" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                                                Update
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
        			</div>
      			</div>
			</main>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        props: [
            'institution',
            'csrf'
        ],

        data(){
            return {
                showInstitutionImagePreview: false,
                institutionImagePreview: '',

                form: {
                    institution_name: '',
                    logo: ''
                },

                headerMappings: {

                },

                transactionNames: []
            }
        },

        mounted(){
            this.form.institution_name = this.institution.name;
            this.institutionImagePreview = this.institution.logo !="NULL"  ? this.institution.logo : false;
            this.showInstitutionImagePreview = this.institution.logo != "NULL" ? true : false;
        },

        components: {
            AppLayout,
            Link
        },

        methods: {
            update(){
                let formData = new FormData();

                formData.append( 'institution_name', this.form.institution_name );
                formData.append( 'logo', this.form.logo[0] );
                formData.append( '_method', 'PUT' );
                formData.append( '_token', this.csrf );

                this.$inertia.post( '/admin/institutions/'+this.institution.id, formData );
            },

            chooseInstitutionImage(){
                this.$refs.institutionImageFile.click();
            },

            handleInstitutionImageUpload(){
                this.form.logo = this.$refs.institutionImageFile.files;

                let reader = new FileReader();

                reader.addEventListener("load", function(){
                    this.showInstitutionImagePreview = true;
                    this.institutionImagePreview = reader.result;
                }.bind(this), false );

                if( this.form.logo ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.form.logo[0].name ) ) {
                        reader.readAsDataURL( this.form.logo[0] );
                    }
                }
            },

            updateHeaderMappings(){

            },

            updateTransactionNameRules(){

            }
        }
    }
</script>