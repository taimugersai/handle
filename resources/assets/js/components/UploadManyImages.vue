<style>
    .layout{
        box-sizing: border-box;
    }
    .upload-images{
        margin: auto;
        padding:10px;
        background-color: #fff;
        /*background:#fbfbfb;*/
        border:1px solid #ddd;
        line-height: 200px;
        text-align: center;
        border-radius:2px;
        color:#999;
    }
    .item-images {
        position: relative;
        float: left;
        margin-right: 10px;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .item-images i {
        position: absolute;
        color: red;
        font-size: 2rem;
        right: 5px;
        top: 5px;
    }
</style>
<template>
    <div class="layout">
        <div class="upload-images" :style="{width:upload.width+'px',height:upload.height+'px'}">
            <upload
                    :header="upload.header"
                    :url="url"
                    :filename="filename"
                    :file="upload.file"
                    :preview="upload.preview"
                    :success="upload.success"
                    :file.sync="upload.file"
                    :crop="upload.crop"
                    :width="upload.width"
                    :height="upload.height"
                    :ok="upload.ok"
                    :cancel="upload.cancel">
                <img src="./upload.svg">
            </upload>
        </div>
        <div class="preview" v-if="!upload.crop&&upload.multiple&&upload.file!=''">
            <div class="item-images" v-for="(file, index) in files" :style="{'width':upload.width+'px','height':upload.height+'px','background-image':'url('+file+')'}">
                <i class="fa fa-trash" @click="deleteImage(index)"></i>
            </div>
        </div>
    </div>
</template>

<script>
    import upload from "./upload.vue"

    export default {
        props: {
            filename: {
                type: String,
                require: true
            },
            url: {
                type: String,
                require: true
            },
            ratio: {
                type: String,
                default:'1'
            },
            file: {
                type:String,
                default:''
            }
        },
        components:{
            upload
        },
        computed: {
            // a computed getter
            files: function () {
                // `this` points to the vm instance
                return this.upload.file.split(',');
            }
        },
        data() {
            return {
                upload:{
                    header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    file:this.file,
                    preview:true,
                    crop:false,
                    width: 300,
                    height: parseInt(300*this.ratio),
                    multiple:true,
                    success:(data)=>{
                        if(data.responseCode == 1) {
                            if(this.upload.file == '') {
                                this.upload.file = data.data.path;
                            }else {
                                this.upload.file += ','+data.data.path;
                            }
                        }
                    }
                },
            }
        },
        methods:{
            deleteImage(index) {
                this.files.splice(index, 1);
                this.upload.file = this.files.join(',');
            }
        }
    }
</script>