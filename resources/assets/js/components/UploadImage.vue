<style>
    .layout{
        box-sizing: border-box;
    }
    .upload{
        margin:auto;
        padding:10px;
        background-color: #fff;
        /*background:#fbfbfb;*/
        border:1px solid #ddd;
        line-height: 200px;
        text-align: center;
        border-radius:2px;
        color:#999;
    }
</style>
<template>
    <div class="layout">
        <div class="upload" :style="{width:upload.width+'px',height:upload.height+'px'}">
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
    </div>
</template>

<script>
    import upload from "./upload.vue"

    export default {
        props: {
            // Server host,like "http://jinzhe.net"
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
            }
        },
        components:{
            upload
        },
        data() {
            return {
                upload:{
                    header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    file:"",
                    preview:true,
                    crop:true,
                    width:600,
                    height:parseInt(600*this.ratio),
                    cancel:"取消",
                    ok:"裁剪",
                    success:(data)=>{
                        if(data.responseCode == 1) {
                            this.upload.file = data.data.path;
                        }
                    }
                },
            }
        }
    }
</script>