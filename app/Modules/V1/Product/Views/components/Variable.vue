<template>
    <form @submit.prevent="submit">
     <div class="form-group d-flex" style="float:right;" v-if="checked_features.length > 0">
                 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                    <span class=""><i class="fas fa-plus-square"></i> Add Feature Value</span>
                </button>
        </div>
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
                <div class="form-group" style="margin-top:20px;" v-show="feature_disable == 0">
                  
                    <div class="col-md-12">
                    <div class="col-md-8">
                    <label>Select Features</label>
                        <select class="select2 select2-temp" multiple="multiple" :v-model="feature_selected" data-placeholder="Select Features" style="width: 100%;" @change="checkFeatureChange">
                            <option v-for="(feature,i) of features" :key="i" :value="feature.id">{{feature.title}}</option>
                        </select> 
                    <div v-if="errors && errors.feature_selected" class="text-danger">{{ errors.feature_selected[0] }}</div>
                    </div>
                        <div class="col-md-4">
                        <label for="exampleInputFile">Feature Price Value</label>
                        <div class="card-body custom-pricefeature">
                           <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div v-if="errors && errors.feature_price_value" class="text-danger">{{ errors.feature_price_value[0] }}</div>
                        </div>  
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
                  <button type="submit" class="btn btn-primary" style="float:right;">Save Product</button>

        </div>
            <!-- MODAL DATA -->
            <!-- <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="col-md-12">
                            <label>Quantity</label>
                            <input type="number" class="form-control" placeholder="Feature Value Quantity" required>
                        </div>
                        <div class="col-md-12">
                            <label>Price</label>
                            <input type="number" class="form-control" placeholder="Feature Value Price" required>
                        </div>
                        <div class="img-ctm col-md-12 mt-3">
                            <label for="exampleInputFile">Product Feature Value Image (400 x 400)</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div> -->
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
                // Main Categories
                main_categories:CONST_MAIN_CATEGORIES_ARRAY,
                //Sub Categories
                sub_categories:[],
                sub_categories_disable : 1,
                feature_disable:1,
                value: [],
                //features
                features:[],
                checked_features:[],
                checked_features_variable_option:[],
                checked_features_simple_option:[],
                feature_selected:0,
                // errors: {},
                field:{},
                //features
                image:'',
                file_object:{},
            }
         },
         mounted(){
              $("input[data-bootstrap-switch]").each(function(){
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                }); 
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
            },
            
            
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
                var vm = this;
                try {
                    var params = new URLSearchParams();
                    params.append('id', id);
                    const response = await this.$http.post(CONST_GET_FEATURE_ROUTE,params);
                    vm.feature_disable = 0;
                    $('.select2').select2();

                    return response;
                } catch (error) {
                    return error;
                }
            },

            //feature handling
            checkedFeatures(id){
                if(this.checked_features.indexOf(id) !== -1){
                    return true;
                }else{
                    return false;
                }  
            },

            //simple,variable product
            checkSimpleProduct(id){
                if(this.checked_features_simple_option.indexOf(id) !== -1){
                    return true;
                }else{
                    return false;
                }
            },
            getFeatureDropdownData(feature_id){
                feature_id = feature_id.replace('_variable','');
                // console.log(feature_id);
                var items = this.features;
                var result = {}
                Object.keys(items).forEach(key => {
                    const item = items[key]
                    if (item.id == feature_id) {
                        result = item
                    }
                    // console.log(result);
                })
                console.log(result);
                return result.feature_value;
            },
            checkFeatureChange(){
                console.log("here");
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                this.file_object = files[0];
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            submit(){

                this.errors = {};
                //  console.log(this.file_object);
                /* Validations */   
                if(this.field.title == '' || this.field.title == undefined){
                    this.errors.title = ['Please Fill The Title'];
                }else{
                    delete this.errors.title;
                }
                if(this.field.main_category == '' || this.field.main_category == undefined){
                    this.errors.main_category = ['Please Select Main Category'];
                }else{
                this.field.feature_selected = $(".select2-temp").select2('val');
                    delete this.errors.main_category;
                }
                if(this.field.subcategory == '' || this.field.subcategory == undefined){
                    this.errors.sub_categories = ['Please Select Sub Category'];
                }else{
                    delete this.errors.sub_categories;
                }
                if(this.field.quantity == '' || this.field.quantity == undefined){
                    this.errors.quantity = ['Please Enter Quantity'];
                }else{
                    delete this.errors.quantity ;
                }
                if(this.field.price == '' || this.field.price == undefined){
                    this.errors.price = ['Please Fill The Price'];
                }else{
                    delete this.errors.price ;
                }
                if(this.field.description == '' || this.field.description == undefined){
                    this.errors.description = ['Please Fill The Description'];
                }else{
                    delete this.errors.description ;
                }

                if(this.feature_disable == 0){
                    this.field.feature_selected = $(".select2-temp").select2('val');
                }
                if(this.field.feature_selected == '' || this.field.feature_selected == undefined){
                    this.errors.feature_selected = ['Please Fill The Description'];
                }else{
                    delete this.errors.feature_selected;
                }
                if(this.file_object.name == undefined){
                    this.errors.image = ['Please Select Image'];
                }else{
                    delete this.errors.image;
                }

                console.log(this.errors,Object.keys(this.errors).length);
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
                     if($('.custom-pricefeature').find('div.bootstrap-switch-on').length !== 0){
                            console.log("Button ON");
                            formData.append('feature_price_value', 1)
                     }
                    formData.append('feature_selected', this.field.feature_selected)
                    
                    var vm = this;
                    let product_id='';
                    let features_array = '';
                    axios.post(CONST_GET_VARIABLE_PRODUCT_ADD_ROUTE, formData,{ headers: {
                       'Content-Type': 'multipart/form-data'
                    }}).then(response => {
                        console.log(response);
                        if(response.data.success == false){
                            vm.errors = response.data.data;
                            return;
                        }else{
                            // alert('Simple Product Added Successfully');
                             product_id = response.data.data.product_id;
                             features_array = JSON.stringify(response.data.data.feature_selected);
                             let path = CONST_GET_VARIABLE_PRODUCT_FEATURE_ROUTE+'?product_id='+product_id+"&feature_selected="+features_array;
                              window.open(path);
                        }

                    }).catch(error => {
                        console.log('error => '+error);
                    });
                }
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




