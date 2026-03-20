<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc.</title>
  <link href="./src/output.css" rel="stylesheet">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
</head>
<body class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
	<?php include('./includes/front/modals/registration-successful.php'); ?>
  <div x-data="formApp()" class="flex items-center justify-center min-h-screen">
  		 
  		 <div class="px-3 py-3 w-full">  		 		
	  		<form @submit.prevent="submit" class="max-w-7xl mx-auto bg-green-600 px-4 py-3 shadow-2xl">

	  			<div class="mb-6">
	  					<p class="text-center text-white text-2xl uppercase text-shadow-lg bg-gradient-to-t from-green-600 to-green-700 rounded-md py-2">* * * Member Registration Form * * *</p>
	  			</div>
				<div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Personal Information</p>
				</div>
				  <div class="grid sm:grid-cols-5 gap-6 mb-6">				
				  
				    <div>
				      <label for="firstname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="text" placeholder="Type your first name here ..." x-model="firstname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required=""> 
				      <span x-show="errors.firstname" class="text-red-500" x-text="errors.firstname"></span>
				    </div>

				    <div>
				      <label for="lastname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="text" placeholder="Type your last name here ..." x-model="lastname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      <span x-show="errors.lastname" class="text-red-500" x-text="errors.lastname"></span>
				    </div>				    
				    <div>
				        <label for="middlename" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
				        <input type="text" placeholder="Type your middle name here ..." x-model="middlename" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				        <label for="nickname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname <span class="text-white text-shadow-lg text-sm italic">(Optional)</span></label>
				        <input type="text" placeholder="Type your nickname here ..." x-model="nickname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				        <label for="suffix" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suffix (Jr.,Sr.) <span class="text-white text-shadow-lg text-sm italic">(Optional)</span></label>
				        <input type="text" placeholder="Type your suffix here ..." x-model="suffix" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				      <label for="region" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="region" id="region" @change="selectRegion($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select region here ...</option>
				      		<template x-for="reg in regions" :key="reg.id">
					            <option :value="reg.value" x-text="reg.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.region" class="text-red-500" x-text="errors.region"></span>
				    </div>

				    <div>
				      <label for="province" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="province" @change="selectProvince($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select provinces here ...</option>
				      		<template x-for="prov in provinces" :key="prov.id">
					            <option :value="prov.value" x-text="prov.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.province" class="text-red-500" x-text="errors.province"></span>
				    </div>

				    <div>
				      <label for="city" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality/City <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="city" @change="selectCity($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select municipality/city here ...</option>
				      		<template x-for="ct in cities" :key="ct.id">
					            <option :value="ct.value" x-text="ct.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.city" class="text-red-500" x-text="errors.city"></span>
				    </div>

					<div>
				      <label for="district" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">District <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="district" @change="selectDistrict($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select district here ...</option>
				      		<template x-for="dist in districts" :key="dist.id">
					            <option :value="dist.value" x-text="dist.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.district" class="text-red-500" x-text="errors.district"></span>
				    </div>

					<div>
				      <label for="barangay" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="barangay" @change="selectBarangay($event.target.value)" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select barangay here ...</option>
				      		<template x-for="bar in barangays" :key="bar.id">
					            <option :value="bar.value" x-text="bar.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.barangay" class="text-red-500" x-text="errors.barangay"></span>
				    </div>		
					
					<div>
				      <label for="purok" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purok/Sitio <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="purok" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select purok/sitio here ...</option>
				      		<template x-for="pur in puroks" :key="pur.id">
					            <option :value="pur.value" x-text="pur.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.purok" class="text-red-500" x-text="errors.purok"></span>
				    </div>	

					<div>
				        <label for="zipcode" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
				        <input type="text" placeholder="Type your zip code here ..." x-model="zipcode" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.zipcode" class="text-red-500" x-text="errors.zipcode"></span>
				    </div>

					<div>
				        <label for="birthdate" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select your date of birth here ..." x-model="birthdate" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.birthdate" class="text-red-500" x-text="errors.birthdate"></span>
				    </div>

					<div>
				        <label for="birthplace" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Place</label>
				        <input type="text" placeholder="Type your birth place here ..." x-model="birthplace" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.birthplace" class="text-red-500" x-text="errors.birthplace"></span>
				    </div>

					<div>
				        <label for="age" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
				        <input type="text" placeholder="Type your age here ..." x-model="age" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.age" class="text-red-500" x-text="errors.age"></span>
				    </div>

					<div>
				      <label for="civilstatus" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Civil Status <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="civilstatus" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select status here ...</option>
				      		<template x-for="stat in cstatuses" :key="stat.id">
					            <option :value="stat.value" x-text="stat.value"></option>
					        </template>
				      </select>
				      <span x-show="errors.civilstatus" class="text-red-500" x-text="errors.civilstatus"></span>
				    </div>

					<div>
				      <label for="gender" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="gender" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select gender here ...</option>
				      		<template x-for="gn in genders" :key="gn.id">
					            <option :value="gn.value" x-text="gn.value"></option>
					        </template>
				      </select>
				      <span x-show="errors.gender" class="text-red-500" x-text="errors.gender"></span>
				    </div>

					<div>
				        <label for="religion" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Religion</label>
				        <input type="text" placeholder="Type your religion here ..." x-model="religion" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.religion" class="text-red-500" x-text="errors.religion"></span>
				    </div>

					<div>
				        <label for="nationality" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
				        <input type="text" placeholder="Type your nationality here ..." x-model="nationality" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.nationality" class="text-red-500" x-text="errors.nationality"></span>
				    </div>

					<div>
				        <label for="country" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
				        <input type="text" placeholder="Type your country here ..." x-model="country" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.country" class="text-red-500" x-text="errors.country"></span>
				    </div>					

					<div>
				      <label for="bloodtype" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blood Type</label>
				      <select x-model="bloodtype" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				      		<option value="">Select blood type here ...</option>
				      		<template x-for="bt in bloodtypes" :key="bt.id">
					            <option :value="bt.value" x-text="bt.value"></option>
					        </template>
				      </select>
				      <span x-show="errors.bloodtype" class="text-red-500" x-text="errors.bloodtype"></span>
				    </div>

					<div>
				        <label for="height" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height <span class="text-white text-shadow-lg text-sm italic">(in cm)</span></label>
				        <input type="text" placeholder="Type your height here ..." x-model="height" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.height" class="text-red-500" x-text="errors.height"></span>
				    </div>

					<div>
				        <label for="weight" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight <span class="text-white text-shadow-lg text-sm italic">(in kg)</span></label>
				        <input type="text" placeholder="Type your weight here ..." x-model="weight" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.weight" class="text-red-500" x-text="errors.weight"></span>
				    </div>

				  </div>  

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Family Background</p>
				  </div>
				  <div class="grid sm:grid-cols-4 gap-6 mb-6">	
						<div>
							<label for="father" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Name</label>
							<input type="text" placeholder="Type your father's name here ..." x-model="father" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.father" class="text-red-500" x-text="errors.father"></span>
						</div>
						<div>
							<label for="mother" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Name</label>
							<input type="text" placeholder="Type your mother's name here ..." x-model="mother" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.mother" class="text-red-500" x-text="errors.mother"></span>
						</div>
						<div>
							<label for="spouse" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spouse' Name</label>
							<input type="text" placeholder="Type your spouse's name here ..." x-model="spouse" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.spouse" class="text-red-500" x-text="errors.spouse"></span>
						</div>
				  </div>

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Educational and Occupational Background</p>
				  </div>
				  <div class="grid sm:grid-cols-4 gap-6 mb-6">	

					<div>
				      <label for="education" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Educational Attainment</label>
				      <select x-model="education" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				      		<option value="">Select education here ...</option>
				      		<template x-for="ed in attainments" :key="ed.id">
					            <option :value="ed.value" x-text="ed.value"></option>
					        </template>
				      </select>
				      <span x-show="errors.education" class="text-red-500" x-text="errors.education"></span>
				    </div>

					<div>
						<label for="position" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
						<input type="text" placeholder="Type your position here ..." x-model="position" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.position" class="text-red-500" x-text="errors.position"></span>
					</div>

					<div>
						<label for="skill" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skills</label>
						<input type="text" placeholder="Type your skills here ..." x-model="skill" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.skill" class="text-red-500" x-text="errors.skill"></span>
					</div>

					<div>
						<label for="organization" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organizations/Associations/Affiliations</label>
						<input type="text" placeholder="Type your organization here ..." x-model="organization" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.organization" class="text-red-500" x-text="errors.organization"></span>
					</div>

				  </div>

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Contact Information</p>
				  </div>
				  <div class="grid sm:grid-cols-3 gap-6 mb-6">
						<div>
							<label for="contact" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
							<input type="text" placeholder="Type your contact number here ..." x-model="contact" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.contact" class="text-red-500" x-text="errors.contact"></span>
						</div>
						<div>
							<label for="fb" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">FB Name</label>
							<input type="text" placeholder="Type your facebook name here ..." x-model="fb" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.fb" class="text-red-500" x-text="errors.fb"></span>
						</div>
						<div>
							<label for="email" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
							<input type="email" placeholder="Type your email here ..." x-model="email" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
						</div>
				  </div>

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Government Identification</p>
				  </div>
				  <div class="grid sm:grid-cols-5 gap-6 mb-6">
					<div>
						<label for="sss" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSS Number</label>
						<input type="text" placeholder="Type your SSS number here ..." x-model="sss" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.sss" class="text-red-500" x-text="errors.sss"></span>
					</div>

					<div>
						<label for="philhealth" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Philhealth</label>
						<input type="text" placeholder="Type your philhealth here ..." x-model="philhealth" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.philhealth" class="text-red-500" x-text="errors.philhealth"></span>
					</div>

					<div>
						<label for="voter" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Voter's ID</label>
						<input type="text" placeholder="Type your voter's ID here ..." x-model="voter" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.voter" class="text-red-500" x-text="errors.voter"></span>
					</div>

					<div>
						<label for="passport" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Passport</label>
						<input type="text" placeholder="Type your passport here ..." x-model="passport" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.passport" class="text-red-500" x-text="errors.passport"></span>
					</div>

					<div>
						<label for="profid" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Professional ID</label>
						<input type="text" placeholder="Type your professional ID here ..." x-model="profid" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.profid" class="text-red-500" x-text="errors.profid"></span>
					</div>
					<div>
						<label for="pagibig" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pag-ibig Number</label>
						<input type="text" placeholder="Type your pag-ibig number here ..." x-model="pagibig" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.pagibig" class="text-red-500" x-text="errors.pagibig"></span>
					</div>
					<div>
						<label for="license" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Driver's License Number</label>
						<input type="text" placeholder="Type your driver's license number here ..." x-model="license" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.license" class="text-red-500" x-text="errors.license"></span>
					</div>

					<div>
						<label for="senior" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senior Citizen ID</label>
						<input type="text" placeholder="Type your senior citizen ID here ..." x-model="senior" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.senior" class="text-red-500" x-text="errors.senior"></span>
					</div>

				  </div>

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Community Information</p>
				  </div>

				  <div class="grid sm:grid-cols-3 gap-6 mb-6">
					<div>
						<label for="chairman" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chairman's Name</label>
						<input type="text" placeholder="Type your chairman's name here ..." x-model="chairman" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.chairman" class="text-red-500" x-text="errors.chairman"></span>
					</div>
					<div>
						<label for="area" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Area</label>
						<input type="text" placeholder="Type your area here ..." x-model="area" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.area" class="text-red-500" x-text="errors.area"></span>
					</div>
					<div>
						<label for="mcnumber" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">MC#</label>
						<input type="text" placeholder="Type your MC number here ..." x-model="mcnumber" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.mcnumber" class="text-red-500" x-text="errors.mcnumber"></span>
					</div>
				  </div>

				  <div class="grid sm:grid-cols-3 gap-6 mb-6">

					<div>
				      <label for="classification" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classification</label>
				      <select x-model="classification" placeholder="Select your classification here ..." class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
							<option value="Cebuano">Cebuano</option>
				      		<option value="Others">Others</option>				      		
				      </select>
				      <span x-show="errors.tribe" class="text-red-500" x-text="errors.tribe"></span>
				    </div>		

					<div id="tribe-container" class="hidden">
						<label for="tribe1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Other tribe</label>
						<input type="text" placeholder="Type your tribe here ..." x-model="tribe1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.tribe1" class="text-red-500" x-text="errors.tribe1"></span>
					</div>

				  </div>

				  <div class="pb-3">
					<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Emergency Contact <span class="text-gray-700 text-shadow-lg text-sm italic">(Person to contact in case of emergency)</span></p>
				  </div>
				  <div class="grid sm:grid-cols-3 gap-6 mb-6">
						<div>
							<label for="contactname" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Name</label>
							<input type="text" placeholder="Type your emergency contact name here ..." x-model="contactname" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.contactname" class="text-red-500" x-text="errors.contactname"></span>
						</div>
						<div>
							<label for="contactnumber" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
							<input type="text" placeholder="Type your emergency contact number here ..." x-model="contactnumber" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.contactnumber" class="text-red-500" x-text="errors.contactnumber"></span>
						</div>
						<div>
							<label for="contactaddress" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Address</label>
							<input type="text" placeholder="Type your emergency contact address here ..." x-model="contactaddress" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.contactaddress" class="text-red-500" x-text="errors.contactaddress"></span>
						</div>
				  </div>

				  <div class="pb-3">					
						<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-2">Beneficiaries <button @click="addBeneficiary" class="ml-3 border-1 border-green-800 rounded-md px-2 py-1 cursor-pointer text-white text-shadow-lg bg-green-600 shadow-lg hover:bg-green-800">+ Add</button></p>																
				  </div>

				  <div class="grid sm:grid-cols-4 gap-6 mb-6">

					<div>
						<label for="benname1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Beneficiary Name</label>
						<input type="text" placeholder="Type your first beneficiary here ..." x-model="benname1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benname1" class="text-red-500" x-text="errors.benname1"></span>
					</div>	

					<div>
				        <label for="benbirthdate1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select date of birth here ..." x-model="benbirthdate1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benbirthdate1" class="text-red-500" x-text="errors.benbirthdate1"></span>
				    </div>

					<div>
						<label for="benage1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
						<input type="text" placeholder="Type your first beneficiary's age here ..." x-model="benage1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benage1" class="text-red-500" x-text="errors.benage1"></span>
					</div>	

					<div>
						<label for="benrelationship1" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
						<input type="text" placeholder="Type your relationship to this person here ..." x-model="benrelationship1" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benrelationship1" class="text-red-500" x-text="errors.benrelationship1"></span>
					</div>	

				  </div>

				  <div class="grid sm:grid-cols-4 gap-6 mb-6">

					<div>
						<label for="benname2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Second Beneficiary Name</label>
						<input type="text" placeholder="Type your second beneficiary name here ..." x-model="benname2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benname2" class="text-red-500" x-text="errors.benname2"></span>
					</div>	

					<div>
				        <label for="benbirthdate2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select date of birth here ..." x-model="benbirthdate2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benbirthdate2" class="text-red-500" x-text="errors.benbirthdate2"></span>
				    </div>

					<div>
						<label for="benage2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
						<input type="text" placeholder="Type your second beneficiary's age here ..." x-model="benage2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benage2" class="text-red-500" x-text="errors.benage2"></span>
					</div>	

					<div>
						<label for="benrelationship2" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
						<input type="text" placeholder="Type your relationship to this person here ..." x-model="benrelationship2" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benrelationship2" class="text-red-500" x-text="errors.benrelationship2"></span>
					</div>	

				  </div>

				  <div class="grid sm:grid-cols-4 gap-6 mb-6">

					<div>
						<label for="benname3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Third Beneficiary Name</label>
						<input type="text" placeholder="Type your third beneficiary name here ..." x-model="benname3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benname3" class="text-red-500" x-text="errors.benname3"></span>
					</div>	

					<div>
				        <label for="benbirthdate3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select date of birth here ..." x-model="benbirthdate3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benbirthdate3" class="text-red-500" x-text="errors.benbirthdate3"></span>
				    </div>

					<div>
						<label for="benage3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
						<input type="text" placeholder="Type your second beneficiary's age here ..." x-model="benage3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benage3" class="text-red-500" x-text="errors.benage3"></span>
					</div>	

					<div>
						<label for="benrelationship3" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
						<input type="text" placeholder="Type your relationship to this person here ..." x-model="benrelationship3" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benrelationship3" class="text-red-500" x-text="errors.benrelationship3"></span>
					</div>

					<!-- Additional Beneficiaries - Start -->
				
					<div id="benname4" class="hidden">
						<label for="benname4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fourth Beneficiary Name</label>
						<input type="text" placeholder="Type your fourth beneficiary name here ..." x-model="benname4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benname4" class="text-red-500" x-text="errors.benname4"></span>
					</div>	

					<div id="benbirthdate4" class="hidden">
				        <label for="benbirthdate4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select date of birth here ..." x-model="benbirthdate4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benbirthdate4" class="text-red-500" x-text="errors.benbirthdate4"></span>
				    </div>

					<div id="benage4" class="hidden">
						<label for="benage4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
						<input type="text" placeholder="Type your fourth beneficiary's age here ..." x-model="benage4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benage4" class="text-red-500" x-text="errors.benage4"></span>
					</div>	

					<div id="benrelationship4" class="hidden">
						<label for="benrelationship4" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
						<input type="text" placeholder="Type your relationship to this person here ..." x-model="benrelationship4" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.benrelationship4" class="text-red-500" x-text="errors.benrelationship4"></span>
					</div>

					<!-- Additional Beneficiaries - End -->
				</div>

					<div class="pb-3">
						<p class="text-center text-gray-900 text-lg text-shadow-md uppercase bg-gradient-to-t from-green-400 to-green-200 rounded-md py-0">&nbsp;</p>
					</div>
				  <div class="grid sm:grid-cols-3 gap-6 mb-6">
				

					<div>
				      <label for="insurance" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Insurance <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="insurance" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">							
							<template x-for="ins in insurances" :key="ins.id">
					            <option :value="ins.value" x-text="ins.value"></option>
					        </template>			      		
				      </select>
				      <span x-show="errors.insurance" class="text-red-500" x-text="errors.insurance"></span>
				    </div>

					<div>
				      <label for="burial" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Burial <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="burial" class="bg-white mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">					
							<template x-for="bur in burials" :key="bur.id">
					            <option :value="bur.value" x-text="bur.value"></option>
					        </template>			      		
				      </select>
				      <span x-show="errors.burial" class="text-red-500" x-text="errors.burial"></span>
				    </div>

					<div>
						<label for="courseToAvail" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualification/Course To Avail</label>
						<input type="text" placeholder="Type your qualification/course to avail here ..." x-model="courseToAvail" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
						<span x-show="errors.courseToAvail" class="text-red-500" x-text="errors.courseToAvail"></span>
					</div>

				  </div>

				  <div class="grid sm:grid-cols-5 gap-6 mb-6">
				  	<div>
				    	<button type="submit" title="Click to register" class="text-white text-shadow-lg bg-green-700 border-1 border-green-200 hover:bg-green-900 font-medium rounded-none text-lg w-full sm:w-auto px-5 py-2.5 text-center cursor-pointer shadow-lg"><span x-show="!loading">Register</span>
      				<span x-show="loading">Registering, please wait ...</span></button>
				    </div>
				    <div class="text-xs">
				    	Already have an account?
				    	<a href="login.php" class="text-blue-500 italic">Please login</a>
				    </div>
				  </div>

			</form>

			</div>
	</div>

	<script>		
		
		function formApp() {					
			const regionsData = [
				{ id: 1, name: 'Region IX', value: 'Region IX' },
		        { id: 2, name: 'Region X', value: 'Region X' },
		        { id: 3, name: 'Region XI', value: 'Region XI' },
		        { id: 4, name: 'Region XII', value: 'Region XII' },
		        { id: 5, name: 'Region XIII', value: 'Region XIII' },
		        { id: 6, name: 'BARMM', value: 'BARMM' }
			];
			const davaoProvince = [
				{ id: 1, name: 'Davao del Norte', value: 'Davao del Norte' },
		        { id: 2, name: 'Davao del Sur', value: 'Davao del Sur' },
		        { id: 3, name: 'Davao de Oro', value: 'Davao de Oro' },
		        { id: 4, name: 'Davao Oriental', value: 'Davao Oriental' },
		        { id: 5, name: 'Davao Occidental', value: 'Davao Occidental' }
			];
			const barmm = [
				{ id: 1, name: 'Sultan Kudarat', value: 'Sultan Kudarat' },
		        { id: 2, name: 'Shariff Aguac', value: 'Shariff Aguac' },
		        { id: 3, name: 'Julu Sulu', value: 'Julu Sulu' }		        
			];
			const delSurcities = [
				{ id: 1, name: 'Bansalan', value: 'Bansalan' },
				{ id: 2, name: 'Davao', value: 'Davao' },
		        { id: 3, name: 'Digos', value: 'Digos' },
		        { id: 4, name: 'Padada', value: 'Padada' },
		        { id: 5, name: "Sta. Cruz", value: "Sta. Cruz" }		        
			];
			const delNorteCities = [
				{ id: 1, name: 'Tagum', value: 'Tagum' },
				{ id: 2, name: "Sto. Tomas", value: "Sto. Tomas" },
		        { id: 3, name: 'Panabo', value: 'Panabo' },
		        { id: 4, name: 'Carmen', value: 'Carmen' }		        
			];
			const davaoDistricts = [
				{ id: 1, name: 'First', value: 'First' },
				{ id: 2, name: "Second", value: "Second" },
				{ id: 3, name: 'Third', value: 'Third' }
			];

			const digosDistricts = [
				{ id: 1, name: 'First', value: 'First' },
				{ id: 2, name: "Second", value: "Second" },
				{ id: 3, name: 'Third', value: 'Third' },
				{ id: 4, name: 'Fourth', value: 'Fourth' }
			];		
			
			const thirdDistrictBarangays = [
				{ id: 1, name: 'Lubogan', value: 'Lubogan' }				
			];

			const firstDistrictBarangays = [				
				{ id: 1, name: "Baliok", value: "Baliok" },
				{ id: 2, name: 'Bucana', value: 'Bucana' },
				{ id: 3, name: 'Matina Pangi', value: 'Matina Pangi' }
			];

			const barangayLubogan = [
				{ id: 1, name: 'Purok 1-A', value: 'Purok 1-A' },
				{ id: 2, name: "Purok 1-B", value: "Purok 1-B" },
				{ id: 3, name: 'Purok 2-A', value: 'Purok 2-A' },
				{ id: 4, name: 'Purok 2-B', value: 'Purok 2-B' }
			];

			const  barangayBaliok = [
				{ id: 1, name: 'Purok 1-A', value: 'Purok 1-A' },
				{ id: 2, name: "Purok 1-B", value: "Purok 1-B" },
				{ id: 3, name: 'Purok 2-A', value: 'Purok 2-A' },
				{ id: 4, name: 'Purok 2-B', value: 'Purok 2-B' },
				{ id: 5, name: 'Purok 3-A', value: 'Purok 3-A' },
				{ id: 6, name: "Purok 3-B", value: "Purok 3-B" },
				{ id: 7, name: 'Purok 4-A', value: 'Purok 4-A' },
				{ id: 8, name: 'Purok 4-B', value: 'Purok 4-B' }
			];

		  return {
		  	regions: regionsData,
		    provinces: [],
		    cities: [],
			districts: [],
			barangays: [],
			puroks: [],
			cstatuses: [
				{ id: 1, value: 'Single' },
				{ id: 2, value: "Married" },
				{ id: 3, value: 'Separated' },
				{ id: 4, value: "Widowed" }
			],
			genders: [
				{ id: 1, value: 'Male' },
				{ id: 2, value: "Female" }
			],
			bloodtypes: [
				{ id: 1, value: 'A+' },
				{ id: 2, value: "A-" },
				{ id: 3, value: 'B+' },
				{ id: 4, value: "B-" },
				{ id: 5, value: 'O+' },
				{ id: 6, value: "O-" },
				{ id: 7, value: 'AB+' },
				{ id: 8, value: "AB-" }
			],
			attainments: [
				{ id: 1, value: 'Elementary Level' },
				{ id: 2, value: 'Elementary Graduate' },
				{ id: 3, value: 'High School Level' },
				{ id: 4, value: 'High School Graduate' },
				{ id: 5, value: 'College Undergraduate' },
				{ id: 6, value: "College Graduate" },
				{ id: 7, value: 'Vocational' },
				{ id: 8, value: "Graduate Studies" }
			],
			insurances: [
				{ id: 1, value: 50 },
				{ id: 2, value: 100 },
				{ id: 3, value: 150 },
				{ id: 4, value: 200 },
				{ id: 5, value: 250 },
				{ id: 6, value: 300 }
			],
			burials: [
				{ id: 1, value: 50 },
				{ id: 2, value: 100 },
				{ id: 3, value: 150 },
				{ id: 4, value: 200 },
				{ id: 5, value: 250 },
				{ id: 6, value: 300 }
			],
		    firstname: '',
		    lastname: '',
		    middlename: '',
		    nickname: '',
		    suffix: '',
		    region: '',
		    province: '',
		    city: '',		 
		    district: '',
		    barangay: '',
		    purok: '',
		    zipcode: '',
			birthdate: '1982-02-21',
			benbirthdate1: '2010-02-21',
			benbirthdate2: '2010-02-21',
			benbirthdate3: '2010-02-21',
			benbirthdate4: '2010-02-21',
			birthplace: '',
			age: '',
			civilstatus: '',	
			gender: '',		
			nationality: 'Filipino',
			country: 'Philippines',
			religion: '',
			bloodtype: '',
			height: '',
			weight: '',
			father: '',
			mother: '',
			spouse: '',
			position: '',
			education: '',
			skill: '',
			organization: '',
			contact: '',
			fb: '',
			email: '',
			sss: '',
			philhealth: '',
			voter: '',
			passport: '',
			profid: '',
			pagibig: '',
			license: '',
			senior: '',
			chairman: '',
			area: '',
			mcnumber: '',
			classification: '',
			tribe: '',
			tribe1: '',
			contactname: '',
			contactnumber: '',
			contactaddress: '',
			benname1: '',
			benage1: '',
			benrelationship1: '',
			benname2: '',
			benage2: '',
			benrelationship2: '',
			benname3: '',
			benname4: '',
			benage3: '',
			benage4: '',
			benrelationship3: '',
			benrelationship4: '',
			insurance: '',
			burial: '',
			courseToAvail: '',

		    loading: false,
		    errors: {},

			getTribe(trb) {
				const tribeContainer = document.getElementById('tribe-container');	
				if(trb == "Others") {
					tribeContainer.classList.remove('hidden');
				} else {
					tribeContainer.classList.add('hidden');
				}
			},

			addBeneficiary() {
				const fourthBeneficiaryName = document.getElementById('benname4');
				const fourthBeneficiaryBday = document.getElementById('benbirthdate4');
				const fourthBeneficiaryAge = document.getElementById('benage4');
				const fourthBeneficiaryRelation = document.getElementById('benrelationship4');
				fourthBeneficiaryName.classList.remove('hidden');
				fourthBeneficiaryBday.classList.remove('hidden');
				fourthBeneficiaryAge.classList.remove('hidden');
				fourthBeneficiaryRelation.classList.remove('hidden');
			},

			async getZipcode() {
				return await fetch('./data/zipcodes.json')
				.then(response => response.json())
				.then(json => {
					console.log(json); 
				}).catch(error => console.error('Error fetching JSON:', error));
			},

		    selectRegion(reg) {
		    	this.region = reg;
		    	if(reg == "Region XI") {
		    		this.provinces = davaoProvince;
		    	}
		    	if(reg == "BARMM") {
		    		this.provinces = barmm;
		    	}
		    },

		    selectProvince(pr) {
		    		this.province = pr;
		    		if(pr == "Davao del Sur") {
			    		this.cities = delSurcities;
			    	}
			    	if(pr == "Davao del Norte") {
			    		this.cities = delNorteCities;
			    	}
		    },
			

		    selectCity(ct) {
					//const zipcodes = this.getZipcode();			
					//console.log(zipcodes);
					//alert(zc.reverse(ct + ' City'));
		    		this.city = ct;
		    		if(ct == "Davao") {
			    		this.districts = davaoDistricts;
			    	}
			    	if(ct == "Digos") {
			    		this.districts = digosDistricts;
			    	}
		    },

			selectDistrict(ds) {
		    		this.district = ds;
		    		if(ds == "Third") {
			    		this.barangays = thirdDistrictBarangays;
			    	}
			    	if(ds == "First") {
			    		this.barangays = firstDistrictBarangays;
			    	}
		    },

			selectBarangay(bar) {
		    		this.barangay = bar;
		    		if(bar == "Lubogan") {
			    		this.puroks = barangayLubogan;
			    	}
			    	if(bar == "Baliok") {
			    		this.puroks = barangayBaliok;
			    	}
		    },

		    validate() {
		      this.errors = {}
		      if (!this.firstname) this.errors.firstname = "(Required)"
		      if (!this.lastname) this.errors.lastname = "(Required)"
		      if (!this.email) this.errors.email = "(Required)"		      
		      return Object.keys(this.errors).length === 0
		    },

		    clearInputs() {
		    		this.firstname = '';
		    		this.lastname = '';
		    		this.middlename = '';		    		
		    		this.email = '';
					this.region = '';
		    		this.province = '';
		    		this.city = '';		    		
		    		this.district = '';
					this.barangay = '';
		    		this.purok = '';
		    		this.civilstatus = '';		    		
		    		this.gender = '';
					this.religion = '';
		    		this.bloodtype = '';
		    		this.nickname = '';		    		
		    		this.suffix = '';
					this.zipcode = '';
		    		this.birthdate = '1982-02-21';
		    		this.birthplace = '';		    		
		    		this.age = '';
					this.nationality = '';
		    		this.country = '';
		    		this.height = '';		    		
		    		this.weight = '';
					this.father = '';
		    		this.mother = '';
		    		this.spouse = '';		    		
		    		this.education = '';
					this.position = '';
		    		this.skill = '';
		    		this.organization = '';		    		
		    		this.contact = '';
					this.fb = '';
		    		this.sss = '';
		    		this.philhealth = '';		    		
		    		this.voter = '';
					this.passport = '';
		    		this.profid = '';
		    		this.pagibig = '';		    		
		    		this.license = '';
					this.senior = '';
		    		this.chairman = '';
		    		this.area = '';		    		
		    		this.mcnumber = '';
					this.classification = '';
		    		this.tribe = '';
		    		this.contactname = '';		    		
		    		this.contactnumber = '';
					this.contactaddress = '';
		    		this.benname1 = '';
		    		this.benage1 = '';
		    		this.benrelationship1 = '';
					this.benbirthdate1 = '2010-02-21';
					this.benname2 = '';
		    		this.benage2 = '';
		    		this.benrelationship2 = '';
					this.benbirthdate2 = '2010-02-21';
					this.benname3 = '';
		    		this.benage3 = '';
		    		this.benrelationship3 = '';
					this.benbirthdate3 = '2010-02-21';
					this.benname4 = '';
		    		this.benage4 = '';
		    		this.benrelationship4 = '';
					this.benbirthdate4 = '2010-02-21';
					this.insurance = '';
					this.burial = '';
					this.courseToAvail = '';
		    },

		    async submit() {
		      if (!this.validate()) return;

		      this.loading = true;

		    	try {

			       const response = await fetch("http://localhost/sdsg/api/member.php", {
			        method: "POST",
			        headers: {"Content-Type": "application/json"},
			        body: JSON.stringify({ 
			        	firstname: this.firstname,
			        	lastname: this.lastname,
			        	middlename: this.middlename,
			        	email: this.email,
						nickname: this.nickname,
						suffix: this.suffix,
						region: this.region,
						province: this.province,
						city: this.city,
						district: this.district,
						barangay: this.barangay,
						purok: this.purok,
						zipcode: this.zipcode,
						birthdate: this.birthdate,
						birthplace: this.birthplace,
						age: this.age,
						civilstatus: this.civilstatus,
						gender: this.gender,
						nationality: this.nationality,
						country: this.country,
						religion: this.religion,
						bloodtype: this.bloodtype,
						height: this.height,
						weight: this.weight,
						father: this.father,
						mother: this.mother,
						spouse: this.spouse,
						education: this.education,
						position: this.position,
						skill: this.skill,
						organization: this.organization,
						contact: this.contact,
						fb: this.fb,
						sss: this.sss,
						philhealth: this.philhealth,
						voter: this.voter,
						passport: this.passport,
						profid: this.profid,
						pagibig: this.pagibig,
						license: this.license,
						senior: this.senior,
						chairman: this.chairman,
						area: this.area,
						mcnumber: this.mcnumber,
						classification: this.classification,
						tribe: this.tribe,
						contactname: this.contactname,
						contactnumber: this.contactnumber,
						contactaddress: this.contactaddress,
						benname1: this.benname1,
						benage1: this.benage1,
						benrelationship1: this.benrelationship1,
						benbirthdate1: this.benbirthdate1,
						benname2: this.benname2,
						benage2: this.benage2,
						benrelationship2: this.benrelationship2,
						benbirthdate2: this.benbirthdate2,
						benname3: this.benname3,
						benage3: this.benage3,
						benrelationship3: this.benrelationship3,
						benbirthdate3: this.benbirthdate3,
						benname4: this.benname4,
						benage4: this.benage4,
						benrelationship4: this.benrelationship4,
						benbirthdate4: this.benbirthdate4,
						insurance: this.insurance,
						burial: this.burial,
						courseToAvail: this.courseToAvail
			        })
			      });

		      	const res = await response.json();
		      	const modal = document.getElementById('successModal');

			      if(!res.status) {
			      	alert("Invalid inputs");
			      } else {
			      	this.clearInputs();
			      	modal.classList.remove('hidden');
			      	setTimeout(() => {
						modal.classList.add('hidden');
						window.location = "login.php";
					}, 3000);
			      }
		      } catch (error) {
		      		console.error('Error fetching data:', error);
          } finally {
              this.loading = false;
          }

		    }
		  }
		}
	</script>

</body>
</html>