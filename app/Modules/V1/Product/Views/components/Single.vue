<template>
    <form @submit.prevent="submit">
        <div class="container mt-5">   
            <div class="form-group row">

                                            <!-- Title Categories -->
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Title" v-model="field.title">
                    <div v-if="errors && errors.title"  class="text-danger">{{ errors.title[0] }}</div>
                </div>
                
                                            <!-- Main Categories -->
                <div class="col-md-4">
                    <select class="form-control select2" style="" @change="mainCategoryChange">
                        <option value="">Select Parent Category</option>
                        <option  v-for="(option, i) of main_categories" :key="i" :value="option.id">{{ option.title }}</option>
                    </select>
                    <div v-if="errors && errors.main_category" class="text-danger">{{ errors.main_category[0] }}</div>
                </div>
                                            <!-- Sub Categories -->
                  <div class="col-md-4">
                    <select class="form-control select2" style="" @change="subCategoryChange" :disabled="sub_categories_disable == 1">
                        <option value="">Select Child Category</option>
                        <option  v-for="(option, i) of sub_categories" :key="i" :value="option.id">{{ option.title }}</option>
                    </select>
                    <div v-if="errors && errors.sub_categories" class="text-danger">{{ errors.sub_categories[0] }}</div>
                  </div>

                </div>
                 <div class="form-group row">
                    <div class="col-md-4">
                        <label for="exampleInputFile">Product Image</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" @change="onFileChange" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <!-- <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div> -->
                        <!-- <img :src="image" /> -->
                        </div>
                        <p v-if="errors && errors.image"  class="text-danger">{{ errors.image[0] }}</p>
                    </div>

                     <div class="col-md-4">
                        <label for="exampleInputFile">Price</label>
                         <input type="number" class="form-control" placeholder="Price" v-model="field.price" >
                        <div v-if="errors && errors.price"  class="text-danger">{{ errors.price[0] }}</div>
                    </div>
                     <div class="col-md-4">
                        <label for="exampleInputFile">Quantity</label>
                         <input type="number" class="form-control" v-model="field.quantity" placeholder="Quantity" >
                        <div v-if="errors && errors.quantity"  class="text-danger">{{ errors.quantity[0] }}</div>
                    </div>
                 </div>
                  <div class="form-group row">
                    <div class="col-md-12">
                        <label for="exampleInputFile">Description</label>
                        <textarea class="form-control" name="description" v-model="field.description"></textarea>
                        <div v-if="errors && errors.description"  class="text-danger">{{ errors.description[0] }}</div>
                    </div>
                 </div>
            </div>
            <button type="submit" class="btn btn-primary" style="float:right;">Save Product</button>
        </div>
    </form>

</template>

<script>
                        /*Get Variable from Laravel Blade file*/
    var CONST_MAIN_CATEGORIES_ARRAY = JSON.parse(CONST_MAIN_CATEGORIES.replace(/&quot;/g,'"'));
    
    export default {
         data(){
            return {
                errors: {},
                field:{},
                // Main Categories
                main_categories:CONST_MAIN_CATEGORIES_ARRAY,
                //Sub Categories
                sub_categories:[],
                sub_categories_disable : 1,
                //features
                image:'',
                file_object:{},
                
            }
         },
         mounted(){
         },
         components:{
         },
         methods:{
            
            //  Main Category Change
            mainCategoryChange(event){
                var vm = this;
                vm.sub_categories = [];
                vm.sub_categories_disable = 1;
                console.log(event.target.value);
                this.field.main_category = event.target.value;
                if(event.target.value != ''){
                    this.getSubCategoryChange(event.target.value).then(function(response){
                        console.log(response.data.data);
                        if(response.data.data.length > 0 && response.data.success==true){
                            vm.sub_categories = response.data.data;
                            console.log(vm.sub_categories);
                            vm.sub_categories_disable = 0;
                        }else{
                            vm.errors.sub_categories = response.data.message;
                        }
                    });
                }
            },
            async getSubCategoryChange(id){
                try {
                    var params = new URLSearchParams();
                    params.append('id', id);
                    const response = await this.$http.post(CONST_GET_SUBCATEGORY_ROUTE,params);
                    return response;
                } catch (error) {
                    return error;
                }
            }
            ,
            
            // SubCategory Change
            subCategoryChange(event){
                console.log(event.target.value);
                this.field.subcategory = event.target.value;
                 var vm = this;
                console.log(event.target.value);
                if(event.target.value != ''){
                    this.getFeatureData(event.target.value).then(function(response){
                        console.log(response);
                        if(response.data.data.length > 0 && response.data.success==true){
                            vm.features = response.data.data;
                            console.log(vm.features);
                        }else{
                            vm.errors.features = response.data.message;
                        }
                    });
                }
            },
            async getFeatureData(id){
                try {
                    var params = new URLSearchParams();
                    params.append('id', id);
                    const response = await this.$http.post(CONST_GET_FEATURE_ROUTE,params);
                    return response;
                } catch (error) {
                    return error;
                }
            },

            // Submit Form
            submit(){
                this.errors = {};
                //  console.log(this.file_object);
                /* Validations */   
                if(this.field.title == '' || this.field.title == undefined){
                    this.errors.title = ['Please Fill The Title'];
                }else{
                    this.errors.title = [''];
                }
                if(this.field.main_category == '' || this.field.main_category == undefined){
                    this.errors.main_category = ['Please Select Main Category'];
                }else{
                    this.errors.main_category = [''];
                }
                if(this.field.subcategory == '' || this.field.subcategory == undefined){
                    this.errors.sub_categories = ['Please Select Sub Category'];
                }else{
                    this.errors.sub_categories = [''];
                }
                if(this.field.quantity == '' || this.field.quantity == undefined){
                    this.errors.quantity = ['Please Enter Quantity'];
                }else{
                    this.errors.quantity = [''];
                }
                if(this.field.price == '' || this.field.price == undefined){
                    this.errors.price = ['Please Fill The Price'];
                }else{
                    this.errors.price = [''];
                }
                if(this.field.description == '' || this.field.description == undefined){
                    this.errors.description = ['Please Fill The Description'];
                }else{
                    this.errors.description = [''];
                }
                if(this.file_object.name == undefined){
                    this.errors.image = ['Please Select Image'];
                }else{
                    this.errors.image = [''];
                }
                // console.log(this.errors,Object.keys(this.errors).length);
                if(!this.errors
                    || Object.keys(this.errors).length != 0
                    || Object.getPrototypeOf(this.errors) != Object.prototype){
                    return ;
                }else{
                    
                    this.field.file_data = this.file_object;
                    let rawData = this.field;
                    let formData = new FormData()
                    formData.append('image', this.file_object)
                    // formData.append('data', rawData)
                    formData.append('title', this.field.title)
                    formData.append('main_category', this.field.main_category)
                    formData.append('subcategory', this.field.subcategory)
                    formData.append('price', this.field.price)
                    formData.append('description', this.field.description)
                    formData.append('quantity', this.field.quantity)
                    
                    var vm = this;
                    axios.post(CONST_GET_SINGLE_PRODUCT_ADD_ROUTE, formData,{ headers: {
                       'Content-Type': 'multipart/form-data'
                    }}).then(response => {
                        console.log(response);
                        if(response.data.success == false){
                            vm.errors = response.data.data;
                        }else{
                            alert('Simple Product Added Successfully');
                            window.location.href = CONST_GET_PRODUCT_INDEXING_ROUTE;
                        }
                    }).catch(error => {
                        if (error.response.status === 422) {
                         this.errors = error.response.data.errors || {};
                        }
                    });
                }
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                this.file_object = files[0];
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;
                console.log(file);
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
         },
    }
</script>




