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
	  		<form @submit.prevent="submit" class="max-w-6xl mx-auto bg-green-500 px-4 py-3 shadow-2xl">

	  			<div class="mb-6">
	  					<p class="text-center text-white text-2xl uppercase text-shadow-lg bg-gradient-to-t from-green-600 to-green-700 rounded-md py-2">* * * Registration Form * * *</p>
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
				        <label for="middlename" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name <span class="text-white text-shadow-lg text-sm italic">(Optional)</span></label>
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
				        <input type="text" placeholder="Type your zip code here ..." x-model="zipcode" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
						<span x-show="errors.zipcode" class="text-red-500" x-text="errors.zipcode"></span>
				    </div>

					<div>
				        <label for="birthdate" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Date <span class="text-white text-shadow-lg text-sm italic">(mm/dd/yyyy)</span></label>
				        <input type="date" placeholder="Select your date of birth here ..." x-model="birthdate" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
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
				        <input type="text" placeholder="Type your Blood Type here ..." x-model="bloodtype" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
							<label for="weight" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Name</label>
							<input type="text" placeholder="Type your weight here ..." x-model="weight" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.weight" class="text-red-500" x-text="errors.weight"></span>
						</div>
						<div>
							<label for="weight" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Name</label>
							<input type="text" placeholder="Type your weight here ..." x-model="weight" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.weight" class="text-red-500" x-text="errors.weight"></span>
						</div>
						<div>
							<label for="weight" class="text-white text-shadow-lg block mb-2 text-sm font-medium text-gray-900 dark:text-white">Spouse' Name</label>
							<input type="text" placeholder="Type your weight here ..." x-model="weight" class="bg-white mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
							<span x-show="errors.weight" class="text-red-500" x-text="errors.weight"></span>
						</div>
				  </div>

				  <div class="grid sm:grid-cols-5 gap-6 mb-6">
				  	<div>
				    	<button type="submit" class="text-white text-shadow-lg bg-gradient-to-t from-green-700 to-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-none text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer shadow-lg"><span x-show="!loading">Register</span>
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
			birthplace: '',
			age: '',
			civilstatus: '',	
			gender: '',		
			nationality: 'Filipino',
			country: 'Philippines',
		    loading: false,
		    errors: {},

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
					const zipcodes = this.getZipcode();			
					console.log(zipcodes);
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
		      if (!this.username) this.errors.username = "(Required)"
		      if (!this.password) this.errors.password = "(Required)"
		      return Object.keys(this.errors).length === 0
		    },

		    clearInputs() {
		    		this.firstname = '';
		    		this.lastname = '';
		    		this.middlename = '';
		    		this.username = '';
		    		this.email = '';
		    		this.password = '';
		    		this.phone = '';
		    		this.mobile = '';
		    },

		    async submit() {
		      if (!this.validate()) return

		      this.loading = true

		    	try {

			       const response = await fetch("http://localhost/vjstore/api/register.php", {
			        method: "POST",
			        headers: {"Content-Type": "application/json"},
			        body: JSON.stringify({ 
			        	firstname: this.firstname,
			        	lastname: this.lastname,
			        	middlename: this.middlename,
			        	username: this.username,
			        	email: this.email,
			        	password: this.password,
			        	phone: this.phone,
			        	mobile: this.mobile
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
							  // or window.location.href("URL");
							  // or window.location.replace("URL");
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