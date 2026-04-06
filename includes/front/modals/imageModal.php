<div x-data="imageCropper()" id="imageModal" class="hidden">
    <!-- 1. Video Stream for Preview -->
    <video x-ref="video" autoplay playsinline class="w-full max-w-md"></video>
    <button @click="capturePhoto" class="bg-blue-500 px-3 py-2">Capture & Crop</button>

    <!-- 2. Cropping Container -->
    <div x-show="imageUrl" class="mt-4">
        <div style="max-width: 500px;">
            <img x-ref="image" :src="imageUrl" class="block max-w-full">
        </div>
        <button @click="saveCrop">Save Cropped Image</button>
    </div>
</div>

<script>
function imageCropper() {
    return {
        imageUrl: null,
        cropper: null,
        
        async init() {
            // Setup camera stream
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            this.$refs.video.srcObject = stream;
        },

        async capturePhoto() {
            const track = this.$refs.video.srcObject.getVideoTracks()[0];
            const imageCapture = new ImageCapture(track);
            
            // Capture Blob from API
            const blob = await imageCapture.takePhoto();
            this.imageUrl = URL.createObjectURL(blob);

            // Wait for DOM update, then init Cropper
            this.$nextTick(() => {
                if (this.cropper) this.cropper.destroy();
                this.cropper = new Cropper(this.$refs.image, {
                    aspectRatio: 1,  
                    initialAspectRatio: 1,        
                    viewMode: 1,          
                    autoCropArea: 1,
                    cropBoxResizable: false,
                    data: {
                        width: 100, 
                        height: 80, 
                    },
                    ready() {
                        this.cropper.setCropBoxData({ width: 100, height: 80 });
                    }
                });
            });
        },

        downloadSameOrigin(imgUrl, fileName) {
            const link = document.createElement('a');
            link.href = imgUrl;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },		

        saveCrop() {
            // Get cropped data as a new Blob or DataURL
            const canvas = this.cropper.getCroppedCanvas({ width: 100, height: 80 });
            const croppedData = canvas.toDataURL('image/jpeg');
            this.downloadSameOrigin(croppedData, 'myPic.jpg');
            console.log('Cropped Image:', croppedData);
        }
    };
}
</script>
