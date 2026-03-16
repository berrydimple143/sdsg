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
  		<?php include('./includes/front/modals/login-successful.php'); ?>
				  <div x-data="authForm()" x-init="checkAuth()" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
				      
				      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
				                  Sign in to your account
				              </h1>
				              <form @submit.prevent="submitAuth" class="space-y-4 md:space-y-6" action="#">
				                  <div>
				                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
				                      <input type="email" x-model="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
				                      <span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
				                  </div>
				                  <div>
				                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
				                      <input type="password" x-model="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
				                      <span x-show="errors.password" class="text-red-500" x-text="errors.password"></span>
				                  </div>
				                  <div class="flex items-center justify-between">
				                      <div class="flex items-start">
				                          <div class="flex items-center h-5">
				                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
				                          </div>
				                          <div class="ml-3 text-sm">
				                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
				                          </div>
				                      </div>
				                      <a href="#" @click="alert('This is not functioning yet.')" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
				                  </div>
				                  <button type="submit" class="w-full text-white bg-green-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">Sign in</button>
				                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
				                      Don’t have an account yet? <a href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
				                  </p>
				              </form>
				          </div>
				      </div>
				  </div>
				

	<script>

		function checkAuth() {
			  //sessionStorage.clear();
			  //sessionStorage.removeItem("logged");
        let logged = sessionStorage.getItem("logged");
        setTimeout(() => {
           if(logged) {
           		window.location = "./admin/index.php";
           }
        }, 50);
    }

		function authForm() {
		  return {
		    email: '',
		    password: '',		    
		    loading: false,
		    errors: {},

		    validate() {
		      this.errors = {}
		      if (!this.email) this.errors.email = "(Required)"
		      if (!this.password) this.errors.password = "(Required)"
		      return Object.keys(this.errors).length === 0
		    },

		    async submitAuth() {
		      if (!this.validate()) return
		      this.loading = true
		    	try {
					     const response = await fetch("http://localhost/vjstore/api/login.php", {
					        method: "POST",
					        headers: {"Content-Type": "application/json"},
					        body: JSON.stringify({ 
					        	email: this.email,
					        	password: this.password		        	
					        })
					      });
					      const resp = await response.json();
					      const modal = document.getElementById('loginSuccessful');

					      if(!resp.status) {
					      	alert("Invalid email/password.");
					      } else {
					      	modal.classList.remove('hidden');  	
					      	setTimeout(() => {
									  modal.classList.add('hidden');
									  sessionStorage.setItem("user", resp.user);
									  sessionStorage.setItem("logged", true);
									  window.location = "./admin/index.php";
									}, 2000);
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