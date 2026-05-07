
<div id="uploadImageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center overflow-y-hidden">   
    <div class="bg-white flex flex-col items-center justify-center w-full h-96">      

        <input type="file" accept="image/*" @change="processUpload">
        <div x-show="imageUrl" class="mt-4" style="max-width: 500px;">
            <img x-ref="imageElement" :src="imageUrl" class="max-w-full">
        </div>
        <div x-show="imageUrl" class="mt-4 space-x-2">
            <button @click="cropImage" class="bg-blue-500 text-white px-4 py-2 rounded">Crop Image</button>
            <button @click="reset" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
        </div>
        <template x-if="croppedImageUrl">
            <div class="mt-6">
                <p class="font-bold">Cropped Result:</p>
                <img :src="croppedImageUrl" class="border p-2">
            </div>
        </template>
         
    </div>    
</div>