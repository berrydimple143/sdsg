<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <link rel="stylesheet" type="text/css" href="../node_modules/print-js/dist/print.css">
  <style>
    [x-cloak] { display: none !important; }
  </style>
  <script defer src="../js/alpinejs.cdn.min.js"></script>
  <script src="../node_modules/print-js/dist/print.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
    <?php include('../includes/admin/modals/save-successful.php'); ?>
    <?php include('../includes/admin/modals/tables/payments.php'); ?>
    <?php include('../includes/admin/modals/payment.php'); ?>
    <?php include('../includes/admin/modals/edit-payment.php'); ?>
    <?php include('../includes/admin/modals/delete-payment.php'); ?>
    <?php include('../includes/admin/modals/change-successful.php'); ?>
    <?php include('../includes/admin/modals/add-successful.php'); ?>
    <?php include('../includes/admin/modals/delete-beneficiary.php'); ?>
    <?php include('../includes/admin/modals/delete-successful.php'); ?>
    <?php include('../includes/admin/modals/edit-successful.php'); ?>        
    <?php include('../includes/admin/bform.php'); ?>
    <?php include('../includes/admin/modals/upload-excel.php'); ?>	
    <?php include('../includes/admin/modals/uploading.php'); ?>
    <?php include('../includes/admin/modals/exporting.php'); ?>
    <?php include('../includes/admin/modals/loading-users.php'); ?>
    <?php include('../includes/admin/modals/printing.php'); ?>
    <canvas x-ref="receiptCanvas" class="hidden"></canvas>

    <canvas id="formCanvas" x-ref="printableForm" width="1699" height="2360" class="top-0 left-0 hidden"></canvas>
    <div id="beneficiaryPage" class="flex h-screen bg-transparent">
        <input type="checkbox" id="menu-toggle" class="hidden peer">
        <?php include('../includes/admin/sidebar.php'); ?>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <?php include('../includes/admin/header.php'); ?>
            <div class="p-1">

                <div class="flex bg-green-400 items-center justify-between border-1 border-gray-800">
                    <div class="flex items-center space-x-2">
                        <h1 class="text-2xl text-purple-600 font-bold p-2 text-shadow-lg">List of Beneficiaries</h1>
                        <input 
                            type="text" 
                            x-model="searchQuery"
                            @input="currentPage = 1"
                            placeholder="Search beneficiary here ..." 
                            class="text-md bg-white h-6 w-64 p-4 rounded-sm border-green-900 shadow-md outline-none">
                    </div>
                    <div class="flex space-x-1">
                        <button type="button" @click.prevent="importBeneficiary" class="inline-flex items-center text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                        <?php include('../includes/admin/icons/import.php'); ?>
                            Import Excel File
                        </button>
                        <button type="button" @click.prevent="addBeneficiary" class="inline-flex items-center text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                        <?php include('../includes/admin/icons/add.php'); ?>
                            Add Beneficiary
                        </button>
                    </div>
                </div>
                    
                <div class="flex items-center justify-between w-full p-1 bg-green-600">
                    <div class="flex border-1 border-white p-1">
                        <label for="regionFilter" class="text-white text-shadow-lg px-2 py-1">Filter By:</label>
                        <select @change.prevent="selectRegionFilter($event.target.value, $event.target.options[$event.target.selectedIndex].text)" x-model="regionFilter" id="regionFilter" name="regionFilter" class="bg-white mt-1 block w-28 px-2 py-1  rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Region</option>
                            <template x-for="reg in regions" :key="reg.id">
                                <option :value="reg.id" x-text="reg.name"></option>
                            </template>
                        </select>
                        <select @change.prevent="selectProvinceFilter($event.target.value, $event.target.options[$event.target.selectedIndex].text)" x-model="provinceFilter" class="bg-white mt-1 block w-28 px-2 py-1  rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Province</option>
                            <template x-for="prov in provinces" :key="prov.id">
                                <option :value="prov.id" x-text="prov.name"></option>
                            </template>
                        </select>
                        <select @change.prevent="selectCityFilter($event.target.value, $event.target.options[$event.target.selectedIndex].text)" x-model="cityFilter" class="bg-white mt-1 block w-28 px-2 py-1  rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">City</option>
                            <template x-for="ct in cities" :key="ct.id">
                                <option :value="ct.id" x-text="ct.name"></option>
                            </template>
                        </select>
                        <select @change="selectDistrictFilter($event.target.value, $event.target.options[$event.target.selectedIndex].text)" x-model="districtFilter" class="bg-white mt-1 block w-28 px-2 py-1  rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">District</option>
                            <template x-for="dist in districts" :key="dist.id">
                                <option :value="dist.id" x-text="dist.name"></option>
                            </template>
                        </select>
                        <select @change="selectBarangayFilter($event.target.value, $event.target.options[$event.target.selectedIndex].text)" x-model="regionFilter" class="bg-white mt-1 block w-28 px-2 py-1  rounded-none outline-1 outline-gray-800 border-1 border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Barangay</option>
                            <template x-for="bar in barangays" :key="bar.id">
                                <option :value="bar.id" x-text="bar.name"></option>
                            </template>
                        </select>
                    </div>
                    <div class="flex space-x-1">                        
                        <button type="button" 
                        @click.prevent="printNow" class="inline-flex items-center text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                        <?php include('../includes/admin/icons/print.php'); ?>
                            Print
                        </button>
                        <button type="button" @click.prevent="exportUsers" class="inline-flex items-center text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                        <?php include('../includes/admin/icons/export.php'); ?>
                            Export to Excel
                        </button>
                    </div>
                </div>       

                <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">                                
                    <?php include('../includes/admin/tables/beneficiary.php'); ?>
                </div>
            </div>
        </div>
    </div>
	<script>
        function pageLoad() {
		  return {
		    user: {}, 
            pageType: 'some',
            pageId: 1,
            idPayments: [],
            jans: [],
            febs: [],
            mars: [],
            aprs: [],
            mays: [],
            juns: [],
            juls: [],
            augs: [],
            seps: [],
            octs: [],
            novs: [],
            decs: [],
            totalA: [],
            totalAB: [],
            exportId: null,
            exportPage: '',
            totalUsers: 0,
            regionFilter: '',
            provinceFilter: '',
            cityFilter: '',
            districtFilter: '',            
            barangayFilter: '',     
            showRow: false,
            userId: null,
            created_at: '',
            deleteBeneficiaryId: null,
            deleteBeneficiaryModal: null,
            paymentModal: null,
            paymentsTableModal: null,
            beneficiaryModal: null,
            beneficiaryPage: null,
            editPaymentModal: null,
            changeSuccessful: null,
            deleteSuccessful: null,
            deletePaymentModal: null,
            editSuccessfulModal: null,
            uploadExcelModal: null,
            uploadingModal: null,
            exportingModal: null,
            loadingModal: null,
            printingModal: null,
            excelUploadMessage: '',
            excelUploadLoading: false,            
            saveMode: '',
            totalPay: 0.00,
            amount: '',
            receiver: null,
            type: '',
            searchWord: '',
            owner: '',            
            errors: [],
            beneficiaries: [],
            users: [],
            payments: [],
            regions: [],
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
			region_id: '',			
		    province: '',
			province_id: '',
		    city: '',		
			city_id: '', 
		    district: '',
			district_id: '',
		    barangay: '',
			barangay_id: '',
		    purok: '',
			purok_id: '',
            address: '',
			bday: '',
			benday1: '',
			benday2: '',
			benday3: '',
			benday4: '',
		    zipcode: '',
			birthdate: '',
			benbirthdate1: '',
			benbirthdate2: '',
			benbirthdate3: '',
			benbirthdate4: '',
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
			insurance: '50',
			burial: '50',
			courseToAvail: '',
		    loading: false,
			photoModal: null,
			filename: '',
		    errors: {},
			imageUrl: null,
            currentPage: 1,
            searchQuery: '',
            pageSize: 5,
            maxVisibleButtons: 5,
            validate() {
                this.errors = {}			  
                
                if(!this.firstname) {
                    this.errors.firstname = "(Required)";
                    alert('First Name is required');
                    const fname = document.getElementById("firstname");
                    fname.focus();
                } 
                if(!this.lastname) {
                    this.errors.lastname = "(Required)";
                    alert('Last Name is required');
                    const lname = document.getElementById("lastname");
                    lname.focus();
                }

                return Object.keys(this.errors).length === 0;
		    },
            selectRegionFilter(id, txt) {                
                this.selectRegion(id, txt);
                this.pageId = id;
                this.pageType = 'region';
                this.getUsers(id, 'region', 'ok');
                this.exportId = id;
                this.exportPage = 'region';
            },
            selectRegion(id, txt) {
		    	this.region_id = id;
				this.region = txt;
		    	this.getAllDataWithId('province', id);
		    },
            selectProvinceFilter(id, txt) {
                this.selectProvince(id, txt);
                this.pageId = id;
                this.pageType = 'province';
                this.getUsers(id, 'province', 'ok');
                this.exportId = id;
                this.exportPage = 'province';
            },
            selectProvince(id, txt) {
				this.province_id = id;
				this.province = txt;
				this.getAllDataWithId('city', id);
		    },	
            selectCityFilter(id, txt) {
                this.selectCity(id, txt);
                this.pageId = id;
                this.pageType = 'city';
                this.getUsers(id, 'city', 'ok');
                this.exportId = id;
                this.exportPage = 'city';
            },
		    selectCity(id, txt) {
				this.city_id = id;
				this.city = txt;
				this.getAllDataWithId('district', id);
		    },
            selectDistrictFilter(id, txt) {
                this.selectDistrict(id, txt);
                this.pageId = id;
                this.pageType = 'district';
                this.getUsers(id, 'district', 'ok');
                this.exportId = id;
                this.exportPage = 'district';
            },
			selectDistrict(id, txt) {
		    	this.district_id = id;
				this.district = txt;
				this.getAllDataWithId('barangay', id);
		    },
            selectBarangayFilter(id, txt) {
                this.selectBarangay(id, txt);
                this.pageId = id;
                this.pageType = 'barangay';
                this.getUsers(id, 'barangay', 'ok');
                this.exportId = id;
                this.exportPage = 'barangay';
            },
			selectBarangay(id, txt) {
		    	this.barangay_id = id;
				this.barangay = txt;
				this.getAllDataWithId('purok', id);
		    },
			selectPurok(id, txt) {
				this.purok_id = id;
				this.purok = txt;
			},
            async getAllData(page) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllData.php', {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({                                     
						page: page
					})
				});
                let res = await response.json();
                if(page == 'region') {					
                    this.regions = res.data;      
                } else if(page == 'province') {
                    this.provinces = res.data;   
				} else if(page == 'city') {
                    this.cities = res.data; 
				} else if(page == 'district') {
                    this.districts = res.data; 
				} else if(page == 'barangay') {
                    this.barangays = res.data; 
				} else if(page == 'purok') {
                    this.puroks = res.data; 
                }               
            },
            async getAllDataWithId(page, id) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllDataWithId.php', {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({                                     
						page: page,
						id: id
					})
				});
                let res = await response.json();
                if(page == 'region') {
                    this.regions = res.data;                    
                } else if(page == 'province') {
                    this.provinces = res.data;   
				} else if(page == 'city') {
                    this.cities = res.data; 
				} else if(page == 'district') {
                    this.districts = res.data; 
				} else if(page == 'barangay') {
                    this.barangays = res.data; 
				} else if(page == 'purok') {
                    this.puroks = res.data; 
                }               
            },
            clearInputs() {
		    		this.firstname = ''; this.lastname = ''; this.middlename = '';		    		
		    		this.email = ''; this.region = ''; this.province = '';
		    		this.city = ''; this.district = ''; this.barangay = '';
		    		this.purok = ''; this.civilstatus = ''; this.gender = '';
					this.religion = ''; this.bloodtype = ''; this.nickname = '';		    		
		    		this.suffix = ''; this.zipcode = ''; this.birthdate = ''; 
					this.birthplace = ''; this.age = ''; this.nationality = ''; 
					this.country = ''; this.height = ''; this.weight = ''; this.father = '';
		    		this.mother = ''; this.spouse = ''; this.education = '';
					this.position = ''; this.skill = ''; this.organization = '';		    		
		    		this.contact = ''; this.fb = ''; this.sss = ''; this.philhealth = '';		    		
		    		this.voter = ''; this.passport = ''; this.profid = ''; this.pagibig = '';		    		
		    		this.license = ''; this.senior = ''; this.chairman = ''; this.area = '';		    		
		    		this.mcnumber = ''; this.classification = ''; this.tribe = '';
		    		this.contactname = ''; this.contactnumber = ''; this.contactaddress = '';
		    		this.benname1 = '';	this.benage1 = ''; this.benrelationship1 = '';
					this.benbirthdate1 = ''; this.benname2 = ''; this.benage2 = '';
		    		this.benrelationship2 = ''; this.benbirthdate2 = ''; this.benname3 = '';
		    		this.benage3 = ''; this.benrelationship3 = ''; this.benbirthdate3 = '';
					this.benname4 = ''; this.benage4 = ''; this.benrelationship4 = '';
					this.benbirthdate4 = ''; this.insurance = ''; this.burial = '';
					this.courseToAvail = ''; this.userId = null; this.saveMode = '';
		    },
            async saveBeneficiary() {                
                if (!this.validate()) return;
                    try {
                    const response = await fetch("http://localhost/sdsg/api/admin/beneficiary.php", {
                        method: "POST",
                        headers: {"Content-Type": "application/json"},
                        body: JSON.stringify({ 
                            firstname: this.firstname, lastname: this.lastname,
                            middlename: this.middlename, email: this.email,
                            nickname: this.nickname, suffix: this.suffix,
                            region_id: this.region_id, province_id: this.province_id,
                            city_id: this.city_id, district_id: this.district_id,
                            barangay_id: this.barangay_id, purok_id: this.purok_id,
                            zipcode: this.zipcode, birthdate: this.birthdate,
                            birthplace: this.birthplace, age: this.age,
                            civilstatus: this.civilstatus, gender: this.gender,
                            nationality: this.nationality, country: this.country,
                            religion: this.religion, bloodtype: this.bloodtype,
                            height: this.height, weight: this.weight, address: this.address,                            
                            father: this.father, mother: this.mother,
                            spouse: this.spouse, education: this.education,
                            position: this.position, skill: this.skill,
                            organization: this.organization, contact: this.contact,
                            fb: this.fb, sss: this.sss, philhealth: this.philhealth,
                            voter: this.voter, passport: this.passport,
                            profid: this.profid, pagibig: this.pagibig,
                            license: this.license, senior: this.senior,
                            chairman: this.chairman, area: this.area,
                            mcnumber: this.mcnumber, classification: this.classification,
                            tribe: this.tribe, contactname: this.contactname,
                            contactnumber: this.contactnumber, contactaddress: this.contactaddress,
                            benname1: this.benname1, benage1: this.benage1,
                            benrelationship1: this.benrelationship1, benbirthdate1: this.benbirthdate1,
                            benname2: this.benname2, benage2: this.benage2,
                            benrelationship2: this.benrelationship2, benbirthdate2: this.benbirthdate2,
                            benname3: this.benname3, benage3: this.benage3,
                            benrelationship3: this.benrelationship3, benbirthdate3: this.benbirthdate3,
                            benname4: this.benname4, benage4: this.benage4,
                            benrelationship4: this.benrelationship4, benbirthdate4: this.benbirthdate4,
                            insurance: this.insurance, burial: this.burial, 
                            courseToAvail: this.courseToAvail, filename: this.filename,
                            userId: this.userId, mode: this.saveMode
                        })
                    });

                    const res = await response.json();                    
                    this.beneficiaryModal.classList.add('hidden');                 

                    if(!res.status) {                        
                        alert(res.message);                  
                    } else {
                        const modal = document.getElementById('successModal');
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 2000);
                    }                   
                } catch (error) {
                    console.error('Error fetching data:', error);
                } finally {
                    this.clearInputs();                       
                    setTimeout(() => {
                        window.location = "beneficiary.php";
                    }, 2000);
                }
		    },
            getBday(btype) {
				if(btype == 'own') {
					this.bday = this.convertDate(this.birthdate);
				} else if(btype == 'ben1') {
					this.benday1 = this.convertDate(this.benbirthdate1);
				} else if(btype == 'ben2') {
					this.benday2 = this.convertDate(this.benbirthdate2);
				} else if(btype == 'ben3') {
					this.benday3 = this.convertDate(this.benbirthdate3);
				} else if(btype == 'ben4') {
					this.benday4 = this.convertDate(this.benbirthdate4);
				}
				this.drawText();
			},
            checkAuth() {
                let logged = sessionStorage.getItem("logged");
                setTimeout(() => {
                    if(!logged) {
                        window.location = "../login.php";
                    }
                }, 50);
            },
            async editBeneficiary(id) {
                this.saveMode = 'edit';
                this.userId = id;
                this.beneficiaryModal.classList.remove('hidden');
                this.beneficiaryPage.classList.add('hidden');                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getData.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            id: id,
                            page: 'beneficiary'
                        })
                    });
                    let res = await response.json();
                    let bf = res.data;
                    this.lastname = bf.lastname;
                    this.firstname = bf.firstname;
                    this.middlename = bf.middlename;
                    this.email = bf.email;
                    this.region_id = bf.region_id;
                    this.suffix = bf.suffix;
                    this.nickname = bf.nickname;
                    this.zipcode = bf.zipcode;
                    this.birthplace = bf.birthplace;                    
                    this.age = bf.age;
                    this.civilstatus = bf.civilstatus;
                    this.gender = bf.gender;
                    this.nationality = bf.nationality;
                    this.country = bf.country;
                    this.religion = bf.religion;
                    this.bloodtype = bf.bloodtype;
                    this.height = bf.height;
                    this.weight = bf.weight;
                    this.address = bf.address;
                    this.sss = bf.sss;
                    this.philhealth = bf.philhealth;
                    this.voter = bf.voter;
                    this.passport = bf.passport;
                    this.profid = bf.profid;
                    this.pagibig = bf.pagibig;
                    this.license = bf.license;
                    this.senior = bf.senior;
                    this.father = bf.father;
                    this.mother = bf.mother;
                    this.spouse = bf.spouse;
                    this.contactname = bf.contactname;
                    this.contactnumber = bf.contactnumber;
                    this.contactaddress = bf.contactaddress;
                    this.education = bf.education;
                    this.position = bf.position;
                    this.skill = bf.skill;
                    this.organization = bf.organization;
                    this.contact = bf.contact;
                    this.fb = bf.fb;
                    this.photo = bf.photo;
                    this.chairman = bf.chairman;
                    this.area = bf.area;
                    this.mcnumber = bf.mcnumber;
                    this.classification = bf.classification;
                    this.tribe = bf.tribe;
                    this.insurance = bf.insurance;
                    this.burial = bf.burial;
                    this.courseToAvail = bf.courseToAvail;
                    this.benname1 = bf.benname1;
                    this.benname2 = bf.benname2;
                    this.benname3 = bf.benname3;
                    this.benname4 = bf.benname4;
                    this.benage1 = bf.benage1;
                    this.benage2 = bf.benage2;
                    this.benage3 = bf.benage3;
                    this.benage4 = bf.benage4;
                    this.benrelationship1 = bf.benrelationship1;
                    this.benrelationship2 = bf.benrelationship2;
                    this.benrelationship3 = bf.benrelationship3;
                    this.benrelationship4 = bf.benrelationship4;
                    
                    if(res.data.region_id) {
                        this.getAllDataWithId('province', bf.region_id);
                        this.getAllDataWithId('city', bf.province_id);
                        this.getAllDataWithId('district', bf.city_id);
                        this.getAllDataWithId('barangay', bf.district_id);
                        this.getAllDataWithId('purok', bf.barangay_id);
                        setTimeout(() => {
                            this.province_id = bf.province_id;
                            this.city_id = bf.city_id;
                            this.district_id = bf.district_id;
                            this.barangay_id = bf.barangay_id;
                            this.purok_id = bf.purok_id;
                        }, 500);
                    }
                    this.birthdate = bf.birthdate;
                    this.benbirthdate1 = bf.benbirthdate1;
                    this.benbirthdate2 = bf.benbirthdate2;
                    this.benbirthdate3 = bf.benbirthdate3;
                    this.benbirthdate4 = bf.benbirthdate4;
                    if(bf.birthdate || bf.birthdate != '') {
                        this.birthdate = convertDateToHtml(bf.birthdate);
                    } 
                    if(bf.benbirthdate1 || bf.benbirthdate1 != '') {
                        this.benbirthdate1 = convertDateToHtml(bf.benbirthdate1);
                    } 
                    if(bf.benbirthdate2 || bf.benbirthdate2 != '') {
                        this.benbirthdate2 = convertDateToHtml(bf.benbirthdate2);
                    } 

                    if(bf.benbirthdate3 || bf.benbirthdate3 != '') {
                        this.benbirthdate3 = convertDateToHtml(bf.benbirthdate3);
                    } 
                    if(bf.benbirthdate4 || bf.benbirthdate4 != '') {
                        this.benbirthdate4 = convertDateToHtml(bf.benbirthdate4);
                    }                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                }
            },
            async populatePlaces() {
                this.region_id = res.data.region_id;
                this.province_id = res.data.province_id;
            },
            addBeneficiary() {      
                this.saveMode = 'add';
                this.beneficiaryModal.classList.remove('hidden');
                this.beneficiaryPage.classList.add('hidden');           
            },
            hideExcelInput() {
                this.$refs.excelFile.classList.add('hidden');
                this.$refs.excelUploadButton.classList.remove('hidden');                
            },
            async uploadExcelFile() {
                let file = this.$refs.excelFile.files[0];
                if (!file) {
                    alert('Please select an Excel file first.');
                    return;
                }

                this.uploadExcelModal.classList.add('hidden');
                this.uploadingModal.classList.remove('hidden');
                this.excelUploadLoading = true;
                this.excelUploadMessage = '';

                let formData = new FormData();
                formData.append('excel_file', file);                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/import.php', {
                        method: 'POST',
                        body: formData
                    });                
                    let data = await response.json();
                    //if(data.status) {
                        setTimeout(() => {
                            this.uploadingModal.classList.add('hidden');
                            window.location = "beneficiary.php";
                        }, 2000);
                    // } else {
                    //     alert("File upload failed.");
                    // }
                } catch(error) {
		      		console.error('Error fetching data:', error);
                }
            },
            importBeneficiary() {
                this.beneficiaryPage.classList.add('hidden');
                this.uploadExcelModal.classList.remove('hidden');
            },
            cancelSave() {                
                this.beneficiaryPage.classList.remove('hidden');
                this.beneficiaryModal.classList.add('hidden');
            },
            downloadCanvas() {
                const canvas = this.$refs.printableForm;
                const image = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = image;
                link.download = `${this.user.firstname}-${this.user.lastname}.png`;
                link.click();
            },
            drawText() {
				this.drawForm(this.firstname, this.lastname, this.middlename, this.suffix,
					this.nickname, this.region, this.province, this.city, this.district,
					this.barangay, this.purok, this.zipcode, this.bday, this.birthplace,
					this.age, this.religion, this.nationality, this.country, this.civilstatus, 
					this.gender, this.bloodtype, this.height, this.weight, this.father,
					this.mother, this.spouse, this.education, this.position, this.skill,
					this.organization, this.contact, this.fb, this.email, this.sss,
					this.philhealth, this.voter, this.passport, this.profid, this.pagibig,
					this.license, this.senior, this.classification, this.chairman, this.area,
					this.mcnumber, this.tribe, this.contactname, this.contactnumber,
					this.contactaddress, this.benname1, this.benname2, this.benname3,
					this.benname4, this.convertDate(this.benbirthdate1), 
                    this.convertDate(this.benbirthdate2), this.convertDate(this.benbirthdate3), 
                    this.convertDate(this.benbirthdate4), this.benage1, this.benage2, this.benage3, 
                    this.benage4, this.benrelationship1, this.benrelationship2, this.benrelationship3, 
                    this.benrelationship4, this.insurance, this.burial, this.courseToAvail, this.filename
				);
			},
            drawForm(fname, lname, mname, sfx, nname, reg, pr, ct, ds, br, pk, zp, bdy, bp, ag, 
				rlg, nat, cnty, cstat, gend, bldt, hgt, wgt, fth, mth, sps, edc, pos, skl, org,
				cntc, fcb, eml, ss, phil, vtr, pspt, prof, pag, lic, sen, cls, chr, are, mcn,
				trb, ctcnam, ctcnum, ctcadr, benn1, benn2, benn3, benn4, benb1, benb2, benb3,
				benb4, beng1, beng2, beng3, beng4, benr1, benr2, benr3, benr4, ins, bur, cta, fln
			) {
				const canvas = document.getElementById('formCanvas');
				const ctx = canvas.getContext('2d');
				const img = new Image();
				img.onload = function() {
					ctx.drawImage(img, 0, 0);
					ctx.font = '25px Arial';
					ctx.fillStyle = '#3e3d3d'; 
					const fullname = `${fname}  ${mname}  ${lname}  ${sfx}`;
					if(fln !== '') {                        
						const img2 = new Image();
						img2.src = `../images/photos/${fln}`;                       
						ctx.drawImage(img2, 1300, 65);
					}
					if(ins == '50') {
						ctx.fillText('/', 220, 2063);
					} else if(ins == '100') {
						ctx.fillText('/', 220, 2095);
					} else if(ins == '150') {
						ctx.fillText('/', 220, 2135);
					} else if(ins == '200') {
						ctx.fillText('/', 390, 2063);
					} else if(ins == '250') {
						ctx.fillText('/', 390, 2095);
					} else if(ins == '300') {
						ctx.fillText('/', 390, 2135);
					}
					if(bur == '50') {
						ctx.fillText('/', 750, 2063);
					} else if(bur == '100') {
						ctx.fillText('/', 750, 2095);
					} else if(bur == '150') {
						ctx.fillText('/', 750, 2135);
					} else if(bur == '200') {
						ctx.fillText('/', 920, 2063);
					} else if(bur == '250') {
						ctx.fillText('/', 920, 2095);
					} else if(bur == '300') {
						ctx.fillText('/', 920, 2135);
					}
					if(cls == "4P's") {
						ctx.fillText('/', 435, 1490);
					} else if(cls == "IP's") {
						ctx.fillText('/', 545, 1490);
					}
					if(trb == "Muslim") {
						ctx.fillText('/', 785, 1490);
					} else {
						ctx.fillText('/', 947, 1490);
						ctx.fillText(trb, 1100, 1490);
					} 								
					if(edc == 'High School Graduate') {
						ctx.fillText("/", 508, 1030);
					} else if(edc == 'College Graduate') {
						ctx.fillText("/", 837, 1030);
					} else if(edc == 'Vocational') {
						ctx.fillText("/", 1117, 1030);
					} else if(edc == 'Graduate Studies') {
						ctx.fillText("/", 1297, 1030);
					}					
					if(cstat == 'Single') {
						ctx.fillText("/", 391, 725);
					} else if(cstat == 'Married') {
						ctx.fillText("/", 545, 725);
					} else if(cstat == 'Separated') {
						ctx.fillText("/", 727, 725);
					} else if(cstat == 'Widowed') {
						ctx.fillText("/", 947, 725);
					}
					if(gend == 'Male') {
						ctx.fillText("/", 1275, 725);
					} else if(gend == 'Female') {
						ctx.fillText("/", 1405, 725);
					}					
					ctx.fillText(fullname, 300, 597);			
					ctx.fillText(nname, 1290, 597);
					ctx.fillText(reg, 320, 635);
					ctx.fillText(pr, 460, 635);
					ctx.fillText(ct, 680, 635);
					ctx.fillText(ds, 940, 635);		
					ctx.fillText(br, 1115, 635);
					ctx.fillText(pk, 1310, 635);
					ctx.fillText(zp, 1500, 635);
					ctx.fillText(bdy, 365, 770);
					ctx.fillText(bp, 880, 770);	
					ctx.fillText(ag, 1490, 770);
					ctx.fillText(rlg, 330, 805);						
					ctx.fillText(nat, 980, 805);
					ctx.fillText(cnty, 1300, 805);		
					ctx.fillText(fth, 430, 915);
					ctx.fillText(mth, 1150, 915);
					ctx.fillText(sps, 410, 950);
					ctx.fillText(bldt, 380, 840);
					ctx.fillText(hgt, 610, 840);
					ctx.fillText(wgt, 880, 840);
					ctx.fillText(pos, 340, 1070);
					ctx.fillText(skl, 1000, 1070);
					ctx.fillText(org, 200, 1140);		
					ctx.fillText(cntc, 395, 1255);
					ctx.fillText(fcb, 860, 1255);
					ctx.fillText(eml, 1312, 1255);	
					ctx.fillText(ss, 330, 1335);
					ctx.fillText(phil, 910, 1335);
					ctx.fillText(vtr, 1380, 1335);	
					ctx.fillText(pspt, 350, 1370);
					ctx.fillText(prof, 850, 1370);	
					ctx.fillText(pag, 1330, 1370);
					ctx.fillText(lic, 510, 1405);
					ctx.fillText(sen, 1230, 1405);	
					ctx.fillText(chr, 455, 1535);	
					ctx.fillText(are, 870, 1535);
					ctx.fillText(mcn, 1270, 1535);			
					ctx.fillText(ctcnam, 305, 1685);	
					ctx.fillText(ctcnum, 1190, 1685);
					ctx.fillText(ctcadr, 340, 1725);
					ctx.fillText(benn1, 195, 1850);	
					ctx.fillText(benn2, 195, 1900);
					ctx.fillText(benn3, 195, 1955);
					//ctx.fillText(benn4, 340, 1725);
					ctx.fillText(benb1, 555, 1850);	
					ctx.fillText(benb2, 555, 1900);
					ctx.fillText(benb3, 555, 1955);
					//ctx.fillText(benb4, 340, 1725);
					ctx.fillText(beng1, 1040, 1850);	
					ctx.fillText(beng2, 1040, 1900);
					ctx.fillText(beng3, 1040, 1955);
					//ctx.fillText(beng4, 340, 1725);
					ctx.fillText(benr1, 1320, 1850);	
					ctx.fillText(benr2, 1320, 1900);
					ctx.fillText(benr3, 1320, 1955);
					//ctx.fillText(benr4, 340, 1725);
					if(cta != '') {
						ctarr = cta.match(/(?:\S+\s*){1,4}/g);						
						ctx.fillText(ctarr[0], 1170, 2095);	
						if(ctarr[1] !== undefined || ctarr[1] !== '') {
							ctx.fillText(ctarr[1], 1170, 2125);	
						}				
					}					
				};
				img.src = '../images/form.jpg';				
			},
            cancelUpdate() {                
                this.editPaymentModal.classList.add('hidden');
            },
            async updatePayment() {                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/editData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.amount,
                                        id: this.editId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('edit', 2000);
                }
            },
            async editPayment(id) {
                this.editId = id;
                this.editPaymentModal = document.getElementById('editPaymentModal');
                this.editPaymentModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.editId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();
                    this.amount = res.data.amount;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                }
            },
            async deletePayment() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.deleteId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init();
                    this.displayModal('delete', 2000);
                }
            },
            cancelDeletion() {
                this.deletePaymentModal.classList.add('hidden');
            },
            cancelBeneficiaryDeletion() {
                this.deleteBeneficiaryModal.classList.add('hidden');
            },
            deleteConfirm(id) {
                this.deleteId = id;
                this.deletePaymentModal = document.getElementById('deletePaymentModal');
                this.deletePaymentModal.classList.remove('hidden');                
            },            
            async getName(id) {
                let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ 
                        user_id: id,                        
                        amount: 10,
                        receiver: 'someone',
                        type: 'ID',
                        created_at: '2026-02-21',
                        mode: "single"
                    })
                });
                let payment = await response.json();
                this.owner =  `${payment.data.firstname} ${payment.data.lastname}`;
            },
            getTotal(arr) {
                let total = 0;
                arr.forEach((element, index, array) => {
                    total += element.amount;
                });
                return total;
            },
            closeTable() {
                this.owner = '';
                this.paymentsTableModal.classList.add('hidden');
            },
            setClassification(cls) {
                if(cls == 'paying') {
                    return true;
                } else {
                    return false;
                }
            },
            async changeStatus(id, classification) {
                classification = classification === 'paying' ? 'nonpaying' : 'paying';
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/changeStatus.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({ 
                                id: id,
                                status: classification,
                                page: 'payment'
                            })
                        });
                    let res = await response.json();                    
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('change', 2000);                                        
                }
            },
            async changeUserStatus(id, status) {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/changeStatus.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: id,
                                        status: status,
                                        page: 'beneficiary'
                                    })
                                });
                    let res = await response.json();
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('change', 2000);
                }
            },
            async deleteBeneficiary() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteData.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            id: this.deleteBeneficiaryId,
                            page: 'beneficiary'
                        })
                    });
                    let res = await response.json();
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('deleteUser', 2000);
                }
            },
            displayModal(page, msec) {
                if(page == 'change') {
                    this.changeSuccessful = document.getElementById('changeSuccessful');
                    this.changeSuccessful.classList.remove('hidden');
                } else if(page == 'delete') {
                    this.deletePaymentModal.classList.add('hidden');
                    this.paymentsTableModal.classList.add('hidden');                    
                    this.deleteSuccessful.classList.remove('hidden');
                } else if(page == 'deleteUser') {
                    this.deleteBeneficiaryModal.classList.add('hidden');                   
                    this.deleteSuccessful.classList.remove('hidden');
                } else if(page == 'edit') {
                    this.editPaymentModal.classList.add('hidden');
                    this.paymentsTableModal.classList.add('hidden');
                    this.editSuccessfulModal = document.getElementById('editSuccessfulModal');
                    this.editSuccessfulModal.classList.remove('hidden');
                } else if(page == 'add') {
                    this.paymentModal.classList.add('hidden');
                    this.addSuccessful = document.getElementById('addSuccessful');
                    this.addSuccessful.classList.remove('hidden');                
                }
                setTimeout(() => {
                    if(page == 'change') {
                        this.changeSuccessful.classList.add('hidden');
                    } else if(page == 'delete' || page == 'deleteUser') {
                        this.deleteSuccessful.classList.add('hidden');
                    } else if(page == 'edit') {
                        this.editSuccessfulModal.classList.add('hidden');
                    } else if(page == 'add') {
                        this.addSuccessful.classList.add('hidden');
                    }
                }, msec);
            },
            convertDate(dt) {
				if(dt == '') {
					return dt;
				} else {
					const date = new Date(dt);
					return date.toLocaleDateString('en-US', {
						year: 'numeric',
						month: 'long',
						day: 'numeric',
					});
				}
			},
            convertDateToHtml() {
                if(dt == '') {
					return dt;
				} else {
					const date = new Date(dt);
                    const usFormatter = new Intl.DateTimeFormat('en-US');
                    return usFormatter.format(date);
				}
            },
            getTribe(trb) {
				const tribeContainer = document.getElementById('tribe-container');	
				if(trb == "Others") {
					tribeContainer.classList.remove('hidden');
					this.tribe = this.tribe1;
				} else {
					tribeContainer.classList.add('hidden');
					this.tribe = trb;
				}
			},
			setTribe() {
				this.tribe = this.tribe1;
			},
			addBen() {
				const fourthBeneficiaryName = document.getElementById('benname4');
				const fourthBeneficiaryBday = document.getElementById('benbirthdate4');
				const fourthBeneficiaryAge = document.getElementById('benage4');
				const fourthBeneficiaryRelation = document.getElementById('benrelationship4');
				fourthBeneficiaryName.classList.remove('hidden');
				fourthBeneficiaryBday.classList.remove('hidden');
				fourthBeneficiaryAge.classList.remove('hidden');
				fourthBeneficiaryRelation.classList.remove('hidden');
			},
            async showTable(id) {
                this.getName(id);
                this.userId = id;
                this.paymentsTableModal = document.getElementById('paymentsTableModal');	
                this.paymentsTableModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: id,
                            amount: 10,
                            type: "ID",
                            receiver: "someone",
                            created_at: "2026-02-21",
                            mode: "search"
                        })
                    });
                    let payment = await response.json();
                    this.payments = payment.data;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.totalPay = this.getTotal(this.payments);
                }
            },
            async submitPayment() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: this.userId,
                            amount: this.amount,
                            receiver: this.receiver,
                            type: this.type,
                            created_at: this.created_at,
                            mode: "add"
                        })
                    });
                    this.user = await response.json();
                    this.printReceipt(this.user.data);                    
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('add', 2000);                    
                }
            },            
            payNow(id) {
                this.userId = id;
                this.amount = '';                	
                this.paymentModal.classList.remove('hidden');
            },
            cancelPayment() {                
                paymentModal.classList.add('hidden');
            },
            async showForm(id) {
                this.userId = id;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: id,
                            amount: 10,
                            receiver: 'someone',
                            created_at: '2026-02-21',
                            mode: "download"
                        })
                    });
                    let user = await response.json();                    
                    let usr = user.data;
                    this.user = usr;
                    this.drawForm(usr.firstname, usr.lastname, usr.middlename, usr.suffix,
                        usr.nickname, usr.region, usr.province, usr.city, usr.district,
                        usr.barangay, usr.purok, usr.zipcode, this.convertDate(usr.bday), usr.birthplace,
                        usr.age, usr.religion, usr.nationality, usr.country, usr.civilstatus, 
                        usr.gender, usr.bloodtype, usr.height, usr.weight, usr.father,
                        usr.mother, usr.spouse, usr.education, usr.position, usr.skill,
                        usr.organization, usr.contact, usr.fb, usr.email, usr.sss,
                        usr.philhealth, usr.voter, usr.passport, usr.profid, usr.pagibig,
                        usr.license, usr.senior, usr.classification, usr.chairman, usr.area,
                        usr.mcnumber, usr.tribe, usr.contactname, usr.contactnumber,
                        usr.contactaddress, usr.benname1, usr.benname2, usr.benname3,
                        usr.benname4, this.convertDate(usr.benbirthdate1), 
                        this.convertDate(usr.benbirthdate2), this.convertDate(usr.benbirthdate3), 
                        this.convertDate(usr.benbirthdate4), usr.benage1, usr.benage2, usr.benage3, 
                        usr.benage4, usr.benrelationship1, usr.benrelationship2, usr.benrelationship3, 
                        usr.benrelationship4, usr.insurance, usr.burial, usr.courseToAvail, usr.photo
                    );
                    setTimeout(() => {
						this.downloadCanvas();						
					}, 2000);
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } 
            },
            initDateInput(di) {
                let dt = new Date();
                if(di != '') {
                    dt = new Date(di);
                }                
                let day = ("0" + dt.getDate()).slice(-2);
                let month = ("0" + (dt.getMonth() + 1)).slice(-2);
                let hour = ("0" + (dt.getHours() + 1)).slice(-2);
                let minute = ("0" + (dt.getMinutes() + 1)).slice(-2);
                let second = ("0" + (dt.getSeconds() + 1)).slice(-2);
                return `${dt.getFullYear()}-${month}-${day} ${hour}:${minute}:${second}`; 
            },
            initModals() {
                this.beneficiaryModal = document.getElementById('beneficiaryModal');
                this.beneficiaryPage = document.getElementById('beneficiaryPage');
                this.uploadExcelModal = document.getElementById('uploadExcelModal');
                this.uploadingModal = document.getElementById('uploadingModal');
                this.loadingModal = document.getElementById('loadingModal');
                this.printingModal = document.getElementById('printingModal');
                this.exportingModal = document.getElementById('exportingModal');
                this.deleteBeneficiaryModal = document.getElementById('deleteBeneficiaryModal');
                this.deleteSuccessful = document.getElementById('deleteSuccessful');        
                this.paymentModal = document.getElementById('paymentModal');        
            },
            deleteBeneficiaryConfirm(id) {
                this.deleteBeneficiaryId = id;
                this.deleteBeneficiaryModal.classList.remove('hidden');                
            },
            capitalizeFirstLetter(str) {
                if(!str) return "";
                return str.charAt(0).toUpperCase() + str.slice(1);
            },
            async exportUsers() {      
                this.exportingModal.classList.remove('hidden');          
                try {
                    const response = await fetch('http://localhost/sdsg/api/admin/export.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            pid: this.exportId,
                            page: this.exportPage
                        })
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    // Convert response into a Blob
                    const blob = await response.blob();
                    
                    // Create a link and trigger the download
                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'Beneficiaries.csv');
                    document.body.appendChild(link);
                    link.click();
                    
                    // Cleanup
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(url);
                } catch (error) {
                    console.error('Export failed:', error);
                } finally {
                    this.exportingModal.classList.add('hidden');
                }
            },
            async getUsers(uid, page, search) {
                this.loadingModal.classList.remove('hidden');
                try {
                    this.totalUsers = 0;
                    let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: uid,
                            page: page,
                            action: this.pageType,
                            searchWord: search
                        })
                    });
                    this.user = await response.json();
                    const bfc = this.user;
                    this.beneficiaries = bfc.users;
                    
                    this.totalUsers = this.beneficiaries.length;       
                    this.showRow = false;                 
                    if(this.beneficiaries.length > 0) { 
                        this.showRow = true;
                    }
                } catch(e) {
                    console.log(e);
                } finally {
                    this.loadingModal.classList.add('hidden');
                }                
            },            
            printReceipt(bn) {
                this.drawData(bn);
                    let canvas = this.$refs.receiptCanvas;
                    let dataUrl = canvas.toDataURL('image/png');
                    let win = window.open('', '_blank');
                    win.document.write(`
                        <html>
                        <head>
                            <title>Print Beneficiaries</title>
                            <style>
                                body { text-align: left; margin: 0; padding: 1px; }
                                img { max-width: 100%; height: auto; }
                                @media print {
                                    button { display: none; }
                                    .page-break { page-break-after: always; }
                                }
                            </style>
                        </head>
                        <body>
                            <img src="${dataUrl}" class="print-image" onload="window.print(); window.close();" />
                        </body>
                        </html>
                    `);
                    win.document.close();
            },
            drawData(bn) {                
                let canvas = this.$refs.receiptCanvas;
                let ctx = canvas.getContext('2d');
                canvas.width = 800;
                canvas.height = 500;
                //ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.font = '16px sans-serif';
                ctx.fillStyle = '#000';                
                ctx.fillText('SDSG INITIATIVE INC.', 290, 20);
                ctx.font = '9px sans-serif';  
                ctx.fillText('MJM-28 OPC Bldg., Bago Gallera', 303, 30);
                ctx.fillText('Bago Gallera Rd., Davao City', 310, 40);   
                ctx.fillText('09174895944 / 09066677680', 310, 50);   
                ctx.font = '19px sans-serif';
                ctx.fillText('ACKNOWLEDGEMENT RECEIPT', 220, 85);
                ctx.font = '12px sans-serif';                       
                ctx.fillText('No.:', 595, 130);
                ctx.fillStyle = '#900';
                ctx.font = '18px sans-serif';
                ctx.fillText(bn.number, 625, 127);
                ctx.font = '12px sans-serif';
                ctx.fillStyle = '#000';  
                ctx.beginPath();
                ctx.moveTo(620, 130);
                ctx.lineTo(730,130);
                ctx.stroke();                   
                const fname = bn.firstname + ' ' + bn.lastname;
                ctx.fillText(fname, 100, 160);
                ctx.fillText('NAME          :', 15, 163);               
                ctx.beginPath();
                ctx.moveTo(90, 165);
                ctx.lineTo(620, 165);
                ctx.stroke();
                let addr = bn.address;
                if (!addr) {
                    addr = bn.barangay + ', ' + bn.city + ' City';
                }
                ctx.fillText('ADDRESS   :', 15, 195);
                ctx.fillText(addr, 100, 192);
                ctx.beginPath();
                ctx.moveTo(90, 197);
                ctx.lineTo(620,197);
                ctx.stroke();
                ctx.strokeRect(15, 215, 720, 25);     
                ctx.strokeRect(15, 240, 720, 40);    
                ctx.strokeRect(15, 215, 470, 65);
                ctx.strokeRect(485, 215, 85, 65);
                ctx.font = '14px sans-serif';     
                ctx.fillText('DESCRIPTION', 235, 232);  
                ctx.font = '16px sans-serif';     
                ctx.fillText(bn.description, 95, 265);
                ctx.fillText('1 pc', 510, 265);
                ctx.fillText('Php ' + bn.amount.toFixed(2), 600, 265);
                ctx.font = '14px sans-serif';       
                ctx.fillText('QUANTITY', 495, 232);      
                ctx.fillText('AMOUNT', 625, 232);  
                ctx.fillText('RECEIVED BY     :', 15, 320);  
                ctx.fillText(bn.receiver.toUpperCase(), 150, 317);              
                ctx.beginPath();
                ctx.moveTo(140, 325);
                ctx.lineTo(450, 325);
                ctx.stroke();
                ctx.fillText('DATE:', 485, 320);
                ctx.fillText(bn.created_at, 530, 317);
                ctx.beginPath();
                ctx.moveTo(525, 325);
                ctx.lineTo(680, 325);
                ctx.stroke();
                ctx.fillText('ISSUED BY          :', 15, 370);
                ctx.fillText('CATHERINE DE GUZMAN', 150, 367);
                ctx.beginPath();
                ctx.moveTo(140, 375);
                ctx.lineTo(450, 375);
                ctx.stroke();
                ctx.font = '10px sans-serif';   
                ctx.fillText('(Signature Over Printed Name)', 200, 335);
                ctx.fillText('(Representative)', 200, 385);
            },
            async printNow() {        
                this.printingModal.classList.remove('hidden');        
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: this.pageId,
                            page: this.pageType,
                            action: 'print',
                            searchWord: 'virgil'
                        })
                    });                    
                    this.user = await response.json();
                    const bfc = this.user;
                    this.beneficiaries = bfc.users;
                    this.idPayments =  bfc.idPayments;
                    this.jans =  bfc.jans;
                    this.febs =  bfc.febs;
                    this.mars =  bfc.mars;
                    this.aprs =  bfc.aprs;
                    this.mays =  bfc.mays;
                    this.juns =  bfc.juns;
                    this.juls =  bfc.juls;
                    this.augs =  bfc.augs;
                    this.seps =  bfc.seps;
                    this.octs =  bfc.octs;
                    this.novs =  bfc.novs;
                    this.decs =  bfc.decs;
                    this.totalA =  bfc.totalA;
                    this.totalAB =  bfc.totalAB;
                } catch(e) {
                    console.log(e);
                } finally {
                    this.printingModal.classList.add('hidden');                    
                    let info = [];
                    this.beneficiaries.forEach((bn, index) => {
                        info.push({
                            "#": index + 1,
                            lastname: bn.lastname,
                            firstname: bn.firstname,
                            middlename: bn.middlename,
                            barangay: bn.barangay,
                            "ID Payment": this.idPayments[index],
                            Jan: this.jans[index],
                            Feb: this.febs[index],
                            Mar: this.mars[index],
                            Apr: this.aprs[index],
                            May: this.mays[index],
                            Jun: this.juns[index],
                            Jul: this.juls[index],
                            Aug: this.augs[index],
                            Sept: this.seps[index],
                            Oct: this.octs[index],
                            Nov: this.novs[index],
                            Dec: this.decs[index],
                            "Total(A)": this.totalA[index],
                            "Total(A+B)": this.totalAB[index]
                        });
                    });
                    printJS({
                        printable: info,
                        properties: [
                                '#', 
                                'lastname', 
                                'firstname', 
                                'middlename', 
                                'barangay', 
                                'ID Payment',
                                'Jan', 
                                'Feb', 
                                'Mar', 
                                'Apr', 
                                'May', 
                                'Jun',
                                'Jul', 
                                'Aug', 
                                'Sept', 
                                'Oct', 
                                'Nov', 
                                'Dec',
                                'Total(A)', 
                                'Total(A+B)'
                        ],
                        type: 'json',
                        header: 'List of Beneficiaries',
                        gridHeaderStyle: 'color: green;  border: 2px solid #3971A5;',
                        gridStyle: 'border: 1px solid #3971A5;'
                    });                   
                }               
            },
            async init() { 
                this.checkAuth();
                this.getAllData('region');
                this.initModals();                
                this.created_at = this.initDateInput(''); 
                let user_id = sessionStorage.getItem('user_id');  
                this.pageId = user_id;
                this.pageType = 'all';         
                this.getUsers(user_id, 'all', 'sample');
                this.exportId = user_id;
                this.exportPage = 'all';                                               
            },
            get totalPages() {
                return Math.ceil(this.filteredItems.length / this.pageSize);
            },
            get paginatedItems() {
                const start = (this.currentPage - 1) * this.pageSize;
                const end = start + this.pageSize;
                return this.filteredItems.slice(start, end);
            },
            get filteredItems() {
                let benefactor = this.beneficiaries.filter(item => item.lastname.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.firstname.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.middlename.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.classification.toLowerCase().includes(this.searchQuery.toLowerCase()));
                return benefactor;
            },
            nextPage() {
                if (this.currentPage < this.totalPages) this.currentPage++;
            },
            prevPage() {
                if (this.currentPage > 1) this.currentPage--;
            },
            goToPage(page) {
                this.currentPage = page;
            },
            get visiblePages() {
                let start = Math.max(1, this.currentPage - Math.floor(this.maxVisibleButtons / 2));
                let end = start + this.maxVisibleButtons - 1;

                if (end > this.totalPages) {
                    end = this.totalPages;
                    start = Math.max(1, end - this.maxVisibleButtons + 1);
                }

                const pages = [];
                for (let i = start; i <= end; i++) {
                    pages.push(i);
                }
                return pages;
            }   

		  }
		}        
	</script>
</body>
</html>