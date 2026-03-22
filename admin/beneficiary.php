<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">

        <!-- Backdrop -->
        <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <!-- Modal Card -->
                
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
				                  Payment Form
				              </h1>
				              <form @submit.prevent="submitAuth" class="space-y-4 md:space-y-6" action="#">
				                  <div>
				                      <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount to pay</label>
				                      <input type="text" x-model="amount" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter your amount here ..." required="">
				                      <span x-show="errors.amount" class="text-red-500" x-text="errors.amount"></span>
				                  </div>
                                  <div class="flex items-center justify-center">
                                        <button type="button" class="w-full text-white bg-green-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer mr-2">Pay Now</button>

                                        <button @click.prevent="cancelPayment" type="button" class="w-full text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">Cancel</button>
                                  </div>				                  
				                  		                  
				              </form>
				          </div>
				      </div>    

            
        </div>


  		<div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-1">
							<h1 class="text-2xl font-bold bg-green-400 p-2">Beneficiaries</h1>
							
                            <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">
                                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                                    <thead class="text-sm text-white bg-brand border-b border-brand-light">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Last Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                First Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Middle Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Member Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="ben in beneficiaries" :key="ben.id">

                                            <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                                <th scope="row" x-text="ben.lastname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                                                </th>
                                                <td class="px-6 py-4" x-text="ben.firstname"></td>
                                                <td class="px-6 py-4" x-text="ben.middlename"></td>
                                                <td class="px-6 py-4" x-text="ben.classification"></td>
                                                <td class="px-3 py-1 text-right" x-show="showRow">
                                                    <button type="button" @click.prevent="payNow(ben.id)" class="inline-flex items-center text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 cursor-pointer">
                                                    <svg fill="#fff" class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 36 36" version="1.1"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>peso-line</title>
                                                    <path d="M31,13.2H27.89A6.81,6.81,0,0,0,28,12a7.85,7.85,0,0,0-.1-1.19h2.93a.8.8,0,0,0,0-1.6H27.46A8.44,8.44,0,0,0,19.57,4H11a1,1,0,0,0-1,1V9.2H7a.8.8,0,0,0,0,1.6h3v2.4H7a.8.8,0,0,0,0,1.6h3V31a1,1,0,0,0,2,0V20h7.57a8.45,8.45,0,0,0,7.89-5.2H31a.8.8,0,0,0,0-1.6ZM12,6h7.57a6.51,6.51,0,0,1,5.68,3.2H12Zm0,4.8H25.87a5.6,5.6,0,0,1,0,2.4H12ZM19.57,18H12V14.8H25.25A6.51,6.51,0,0,1,19.57,18Z" class="clr-i-outline clr-i-outline-path-1"></path>
                                                    <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                                                </svg>
                                                    Pay
                                                    </button>
                                                    <button type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                    <svg fill="#fff" class="w-4 h-4 mr-1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                        width="24" height="24" viewBox="0 0 494.936 494.936" xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                                                                c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                                                                s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                                                                c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                                                            <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                                                                c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                                                                c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                                                                C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                                                                l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                                                                c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                                                        </g>
                                                    </g>
                                                    </svg>
                                                    Edit
                                                    </button>
                                                    <button type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                                                    <svg class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M14 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M4 7H20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    Disable
                                                    </button>
                                                    <button type="button" @click.prevent="showForm(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 38 32" enable-background="new 0 0 38 32" xml:space="preserve">
                                                <g>
                                                    <path fill="#fff" d="M36.5,0h-35C0.673,0,0,0.673,0,1.5v29C0,31.327,0.673,32,1.5,32h35c0.827,0,1.5-0.673,1.5-1.5v-29
                                                        C38,0.673,37.327,0,36.5,0z M37,30.5c0,0.275-0.225,0.5-0.5,0.5h-35C1.225,31,1,30.775,1,30.5v-29C1,1.225,1.225,1,1.5,1h35
                                                        C36.775,1,37,1.225,37,1.5V30.5z"/>
                                                    <path fill="#fff" d="M31.5,14h-25C5.673,14,5,14.673,5,15.5v10C5,26.327,5.673,27,6.5,27h25c0.827,0,1.5-0.673,1.5-1.5v-10
                                                        C33,14.673,32.327,14,31.5,14z M32,25.5c0,0.275-0.225,0.5-0.5,0.5h-25C6.225,26,6,25.775,6,25.5v-10C6,15.225,6.225,15,6.5,15h25
                                                        c0.275,0,0.5,0.225,0.5,0.5V25.5z"/>
                                                    <path fill="#fff" d="M31.5,5h-25C5.673,5,5,5.673,5,6.5v3C5,10.327,5.673,11,6.5,11h25c0.827,0,1.5-0.673,1.5-1.5v-3
                                                        C33,5.673,32.327,5,31.5,5z M32,9.5c0,0.275-0.225,0.5-0.5,0.5h-25C6.225,10,6,9.775,6,9.5v-3C6,6.225,6.225,6,6.5,6h25
                                                        C31.775,6,32,6.225,32,6.5V9.5z"/>
                                                </g>
                                                </svg>
                                                    Form
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>                                        
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
				</div>

	<script>
        function pageLoad() {
		  return {
		    user: {}, 
            showRow: false,
            userId: null,
            amount: '',
            beneficiaries: [],
            payNow(id) {
                this.userId = id;
                const paymentModal = document.getElementById('paymentModal');	
                paymentModal.classList.remove('hidden');                
            },
            cancelPayment() {
                const paymentModal = document.getElementById('paymentModal');	
                paymentModal.classList.add('hidden');
            },
            showForm(id) {
                alert("This will lead you to a registration form in pdf format for beneficiary with id number: " + id);
            },
            async init() { 
                let user_id = sessionStorage.getItem('user_id');                
                let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
                                body: JSON.stringify({ 
                                    user_id: user_id
                                })
                            });
                this.user = await response.json();
                this.beneficiaries = this.user.users;               
                this.showRow = false;                 
                if(this.beneficiaries.length > 0) { 
                    this.showRow = true;
                }
            }	
		  }
		}        
	</script>

</body>
</html>