
<div id="uploadImageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center overflow-y-hidden">   
    <div class="bg-white flex flex-col items-center justify-center">        
        <div>
            <label for="photoFile" class="bg-blue-500 text-white border-1 rounded-md p-3 cursor-pointer">
                Click to select an image here
            </label>
            <input id="photoFile" accept="image/*" type="file" @change="processUpload" class="hidden">  
        </div>
         <!-- <canvas id="uploadedPicture"></canvas>                   -->
         <img id="uploadedPicture" src="" alt="">          
    </div>    
</div>