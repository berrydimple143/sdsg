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
    <?php include('../includes/admin/modals/tables/payments.php'); ?>
    <?php include('../includes/admin/modals/payment.php'); ?>
    <?php include('../includes/admin/modals/change-successful.php'); ?>

    <div class="flex h-screen bg-transparent">
        <input type="checkbox" id="menu-toggle" class="hidden peer">
        <?php include('../includes/admin/sidebar.php'); ?>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <?php include('../includes/admin/header.php'); ?>
            <div class="p-1">
                <h1 class="text-2xl font-bold bg-green-400 p-2">Beneficiaries</h1>							
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
            changeSuccessful: null,
            totalPay: 0.00,
            amount: '',
            errors: [],
            beneficiaries: [],
            payments: [],
            getTotal(arr) {
                let total = 0;
                arr.forEach((element, index, array) => {
                    total += element.amount;
                });
                return total;
            },
            closeTable() {
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
            displayModal(page, msec) {
                if(page == 'change') {
                    this.changeSuccessful = document.getElementById('changeSuccessful');
                    this.changeSuccessful.classList.remove('hidden');
                }
                setTimeout(() => {
                    if(page == 'change') {
                        this.changeSuccessful.classList.add('hidden');
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
                    paymentModal.classList.add('hidden');
                    window.location = "./beneficiary.php";
                }
            },            
            async payNow(id) {
                this.userId = id;
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