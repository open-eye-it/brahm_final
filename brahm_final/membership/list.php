<?php include('../layout/header.php');
	$page = 1;
	$page_offset = 0;
	$data = [];
	$total_rows = 0;
	$page_rows = 10;
	$start_no = 1;
	$last_page = 0;

	$page_uri = $_SERVER['QUERY_STRING'];
	$query_new_arr = [];
	parse_str($page_uri, $query_new_arr);
	$page_uri_arr = explode('=', $page_uri);
	if(array_key_exists('page', $query_new_arr)){
		if($query_new_arr['page'] != 1){
			$page = $query_new_arr['page'];
			$page_offset = 10*($page-1);
			$start_no = (($page-1)*$page_rows)+1;
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

	$search = '';
	if(array_key_exists('search', $query_new_arr)){
		$search = $query_new_arr['search'];
	}
	
	$list = $membershipModel->listFamily($page_offset, $search);

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

	$page_base_url = $base_url.'membership/list.php';
	$q_search = '';
	if(array_key_exists('search', $query_new_arr)){
		$q_search = '&search='.$search;
	}
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
											<h3 class="card-label">Family List</h3>
										</div>
										
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6 col-12">
												<div class="form-group">
													<input type="text" name="search" id="search" class="form-control" placeholder="Search" value="<?php echo ($search != '') ? $search : ''; ?>">
												</div>
											</div>
											<div class="col-lg-8 col-md-7 col-sm-6 col-12">
												<button class="btn btn-primary" onclick="searchData()">Search</button>
											</div>
										</div>
										<!--begin: Datatable-->
										<table class="table table-bordered table-checkable">
											<thead>
												<tr>
													<th>Family ID</th>
													<th>Native Place</th>
													<th>Mobile Number</th>
                                                    <th>Address</th>
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
															<td><?php echo $val['native']; ?></td>
															<td><?php echo $val['mobile1']; ?></td>
                                                            <td>
                                                                <?php
                                                                $addr_arr = [];
                                                                if($val['add1'] != ''){
                                                                    $addr_arr[] = $val['add1'];
                                                                }
                                                                if($val['add2'] != ''){
                                                                    $addr_arr[] = $val['add2'];
                                                                }
                                                                if($val['add3'] != ''){
                                                                    $addr_arr[] = $val['add3'];
                                                                }
                                                                if($val['add4'] != ''){
                                                                    $addr_arr[] = $val['add4'];
                                                                }
                                                                if($val['county'] != ''){
                                                                    $addr_arr[] = $val['county'];
                                                                }
                                                                if($val['city'] != ''){
                                                                    $addr_arr[] = $val['city'];
                                                                }
                                                                if($val['zipcode'] != ''){
                                                                    $addr_arr[] = $val['zipcode'];
                                                                }
                                                                $addr = '';
                                                                if(count($addr_arr) > 0){
                                                                    $addr = implode(',', $addr_arr);
                                                                }
                                                                echo $addr;
                                                                 ?>
                                                            </td>
															<td>
																<a href="<?php echo $base_url; ?>membership/edit.php?member=<?php echo $val['familyid']; ?>" title="Edit" class="btn btn-primary btn-sm btn-clean btn-icon mr-2">
																	<i class="fa fa-edit"></i>
																</a>
																<a href="<?php echo $base_url; ?>membership/remove.php?member=<?php echo $val['familyid']; ?>" title="Remove" class="btn btn-danger btn-sm btn-clean btn-icon mr-2">
																	<i class="fa fa-trash"></i>
																</a>
																<a href="<?php echo $base_url; ?>membership/member-list.php?family=<?php echo $val['familyid']; ?>" title="View Member" class="btn btn-info btn-sm btn-clean btn-icon mr-2">
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
												<?php if($page != 1 && $total_rows > 30){ ?>
												<li class="paginate_button page-item previous" id="kt_datatable_previous">
													<a href="<?php echo $page_base_url.'?page=1'.$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link">First</a>
												</li>
												<li class="paginate_button page-item previous" id="kt_datatable_previous">
													<a href="<?php echo $page_base_url.'?page='.($page-1).$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
												</li>
												<?php } ?>
												<?php if($total_rows > 10){ ?>
												<li class="paginate_button page-item <?php echo ($page==$page_no_1) ? 'active' : ''; ?>">
													<a href="<?php echo $page_base_url.'?page='.$page_no_1.$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $page_no_1; ?></a>
												</li>
												<li class="paginate_button page-item <?php echo ($page==$page_no_2) ? 'active' : ''; ?>">
													<a href="<?php echo $page_base_url.'?page='.$page_no_2.$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="2" tabindex="0" class="page-link"><?php echo $page_no_2; ?></a>
												</li>
												<?php } ?>
												<?php if($page_rows*$page < $total_rows && $total_rows > 30){ ?>
													<li class="paginate_button page-item <?php echo ($page==$page_no_3) ? 'active' : ''; ?>">
														<a href="<?php echo $page_base_url.'?page='.$page_no_3.$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="3" tabindex="0" class="page-link"><?php echo $page_no_3; ?></a>
													</li>
													<li class="paginate_button page-item next" id="kt_datatable_next">
														<a href="<?php echo $page_base_url.'?page='.($page+1).$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="6" tabindex="0" class="page-link">Next</a>
													</li>
													<li class="paginate_button page-item next" id="kt_datatable_next">
														<a href="<?php echo $page_base_url.'?page='.$last_page.$q_search; ?>" aria-controls="kt_datatable" data-dt-idx="6" tabindex="0" class="page-link">Last</a>
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
<script>
	function searchData(){
		let search = $('#search').val();
		if(search != ''){
			window.location.href="<?php echo $base_url; ?>membership/list.php?page=<?php echo $page; ?>&search="+search;
		}
	}
</script>