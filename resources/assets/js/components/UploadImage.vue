<template>
    <label :for="name" class="upload-image" :style="{background-image:url(path)}">
        <input :id="name" :name="name" type="file" accept="image/*">
    </label>
</template>

<script>
    export default {
        props: ['name', 'url', 'path'],
        mounted() {
            var self = this;
            $('#'+self.name).fileupload({
                url: self.url,
                formData:{uploadField:self.name},
                dataType: 'json',
                done: function (e, data) {
                    if(data.result.responseCode == '1' ){
                        self.path = data.result.data.path;
                        hiToast("上传成功",{position:'300', duration: 2000});
                    }else {
                        hiToast(data.result.responseMsg,{position:'300', duration: 2000});
                    }
                }
            })
        }
    }
</script>
