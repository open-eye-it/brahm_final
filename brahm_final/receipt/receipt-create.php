<?php include('../layout/header.php');
$createMsg = '';

$YearListArr = $membershipModel->YearList();
$yearLists = $YearListArr['data'];

$familyHeadArr = $receiptModel->familyHeadList();
$familyHeadList = $familyHeadArr['data'];
//echo "<pre>";print_r($familyHeadArr);exit;

$YearListArr = $membershipModel->YearList();

if(isset($_POST['MM_insert'])){
    $InsertArr = [
        'RecNo' => $_POST['RecNo'],
        'RecDate' => $_POST['RecDate'],
        'RecAmt' => $_POST['RecAmt'],
        'Cash_Cheque' => $_POST['Cash_Cheque'],
        'Cheque_Number' => $_POST['Cheque_Number'],
        'Bank' => $_POST['Bank'],
        'Cheque_Date' => $_POST['Cheque_Date'],
        'RecDescription' => $_POST['RecDescription'],
        'Remarks' => $_POST['Remakrs'],
        'Type' => 'MEMBERSHIP'
    ];
    $checkReceiptNo = $receiptModel->checkReceiptNo($_POST['RecNo']);
    if($checkReceiptNo['status'] == 'fail'){
        $createRes = $receiptModel->createReceipt($InsertArr);
        if($createRes == 'success'){
            $yearArr = $_POST['YearList'];
            $memberArr = $_POST['memberList'];
            if(count($yearArr)>0 && count($memberArr) > 0){
                for($i=0; $i<count($yearArr); $i++){
                    for($j=0; $j<count($memberArr); $j++){
                        $receiptModel->receiptMemberAdd($_POST['RecNo'], $memberArr[$j], $yearArr[$i]);
                    }
                }
            }

            $createMsg = $createRes;
        }else{
            $createMsg = 'fail';
        }
    }else{
        $createMsg = 'fail1';
    }
}
?>
<script>
	let createMsg = "<?php echo $createMsg; ?>";
	if(createMsg === 'success'){
		window.location.href = "<?php echo $base_url; ?>"+"receipt/receipt-list.php";
	}
</script>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Create Receipt</h3>
											</div>
											<!--begin::Form-->
											<form method="post" action="" id="newMemberUpdate">
												<div class="card-body">
                                                    <div><span class="text-danger">NOTE:</span> To Enter receipt for new members, please <a href="<?php echo $base_url; ?>membership/create.php">click here</a> to insert family and members.</div><hr>
                                                    <?php if($createMsg == 'fail'){ ?>
                                                        <div class="form-group mb-8">
                                                            <div class="alert alert-custom alert-danger" role="alert">  
                                                                <div class="alert-text">Something wrong in membership form, please try again.</div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if($createMsg == 'fail1'){ ?>
                                                        <div class="form-group mb-8">
                                                            <div class="alert alert-custom alert-danger" role="alert">  
                                                                <div class="alert-text">Receipt No already exist please change it.</div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="memberId">Select Family Head
                                                                <span class="text-danger">*</span></label>
                                                                <select name="memberId" id="memberId" class="form-control" onchange="selectFamily(this.value)">
                                                                    <option value="">-Select-</option>
                                                                    <?php 
                                                                        if(count($familyHeadList) > 0){
                                                                            foreach($familyHeadList as $list){ ?>
                                                                            <option value="<?php echo $list['familyid1']; ?>"><?php echo $list['Name']; ?></option>
                                                                            <?php }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <span class="form-text text-danger" id="memberIdErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="RecNo">Receipt No
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Receipt No" name="RecNo" id="RecNo" />
                                                                <span class="form-text text-danger" id="RecNoErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="RecDate">Date
                                                                <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" placeholder="Date" name="RecDate" id="RecDate" />
                                                                <span class="form-text text-danger" id="RecDateErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="RecAmt">Amount
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Amount" name="RecAmt" id="RecAmt" />
                                                                <span class="form-text text-danger" id="RecAmtErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="Cash_Cheque">Cash / Cheque
                                                                <span class="text-danger">*</span></label>
                                                                <select name="Cash_Cheque" id="Cash_Cheque" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="CASH" selected>CASH</option>
                                                                    <option value="CHEQUE">CHEQUE</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="Cash_ChequeErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="Cheque_Number">Cheque Number</label>
                                                                <input type="text" class="form-control" placeholder="Cheque Number" name="Cheque_Number" id="Cheque_Number" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="Bank">Bank</label>
                                                                <input type="text" class="form-control" placeholder="Bank" name="Bank" id="Bank" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="Cheque_Date">Cheque Date</label>
                                                                <input type="text" class="form-control" placeholder="Cheque Date" name="Cheque_Date" id="Cheque_Date" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="RecDescription">Description</label>
                                                                <textarea name="RecDescription" id="RecDescription" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="Remakrs">Remarks</label>
                                                                <textarea name="Remakrs" id="Remakrs" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>For the Years
                                                                <span class="text-danger">*</span></label>
                                                                <select name="YearList[]" id="YearList" class="form-control" multiple>
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach($yearLists as $list){ ?>
                                                                        <option value="<?php echo $list['yearID']; ?>"><?php echo $list['yearName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="form-text text-danger" id="YearListErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Applies to Members <span class="text-danger">Please select the members to apply the current receipt</span>
                                                                <span class="text-danger">*</span></label>
                                                                <select name="memberList[]" id="memberList" class="form-control" multiple>
                                                                    
                                                                </select>
                                                                <span class="form-text text-danger" id="memberListErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="card-footer">
                                                    <input type="hidden" name="MM_insert" id="MM_insert" value="form1">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Create</button>
													<a href="<?php echo $base_url; ?>receipt/receipt-list.php" class="btn btn-secondary">Cancel</a>
												</div>
											</form>
											<!--end::Form-->
										</div>
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
<?php include('../layout/footer.php'); ?>
<script type="text/javascript">
    $('#newMemberUpdate').on('submit', function(e){
		let form = $(this).parents('form');
        let memberId = $('#memberId').val();
		let RecNo = $('#RecNo').val();
		let RecDate = $('#RecDate').val();
		let RecAmt = $('#RecAmt').val();
        let Cash_Cheque = $('#Cash_Cheque').val();
        let YearList = $('#YearList').val();
        let memberList = $('#memberList').val();
		if(memberId == ''){e.preventDefault();
			$('#memberIdErr').html('Please select family head');
			timeOut('memberIdErr', 3000);
            scrollTop('memberIdErr');
		}else if(RecNo == ''){e.preventDefault();
			$('#RecNoErr').html('Please enter receipt no');
			timeOut('RecNoErr', 3000);
            scrollTop('RecNoErr');
		}else if(RecDate == ''){e.preventDefault();
			$('#RecDateErr').html('Please select receipt date');
			timeOut('RecDateErr', 3000);
            scrollTop('RecDateErr');
		}else if(RecAmt == ''){e.preventDefault();
			$('#RecAmtErr').html('Please enter amount');
			timeOut('RecAmtErr', 3000);
            scrollTop('RecAmtErr');
		}else if(Cash_Cheque == ''){e.preventDefault();
			$('#Cash_ChequeErr').html('Please select cash or cheque');
			timeOut('Cash_ChequeErr', 3000);
            scrollTop('Cash_ChequeErr');
		}else if(YearList == ''){e.preventDefault();
			$('#YearListErr').html('Please select years');
			timeOut('YearListErr', 3000);
            scrollTop('YearListErr');
		}else if(memberList == ''){e.preventDefault();
			$('#memberListErr').html('Please select members');
			timeOut('memberListErr', 3000);
            scrollTop('memberListErr');
		}else{
			form.submit();
		}
    });

    function selectFamily(familyid){
        $.ajax({
            type: "GET",
            url: "<?php echo $base_url; ?>receipt/family-member.php?family="+familyid,
            success: function(result){
                $('#memberList').html(result);
            }
        });
    }
</script>