<?php include('../layout/header.php');
$createMsg = '';
if (isset($_POST['member_create'])) {
    $InsertArr = [
        'native' => $_POST['native'],
        'add1' => $_POST['add1'],
        'add2' => $_POST['add2'],
        'add3' => $_POST['add3'],
        'add4' => $_POST['add4'],
        'county' => $_POST['county'],
        'city' => $_POST['city'],
        'zipcode' => $_POST['zipcode'],
        'phone1' => $_POST['phone1'],
        'phone2' => $_POST['phone2'],
        'mobile1' => $_POST['mobile1'],
        'mobile2' => $_POST['mobile2'],
        'remarks' => $_POST['remarks'],
    ];
    $createRes = $membershipModel->createFamily($InsertArr);
    if ($createRes == 'success') {
        $createMsg = $createRes;
    } else {
        $createMsg = $createRes;
    }
}
?>
<script>
    let createMsg = "<?php echo $createMsg; ?>";
    if (createMsg === 'success') {
        window.location.href = "<?php echo $base_url; ?>" + "membership/list.php";
    }
</script>
<!--begin::Container-->
<div class="d-flex flex-row flex-column-fluid container">
    <!--begin::Content Wrapper-->
    <div class="main d-flex flex-column flex-row-fluid">
        <div class="content flex-column-fluid" id="kt_content">
            <!--begin::Dashboard-->
            <div class="card card-custom gutter-b exa                                                                                                                                   mple example-compact">
                <div class="card-header">
                    <h3 class="card-title">Create Family</h3>
                </div>
                <!--begin::Form-->
                <form method="post" action="" id="newUserUpdate">
                    <div class="card-body">
                        <?php if ($createMsg == 'fail') { ?>
                            <div class="form-group mb-8">
                                <div class="alert alert-custom alert-danger" role="alert">
                                    <div class="alert-text">Something wrong in family form, please try again.</div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Person Name [Head]
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Family's Native Place" name="native" id="native" />
                                    <span class="form-text text-danger" id="nativeErr"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">House Number
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="House Number" name="add1" id="add1" />
                                    <span class="form-text text-danger" id="add1Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Bungalow / Appt. Name
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Bungalow / Appt. Name" name="add2" id="add2" />
                                    <span class="form-text text-danger" id="add2Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Street Name
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Street Name" name="add3" id="add3" />
                                    <span class="form-text text-danger" id="add3Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Area
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Area" name="add4" id="add4" />
                                    <span class="form-text text-danger" id="add4Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Country
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Country" name="county" id="county" />
                                    <span class="form-text text-danger" id="countyErr"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">City
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="City" name="city" id="city" />
                                    <span class="form-text text-danger" id="cityErr"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Zipcode
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Zipcode" name="zipcode" id="zipcode" />
                                    <span class="form-text text-danger" id="zipcodeErr"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Phone1</label>
                                    <input type="number" class="form-control" placeholder="Phone1" name="phone1" id="phone1" />
                                    <span class="form-text text-danger" id="phone1Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Phone2</label>
                                    <input type="number" class="form-control" placeholder="Phone2" name="phone2" id="phone2" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Mobile1
                                        <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Mobile1" name="mobile1" id="mobile1" />
                                    <span class="form-text text-danger" id="mobile1Err"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Mobile2</label>
                                    <input type="number" class="form-control" placeholder="Mobile2" name="mobile2" id="mobile2" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="usrName">Remarks</label>
                                    <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="10" placeholder="Remarks"></textarea>
                                    <span class="form-text text-danger" id="usrNameErr"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="member_create" id="member_create" value="member_create">
                        <button type="submit" class="btn btn-primary mr-2" id="createUser">Create</button>
                        <a href="<?php echo $base_url; ?>membership/list.php" class="btn btn-secondary">Cancel</a>
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
    $('#newUserUpdate').on('submit', function(e) {
        let form = $(this).parents('form');
        let native = $('#native').val();
        let add1 = $('#add1').val();
        let add2 = $('#add2').val();
        let add3 = $('#add3').val();
        let add4 = $('#add4').val();
        let county = $('#county').val();
        let zipcode = $('#zipcode').val();
        let mobile1 = $('#mobile1').val();

        if (native == '') {
            e.preventDefault();
            $('#nativeErr').html('Please enter Native Place');
            timeOut('nativeErr', 3000);
            scrollTop('native');
        } else if (add1 == '') {
            e.preventDefault();
            $('#add1Err').html('Please enter House Number');
            timeOut('add1Err', 3000);
            scrollTop('add1');
        } else if (add2 == '') {
            e.preventDefault();
            $('#add2Err').html('Please enter Bungalow / Appt. Name');
            timeOut('add2Err', 3000);
            scrollTop('add2');
        } else if (add3 == '') {
            e.preventDefault();
            $('#add3Err').html('Please enter Street Name');
            timeOut('add3Err', 3000);
            scrollTop('add3');
        } else if (add4 == '') {
            e.preventDefault();
            $('#add4Err').html('Please enter Area');
            timeOut('add4Err', 3000);
            scrollTop('add4');
        } else if (county == '') {
            e.preventDefault();
            $('#countyErr').html('Please enter Country');
            timeOut('countryErr', 3000);
            scrollTop('country');
        } else if (city == '') {
            e.preventDefault();
            $('#cityErr').html('Please enter City');
            timeOut('cityErr', 3000);
            scrollTop('city');
        } else if (zipcode == '') {
            e.preventDefault();
            $('#zipcodeErr').html('Please enter Zipcode');
            timeOut('zipcodeErr', 3000);
            scrollTop('zipcode');
        } else if (mobile1 == '') {
            e.preventDefault();
            $('#mobile1Err').html('Please enter Mobile Number');
            timeOut('mobile1Err', 3000);
            scrollTop('mobile1');
        } else {
            form.submit();
        }
    });
</script>