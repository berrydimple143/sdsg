<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc.</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
	<?php include('../includes/front/modals/registration-successful.php'); ?>
  <div x-data="formApp()" class="flex items-center justify-center min-h-screen">
  		 
  		 <div class="px-5 py-3 bg-white shadow-2xl w-lg">  		 		
	  		<form @submit.prevent="submit" class="max-w-4xl mx-auto">

	  			<div class="mb-6">
	  					<p class="text-center text-white text-2xl text-shadow-lg bg-gradient-to-t from-green-500 to-green-400 rounded-md py-2">* * * Registration Form * * *</p>
	  			</div>

				  <div class="grid grid-cols-2 gap-6 mb-6">
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
				        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address <span class="text-red-500 text-md font-bold">*</span></label>
				    		<input type="email" placeholder="Type your email address here ..." x-model="email" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				    		<span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
				    </div>
				    <div>
				      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="text" placeholder="Type your username here ..." x-model="username" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      <span x-show="errors.username" class="text-red-500" x-text="errors.username"></span>
				    </div>
				    <div>
				      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password <span class="text-red-500 text-md font-bold">*</span></label>
				      <input type="password" placeholder="Type your password here ..." x-model="password" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
				      <span x-show="errors.password" class="text-red-500" x-text="errors.password"></span>
				    </div>

				    <div>
				      <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Landline Number <span class="text-gray-500 text-sm italic">(Optional)</span></label>
				      <input type="text" placeholder="Type your landline number here ..." x-model="phone" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">				      
				    </div>  
				    <div>
				      <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number <span class="text-gray-500 text-sm italic">(Optional)</span></label>
				      <input type="text" placeholder="Type your mobile number here ..." x-model="mobile" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">				      
				    </div>
				    <div>
				    	<button type="submit" class="text-white text-shadow-lg bg-gradient-to-t from-green-500 to-green-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-none text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer"><span x-show="!loading">Register</span>
      				<span x-show="loading">Registering, please wait ...</span></button>
				    </div>
				    <div class="text-xs">
				    	Already have an account?
				    	<a href="./login.php" class="text-blue-500 italic">Please login</a>
				    </div>
				  </div>

			</form>

			</div>
	</div>

	<script>
		function formApp() {
		  return {
		    firstname: '',
		    lastname: '',
		    middlename: '',
		    username: '',
		    email: '',
		    password: '',
		    phone: '',
		    mobile: '',
		    loading: false,
		    errors: {},

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

			       const response = await fetch("http://localhost/sdsg/api/register.php", {
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