<?php include('../layout/header.php');
	$page = 1;
	$page_offset = 0;
	$data = [];
	$total_rows = 0;
	$page_rows = 10;
	$start_no = 1;
	$last_page = 0;

	$page_uri = $_SERVER['QUERY_STRING'];
	$query_uri_arr = explode('&', $page_uri);
    $family_arr = explode('=', $query_uri_arr[0]);
	$page_uri_arr = [];
	if(count($query_uri_arr) >= 2){
        $page_uri_arr = explode('=', $query_uri_arr[1]);
        if(count($page_uri_arr) > 1){
            if($page_uri_arr[1] != 1){
                $page = $page_uri_arr[1];
                $page_offset = 10*($page-1);
                $start_no = (($page-1)*$page_rows)+1;
            }
        }
	}

	$page_no_1 = 1;
	$page_no_2 = 2;
	$page_no_3 = 3;

	if($page>1){
		$page_no_1 = $page-1;
		$page_no_2 = $page;
		$page_no_3 = $page+1;
	}
    
	$list = $membershipModel->listMember($family_arr[1], $page_offset);
    //echo "<pre>"; print_r($list);exit;
	if($list['status'] == 'success'){
		$data = $list['data'];
		$total_rows = $list['total_rows'];
	}

	$pageConversion = $total_rows/10;
	if(floor($pageConversion) == $pageConversion){
		$last_page = floor($pageConversion);
	}else{
		$last_page = floor($pageConversion)+1;
	}

	$page_base_url = $base_url.'membership/member-list.php';
?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">Member List</h3>
										</div>
										<div class="card-toolbar">
                                            <a href="<?php echo $base_url.'membership/list.php'; ?>" class="btn btn-primary"><i class="fa fa-arrow-left text-white"></i> Back</a> &nbsp;
                                            <a href="<?php echo $base_url.'membership/member-create.php?family='.$family_arr[1]; ?>" class="btn btn-primary"><i class="fa fa-plus text-white"></i> Create Member</a>
                                        </div>
									</div>
									<div class="card-body">
										<!--begin: Datatable-->
										<table class="table table-bordered table-checkable">
											<thead>
												<tr>
													<th>Member ID</th>
													<th>Name</th>
													<th>Relation</th>
                                                    <th>DOB</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if(count($data) > 0){
													$i=$start_no;
													foreach($data as $key => $val){ ?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $val['preFix'].' '.$val['SurName'].' '.$val['FirstName'].' '.$val['MiddleName']; ?></td>
															<td><?php echo $val['Relation']; ?></td>
                                                            <td><?php echo $val['DOB']; ?></td>
															<td><?php echo $val['Status_']; ?></td>
															<td>
																<a href="<?php echo $base_url; ?>membership/member-edit.php?family=<?php echo $family_arr[1]; ?>&member=<?php echo $val['memberid']; ?>" title="Edit" class="btn btn-primary btn-sm btn-clean btn-icon mr-2">
																	<i class="fa fa-edit"></i>
																</a>
																<a href="<?php echo $base_url; ?>membership/member-remove.php?family=<?php echo $family_arr[1]; ?>&member=<?php echo $val['memberid']; ?>" title="Remove" class="btn btn-danger btn-sm btn-clean btn-icon mr-2">
																	<i class="fa fa-trash"></i>
																</a>
																<a href="<?php echo $base_url; ?>membership/member-full-view.php?family=<?php echo $family_arr[1]; ?>&member=<?php echo $val['memberid']; ?>" title="Full View" class="btn btn-info btn-sm btn-clean btn-icon mr-2">
																	<i class="fa fa-eye"></i>
																</a>
															</td>
														</tr>
													<?php $i++; }
												}else{ ?>
													<tr>
														<td colspan="4">
															<h3>Data not available</h3>
														</td>
													</tr>
												<?php }
												?>
											</tbody>
										</table>
										<div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
											<ul class="pagination">
												<?php if($page != 1){ ?>
												<li class="paginate_button page-item previous" id="kt_datatable_previous">
													<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page=1'; ?>" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link">First</a>
												</li>
												<li class="paginate_button page-item previous" id="kt_datatable_previous">
													<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$page-1; ?>" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
												</li>
												<?php } ?>
												<?php if($total_rows > 10){ ?>
												<li class="paginate_button page-item <?php echo ($page==$page_no_1) ? 'active' : ''; ?>">
													<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$page_no_1; ?>" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $page_no_1; ?></a>
												</li>
												<li class="paginate_button page-item <?php echo ($page==$page_no_2) ? 'active' : ''; ?>">
													<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$page_no_2; ?>" aria-controls="kt_datatable" data-dt-idx="2" tabindex="0" class="page-link"><?php echo $page_no_2; ?></a>
												</li>
												<?php } ?>
												<?php if($page_rows*$page < $total_rows){ ?>
													<li class="paginate_button page-item <?php echo ($page==$page_no_3) ? 'active' : ''; ?>">
														<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$page_no_3; ?>" aria-controls="kt_datatable" data-dt-idx="3" tabindex="0" class="page-link"><?php echo $page_no_3; ?></a>
													</li>
													<li class="paginate_button page-item next" id="kt_datatable_next">
														<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$page+1; ?>" aria-controls="kt_datatable" data-dt-idx="6" tabindex="0" class="page-link">Next</a>
													</li>
													<li class="paginate_button page-item next" id="kt_datatable_next">
														<a href="<?php echo $page_base_url.'?family='.$family_arr[1].'&page='.$last_page; ?>" aria-controls="kt_datatable" data-dt-idx="6" tabindex="0" class="page-link">Last</a>
													</li>
												<?php } ?>
											</ul>
										</div>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
<?php include('../layout/footer.php'); ?>