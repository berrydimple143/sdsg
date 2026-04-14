<form @submit.prevent="submit" class="max-w-7xl mx-auto bg-green-600 px-4 py-3 shadow-2xl">
    <div class="mb-2">
            <p class="text-center text-white text-2xl uppercase text-shadow-lg bg-gradient-to-t from-green-600 to-green-700 rounded-md py-2">* * * Membership Registration Form * * *</p>
    </div>
    <div class="flex w-full justify-between items-center">         
        <div>&nbsp;</div>   
        <button type="button" id="photoButton" @click.prevent="captureImage" title="Click to take a photo" class="text-white text-shadow-lg bg-blue-700 border-1 border-blue-200 hover:bg-blue-900 font-medium rounded-none text-lg w-full sm:w-auto px-5 py-8 text-center cursor-pointer shadow-lg"><span>Take a picture here</span>
        </button>    
        <img x-ref="uploadedImage" id="uploadedImage" class="bg-blue-700 border-1 border-blue-200 p-2 hidden">
        <div>&nbsp;</div>
    </div>
    <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Personal Information</p>
    </div>
        <div class="grid sm:grid-cols-5 gap-6 mb-6">				
        
        <div>
            <label for="firstname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name <span class="text-red-500 text-md font-bold">*</span></label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your first name here ..." x-model="firstname" id="firstname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required=""> 
            <span x-show="errors.firstname" class="text-red-500" x-text="errors.firstname"></span>
        </div>

        <div>
            <label for="lastname" @blur.prevent="drawText" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name <span class="text-red-500 text-md font-bold">*</span></label>
            <input type="text" placeholder="Type your last name here ..." id="lastname" x-model="lastname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
            <span x-show="errors.lastname" class="text-red-500" x-text="errors.lastname"></span>
        </div>				    
        <div>
            <label for="middlename"  @blur.prevent="drawText" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
            <input type="text" placeholder="Type your middle name here ..." x-model="middlename" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="nickname"  @blur.prevent="drawText" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
            <input type="text" placeholder="Type your nickname here ..." x-model="nickname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="suffix"  @blur.prevent="drawText" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suffix (Jr.,Sr.)</label>
            <input type="text" placeholder="Type your suffix here ..." x-model="suffix" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="region_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="region_id" id="region_id" @change="selectRegion($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select region here ...</option>
                <template x-for="reg in regions" :key="reg.id">
                    <option :value="reg.id" x-text="reg.name"></option>
                </template>
            </select>
            <span x-show="errors.region_id" class="text-red-500" x-text="errors.region_id"></span>
        </div>

        <div>
            <label for="province_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="province_id" @change="selectProvince($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select province here ...</option>
                <template x-for="prov in provinces" :key="prov.id">
                    <option :value="prov.id" x-text="prov.name"></option>
                </template>
            </select>
            <span x-show="errors.province_id" class="text-red-500" x-text="errors.province_id"></span>
        </div>

        <div>
            <label for="city_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality/City <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="city_id" @change="selectCity($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select municipality/city here ...</option>
                <template x-for="ct in cities" :key="ct.id">
                    <option :value="ct.id" x-text="ct.name"></option>
                </template>
            </select>
            <span x-show="errors.city_id" class="text-red-500" x-text="errors.city_id"></span>
        </div>

        <div>
            <label for="district_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">District <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="district_id" @change="selectDistrict($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select district here ...</option>
                <template x-for="dist in districts" :key="dist.id">
                    <option :value="dist.id" x-text="dist.name"></option>
                </template>
            </select>
            <span x-show="errors.district_id" class="text-red-500" x-text="errors.district_id"></span>
        </div>

        <div>
            <label for="barangay_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="barangay_id" @change="selectBarangay($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select barangay here ...</option>
                <template x-for="bar in barangays" :key="bar.id">
                    <option :value="bar.id" x-text="bar.name"></option>
                </template>
            </select>
            <span x-show="errors.barangay_id" class="text-red-500" x-text="errors.barangay_id"></span>
        </div>		
        
        <div>
            <label for="purok_id" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purok/Sitio <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="purok_id" @change="selectPurok($event.target.value, $event.target.options[$event.target.selectedIndex].text)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select purok/sitio here ...</option>
                <template x-for="pur in puroks" :key="pur.id">
                    <option :value="pur.id" x-text="pur.name"></option>
                </template>
            </select>
            <span x-show="errors.purok_id" class="text-red-500" x-text="errors.purok_id"></span>
        </div>	

        <div>
            <label for="zipcode" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your zip code here ..." x-model="zipcode" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.zipcode" class="text-red-500" x-text="errors.zipcode"></span>
        </div>

        <div>
            <label for="birthdate" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
            <input type="date" @blur.prevent="getBday('own')" placeholder="Select your date of birth here ..." x-model="birthdate" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.birthdate" class="text-red-500" x-text="errors.birthdate"></span>
        </div>

        <div>
            <label for="birthplace" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Place</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your birth place here ..." x-model="birthplace" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.birthplace" class="text-red-500" x-text="errors.birthplace"></span>
        </div>

        <div>
            <label for="age" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your age here ..." x-model="age" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.age" class="text-red-500" x-text="errors.age"></span>
        </div>

        <div>
            <label for="civilstatus" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Civil Status <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="civilstatus" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select status here ...</option>
                <template x-for="stat in cstatuses" :key="stat.id">
                    <option :value="stat.value" x-text="stat.value"></option>
                </template>
            </select>
            <span x-show="errors.civilstatus" class="text-red-500" x-text="errors.civilstatus"></span>
        </div>

        <div>
            <label for="gender" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="gender" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                <option value="">Select gender here ...</option>
                <template x-for="gn in genders" :key="gn.id">
                    <option :value="gn.value" x-text="gn.value"></option>
                </template>
            </select>
            <span x-show="errors.gender" class="text-red-500" x-text="errors.gender"></span>
        </div>

        <div>
            <label for="religion" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Religion</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your religion here ..." x-model="religion" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.religion" class="text-red-500" x-text="errors.religion"></span>
        </div>

        <div>
            <label for="nationality" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your nationality here ..." x-model="nationality" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.nationality" class="text-red-500" x-text="errors.nationality"></span>
        </div>

        <div>
            <label for="country" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your country here ..." x-model="country" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.country" class="text-red-500" x-text="errors.country"></span>
        </div>					

        <div>
            <label for="bloodtype" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blood Type</label>
            <select x-model="bloodtype" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select blood type here ...</option>
                <template x-for="bt in bloodtypes" :key="bt.id">
                    <option :value="bt.value" x-text="bt.value"></option>
                </template>
            </select>
            <span x-show="errors.bloodtype" class="text-red-500" x-text="errors.bloodtype"></span>
        </div>

        <div>
            <label for="height" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height <span class="text-white text-shadow-lg text-sm italic">(in cm)</span></label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your height here ..." x-model="height" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.height" class="text-red-500" x-text="errors.height"></span>
        </div>

        <div>
            <label for="weight" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight <span class="text-white text-shadow-lg text-sm italic">(in kg)</span></label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your weight here ..." x-model="weight" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.weight" class="text-red-500" x-text="errors.weight"></span>
        </div>

        </div>  

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Family Background</p>
        </div>
        <div class="grid sm:grid-cols-4 gap-6 mb-6">	
            <div>
                <label for="father" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Name</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your father's name here ..." x-model="father" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.father" class="text-red-500" x-text="errors.father"></span>
            </div>
            <div>
                <label for="mother" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Name</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your mother's name here ..." x-model="mother" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.mother" class="text-red-500" x-text="errors.mother"></span>
            </div>
            <div>
                <label for="spouse" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spouse' Name</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your spouse's name here ..." x-model="spouse" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.spouse" class="text-red-500" x-text="errors.spouse"></span>
            </div>
        </div>

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Educational and Occupational Background</p>
        </div>
        <div class="grid sm:grid-cols-4 gap-6 mb-6">	

        <div>
            <label for="education" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Educational Attainment</label>
            <select x-model="education" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select education here ...</option>
                <template x-for="ed in attainments" :key="ed.id">
                    <option :value="ed.value" x-text="ed.value"></option>
                </template>
            </select>
            <span x-show="errors.education" class="text-red-500" x-text="errors.education"></span>
        </div>

        <div>
            <label for="position" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your position here ..." x-model="position" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.position" class="text-red-500" x-text="errors.position"></span>
        </div>

        <div>
            <label for="skill" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skills</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your skills here ..." x-model="skill" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.skill" class="text-red-500" x-text="errors.skill"></span>
        </div>

        <div>
            <label for="organization" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organizations/Associations/Affiliations</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your organization here ..." x-model="organization" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.organization" class="text-red-500" x-text="errors.organization"></span>
        </div>

        </div>

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Contact Information</p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="contact" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your contact number here ..." x-model="contact" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.contact" class="text-red-500" x-text="errors.contact"></span>
            </div>
            <div>
                <label for="fb" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">FB Name</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your facebook name here ..." x-model="fb" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.fb" class="text-red-500" x-text="errors.fb"></span>
            </div>
            <div>
                <label for="email" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" @blur.prevent="drawText" placeholder="Type your email here ..." x-model="email" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
            </div>
        </div>

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Government Identification</p>
        </div>
        <div class="grid sm:grid-cols-5 gap-6 mb-6">
        <div>
            <label for="sss" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSS Number</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your SSS number here ..." x-model="sss" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.sss" class="text-red-500" x-text="errors.sss"></span>
        </div>

        <div>
            <label for="philhealth" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Philhealth</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your philhealth here ..." x-model="philhealth" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.philhealth" class="text-red-500" x-text="errors.philhealth"></span>
        </div>

        <div>
            <label for="voter" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voter's ID</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your voter's ID here ..." x-model="voter" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.voter" class="text-red-500" x-text="errors.voter"></span>
        </div>

        <div>
            <label for="passport" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passport</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your passport here ..." x-model="passport" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.passport" class="text-red-500" x-text="errors.passport"></span>
        </div>

        <div>
            <label for="profid" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Professional ID</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your professional ID here ..." x-model="profid" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.profid" class="text-red-500" x-text="errors.profid"></span>
        </div>
        <div>
            <label for="pagibig" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pag-ibig Number</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your pag-ibig number here ..." x-model="pagibig" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.pagibig" class="text-red-500" x-text="errors.pagibig"></span>
        </div>
        <div>
            <label for="license" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Driver's License Number</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your driver's license number here ..." x-model="license" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.license" class="text-red-500" x-text="errors.license"></span>
        </div>

        <div>
            <label for="senior" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senior Citizen ID</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your senior citizen ID here ..." x-model="senior" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.senior" class="text-red-500" x-text="errors.senior"></span>
        </div>

        </div>

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Community Information</p>
        </div>

        <div class="grid sm:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="chairman" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chairman's Name</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your chairman's name here ..." x-model="chairman" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.chairman" class="text-red-500" x-text="errors.chairman"></span>
        </div>
        <div>
            <label for="area" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your area here ..." x-model="area" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.area" class="text-red-500" x-text="errors.area"></span>
        </div>
        <div>
            <label for="mcnumber" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">MC#</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your MC number here ..." x-model="mcnumber" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.mcnumber" class="text-red-500" x-text="errors.mcnumber"></span>
        </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-6 mb-6">

        <div>
            <label for="classification" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classification</label>
            <select x-model="classification" @change="getStatus($event.target.value)" placeholder="Select your classification here ..." class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select your classification here ...</option>
                <option value="4P's">4P's</option>
                <option value="IP's">IP's</option>				      		
            </select>
            <span x-show="errors.classification" class="text-red-500" x-text="errors.classification"></span>
        </div>

        <div>
            <label for="tribe" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tribe</label>
            <select x-model="tribe" @change="getTribe($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select your tribe here ...</option>
                <option value="Muslim">Muslim</option>
                <option value="Others">Others</option>
            </select>
            <span x-show="errors.tribe" class="text-red-500" x-text="errors.tribe"></span>
        </div>		

        <div id="tribe-container" class="hidden">
            <label for="tribe1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other tribe</label>
            <input type="text" @blur.prevent="setTribe" placeholder="Type your tribe here ..." x-model="tribe1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.tribe1" class="text-red-500" x-text="errors.tribe1"></span>
        </div>

        </div>

        <div class="pb-3">
        <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Emergency Contact <span class="text-gray-700 text-shadow-lg text-sm italic">(Person to contact in case of emergency)</span></p>
        </div>
        <div class="grid sm:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="contactname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Name</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your emergency contact name here ..." x-model="contactname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.contactname" class="text-red-500" x-text="errors.contactname"></span>
            </div>
            <div>
                <label for="contactnumber" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your emergency contact number here ..." x-model="contactnumber" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.contactnumber" class="text-red-500" x-text="errors.contactnumber"></span>
            </div>
            <div>
                <label for="contactaddress" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Address</label>
                <input type="text" @blur.prevent="drawText" placeholder="Type your emergency contact address here ..." x-model="contactaddress" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <span x-show="errors.contactaddress" class="text-red-500" x-text="errors.contactaddress"></span>
            </div>
        </div>

        <div class="pb-3">					
            <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Beneficiaries <button @click.prevent="addBeneficiary" class="ml-3 border-1 border-green-800 rounded-md px-2 py-1 cursor-pointer text-white text-shadow-lg bg-green-600 shadow-lg hover:bg-green-800">+ Add</button></p>																
        </div>

        <div class="grid sm:grid-cols-4 gap-6 mb-6">

        <div>
            <label for="benname1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Beneficiary Name</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your first beneficiary here ..." x-model="benname1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benname1" class="text-red-500" x-text="errors.benname1"></span>
        </div>	

        <div>
            <label for="benbirthdate1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
            <input type="date" @blur.prevent="getBday('ben1')" placeholder="Select date of birth here ..." x-model="benbirthdate1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benbirthdate1" class="text-red-500" x-text="errors.benbirthdate1"></span>
        </div>

        <div>
            <label for="benage1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your first beneficiary's age here ..." x-model="benage1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benage1" class="text-red-500" x-text="errors.benage1"></span>
        </div>	

        <div>
            <label for="benrelationship1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your relationship to this person here ..." x-model="benrelationship1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benrelationship1" class="text-red-500" x-text="errors.benrelationship1"></span>
        </div>	

        </div>

        <div class="grid sm:grid-cols-4 gap-6 mb-6">

        <div>
            <label for="benname2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Second Beneficiary Name</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your second beneficiary name here ..." x-model="benname2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benname2" class="text-red-500" x-text="errors.benname2"></span>
        </div>	

        <div>
            <label for="benbirthdate2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
            <input type="date" @blur.prevent="getBday('ben2')" placeholder="Select date of birth here ..." x-model="benbirthdate2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benbirthdate2" class="text-red-500" x-text="errors.benbirthdate2"></span>
        </div>

        <div>
            <label for="benage2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your second beneficiary's age here ..." x-model="benage2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benage2" class="text-red-500" x-text="errors.benage2"></span>
        </div>	

        <div>
            <label for="benrelationship2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your relationship to this person here ..." x-model="benrelationship2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benrelationship2" class="text-red-500" x-text="errors.benrelationship2"></span>
        </div>	

        </div>

        <div class="grid sm:grid-cols-4 gap-6 mb-6">

        <div>
            <label for="benname3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Third Beneficiary Name</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your third beneficiary name here ..." x-model="benname3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benname3" class="text-red-500" x-text="errors.benname3"></span>
        </div>	

        <div>
            <label for="benbirthdate3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
            <input type="date" @blur.prevent="getBday('ben3')" placeholder="Select date of birth here ..." x-model="benbirthdate3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benbirthdate3" class="text-red-500" x-text="errors.benbirthdate3"></span>
        </div>

        <div>
            <label for="benage3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your second beneficiary's age here ..." x-model="benage3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benage3" class="text-red-500" x-text="errors.benage3"></span>
        </div>	

        <div>
            <label for="benrelationship3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your relationship to this person here ..." x-model="benrelationship3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benrelationship3" class="text-red-500" x-text="errors.benrelationship3"></span>
        </div>

        <!-- Additional Beneficiaries - Start -->
    
        <div id="benname4" class="hidden">
            <label for="benname4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fourth Beneficiary Name</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your fourth beneficiary name here ..." x-model="benname4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benname4" class="text-red-500" x-text="errors.benname4"></span>
        </div>	

        <div id="benbirthdate4" class="hidden">
            <label for="benbirthdate4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
            <input type="date" @blur.prevent="getBday('ben4')" placeholder="Select date of birth here ..." x-model="benbirthdate4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benbirthdate4" class="text-red-500" x-text="errors.benbirthdate4"></span>
        </div>

        <div id="benage4" class="hidden">
            <label for="benage4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your fourth beneficiary's age here ..." x-model="benage4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benage4" class="text-red-500" x-text="errors.benage4"></span>
        </div>	

        <div id="benrelationship4" class="hidden">
            <label for="benrelationship4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your relationship to this person here ..." x-model="benrelationship4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.benrelationship4" class="text-red-500" x-text="errors.benrelationship4"></span>
        </div>
    </div>

        <div class="pb-3">
            <p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-0">&nbsp;</p>
        </div>
    <div class="grid sm:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="insurance" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Insurance <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="insurance" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">							
                <template x-for="ins in insurances" :key="ins.id">
                    <option :value="ins.value" x-text="ins.value"></option>
                </template>			      		
            </select>
            <span x-show="errors.insurance" class="text-red-500" x-text="errors.insurance"></span>
        </div> 

        <div>
            <label for="burial" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Burial <span class="text-red-500 text-md font-bold">*</span></label>
            <select x-model="burial" @change="getStatus($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">					
                <template x-for="bur in burials" :key="bur.id">
                    <option :value="bur.value" x-text="bur.value"></option>
                </template>			      		
            </select>
            <span x-show="errors.burial" class="text-red-500" x-text="errors.burial"></span>
        </div>

        <div>
            <label for="courseToAvail" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualification/Course To Avail</label>
            <input type="text" @blur.prevent="drawText" placeholder="Type your qualification/course to avail here ..." x-model="courseToAvail" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <span x-show="errors.courseToAvail" class="text-red-500" x-text="errors.courseToAvail"></span>
        </div>

        <div class="flex w-full justify-between items-center">
            <button type="button" title="Click to make a signature" class="text-white text-shadow-lg bg-red-700 border-1 border-red-200 hover:bg-red-900 font-medium rounded-none text-lg w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer shadow-lg"><span>Signature here</span>
            </button>          
        </div>

        </div>

        <div class="grid sm:grid-cols-5 gap-6 mb-6">
            <div>
                <button type="submit" title="Click to register" class="text-white text-shadow-lg bg-green-700 border-1 border-green-200 hover:bg-green-900 font-medium rounded-none text-lg w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer shadow-lg"><span x-show="!loading">Register</span>
                    <span x-show="loading">Registering, please wait ...</span>
                </button>
            </div>
            <div class="text-xs">
                Already have an account?
                <a href="login.php" class="text-white italic no-underline">Please login</a>
            </div>
        </div>
    </div>

</form>