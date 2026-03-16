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
	  		<form @submit.prevent="submit" class="max-w-6xl mx-auto">

	  			<div class="mb-6">
	  					<p class="text-center text-white text-2xl text-shadow-lg bg-gradient-to-t from-green-500 to-green-400 rounded-md py-2">* * * Registration Form * * *</p>
	  			</div>

				  <div class="grid sm:grid-cols-5 gap-6 mb-6">
				    <!-- First Column: First Name Input -->				    
				    <div>
				      <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="text" placeholder="Type your first name here ..." x-model="firstname" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required=""> 
				      <span x-show="errors.firstname" class="text-red-500" x-text="errors.firstname"></span>
				    </div>
				    <!-- Second Column: Last Name Input -->
				    <div>
				      <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="text" placeholder="Type your last name here ..." x-model="lastname" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      <span x-show="errors.lastname" class="text-red-500" x-text="errors.lastname"></span>
				    </div>
				    <!-- Add more field pairs here within the grid container -->
				    <div>
				        <label for="middlename" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name <span class="text-gray-500 text-sm italic">(Optional)</span></label>
				        <input type="text" placeholder="Type your middle name here ..." x-model="middlename" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				        <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname <span class="text-gray-500 text-sm italic">(Optional)</span></label>
				        <input type="text" placeholder="Type your nickname here ..." x-model="nickname" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				        <label for="suffix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suffix (Jr.,Sr.) <span class="text-gray-500 text-sm italic">(Optional)</span></label>
				        <input type="text" placeholder="Type your suffix here ..." x-model="suffix" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
				    </div>
				    <div>
				      <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="region" id="region" @change="selectRegion($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select region here ...</option>
				      		<template x-for="reg in regions" :key="reg.id">
					            <option :value="reg.value" x-text="reg.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.region" class="text-red-500" x-text="errors.region"></span>
				    </div>

				    <div>
				      <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="province" @change="selectProvince($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select provinces here ...</option>
				      		<template x-for="prov in provinces" :key="prov.id">
					            <option :value="prov.value" x-text="prov.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.province" class="text-red-500" x-text="errors.province"></span>
				    </div>

				    <div>
				      <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipality/City <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="city" @change="selectCity($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select municipality/city here ...</option>
				      		<template x-for="ct in cities" :key="ct.id">
					            <option :value="ct.value" x-text="ct.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.city" class="text-red-500" x-text="errors.city"></span>
				    </div>

					<div>
				      <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="district" @change="selectDistrict($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select district here ...</option>
				      		<template x-for="dist in districts" :key="dist.id">
					            <option :value="dist.value" x-text="dist.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.district" class="text-red-500" x-text="errors.district"></span>
				    </div>

					<div>
				      <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="barangay" @change="selectBarangay($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select barangay here ...</option>
				      		<template x-for="bar in barangays" :key="bar.id">
					            <option :value="bar.value" x-text="bar.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.barangay" class="text-red-500" x-text="errors.barangay"></span>
				    </div>				    
				  </div>

				  <div>
				      <label for="purok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purok/Sitio <span class="text-red-500 text-md font-bold">*</span></label>
				      <select x-model="purok" @change="selectPurok($event.target.value)" class="mt-1 block w-full h-2/3 p-2 rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      		<option value="">Select purok/sitio here ...</option>
				      		<template x-for="bar in puroks" :key="bar.id">
					            <option :value="bar.value" x-text="bar.name"></option>
					        </template>
				      </select>
				      <span x-show="errors.purok" class="text-red-500" x-text="errors.purok"></span>
				    </div>				    
				  </div>

				  <div class="grid sm:grid-cols-5 gap-6 mb-6">
				  	<div>
				    	<button type="submit" class="text-white text-shadow-lg bg-gradient-to-t from-green-500 to-green-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-none text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer"><span x-show="!loading">Register</span>
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

			const  barangayList = [
				{ id: 1, name: 'First', value: 'First' },
				{ id: 2, name: "Second", value: "Second" },
				{ id: 3, name: 'Third', value: 'Third' },
				{ id: 4, name: 'Fourth', value: 'Fourth' }
			];

		  return {
		  	regions: regionsData,
		    provinces: [],
		    cities: [],
			districts: [],
			barangays: [],
			puroks: [],
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
		    loading: false,
		    errors: {},

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
		    		this.city = ct;
		    		if(ct == "Davao") {
			    		this.cities = delSurcities;
			    	}
			    	if(ct == "Digos") {
			    		this.cities = delNorteCities;
			    	}
		    },

			selectDistrict(ds) {
		    		this.district = ds;
		    		if(ds == "Davao") {
			    		this.districts = davaoDistricts;
			    	}
			    	if(ds == "Digos") {
			    		this.districts = digosDistricts;
			    	}
		    },

			selectBarangay(bar) {
		    		this.barangay = bar;
		    		if(bar == "Lubogan") {
			    		this.barangays = barangayList;
			    	}
			    	if(bar == "Baliok") {
			    		this.barangays = barangayList;
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