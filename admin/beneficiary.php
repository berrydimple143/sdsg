<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
    <?php include('../includes/admin/modals/tables/payments.php'); ?>
    <?php include('../includes/admin/modals/payment.php'); ?>    
    <?php include('../includes/admin/modals/edit-payment.php'); ?>
    <?php include('../includes/admin/modals/delete-payment.php'); ?>
    <?php include('../includes/admin/modals/change-successful.php'); ?>
    <?php include('../includes/admin/modals/add-successful.php'); ?>
    <?php include('../includes/admin/modals/delete-successful.php'); ?>
    <?php include('../includes/admin/modals/edit-successful.php'); ?>

    <div class="flex h-screen bg-transparent">
        <input type="checkbox" id="menu-toggle" class="hidden peer">
        <?php include('../includes/admin/sidebar.php'); ?>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <?php include('../includes/admin/header.php'); ?>
            <div class="p-1">
                <div class="flex bg-green-400 items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <h1 class="text-2xl text-purple-600 font-bold p-2 text-shadow-lg">List of Beneficiaries</h1>
                        <input 
                            type="text" 
                            x-model="searchWord" 
                            @keyup.enter="searchData"  
                            placeholder="Search beneficiary here and press enter" 
                            class="text-md bg-white h-6 w-80 p-4 rounded-sm border-green-900 shadow-md outline-none">
                    </div>
                    <button type="button" class="inline-flex items-center text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                    <?php include('../includes/admin/icons/add.php'); ?>
                        Add Beneficiary
                    </button>
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
            showRow: false,
            userId: null,
            created_at: '',
            paymentModal: null,
            paymentsTableModal: null,
            editPaymentModal: null,
            changeSuccessful: null,
            deleteSuccessful: null,
            deletePaymentModal: null,
            editSuccessfulModal: null,
            totalPay: 0.00,
            amount: '',
            searchWord: '',
            owner: '',            
            errors: [],
            beneficiaries: [],
            payments: [],
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
                        created_at: '2026-02-21',
                        mode: "single"
                    })
                });
                let payment = await response.json();
                this.owner =  `${payment.data.firstname} ${payment.data.lastname}`;
            },
            async searchData() {
                if(this.searchWord == '') {
                    this.init();
                } else {
                    try {
                        let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({ 
                                user_id: 1,
                                page: 'some',
                                searchWord: this.searchWord
                            })
                        });
                        let data = await response.json();
                        this.beneficiaries = data.users;                            
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    } 
                }
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
            displayModal(page, msec) {
                if(page == 'change') {
                    this.changeSuccessful = document.getElementById('changeSuccessful');
                    this.changeSuccessful.classList.remove('hidden');
                } else if(page == 'delete') {
                    this.deletePaymentModal.classList.add('hidden');
                    this.paymentsTableModal.classList.add('hidden');
                    this.deleteSuccessful = document.getElementById('deleteSuccessful');
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
                    } else if(page == 'delete') {
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
                            user_id: this.userId,
                            amount: 10,
                            created_at: '2026-02-21',
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
                            created_at: this.created_at,
                            mode: "add"
                        })
                    });
                    this.user = await response.json();
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
                this.paymentModal = document.getElementById('paymentModal');	
                this.paymentModal.classList.remove('hidden');
            },
            cancelPayment() {                
                paymentModal.classList.add('hidden');
            },
            showForm(id) {
                alert("This will lead you to a registration form in pdf format for beneficiary with id number: " + id);
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
            async init() { 
                this.created_at = this.initDateInput(''); 
                let user_id = sessionStorage.getItem('user_id');                
                let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ 
                        user_id: user_id,
                        page: 'all',
                        searchWord: 'sample'
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