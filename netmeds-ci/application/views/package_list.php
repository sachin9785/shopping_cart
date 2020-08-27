<!DOCTYPE html>
<html>
<head>
	<title>NetMeds.Com</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
<div class="container"><br/>
	<h2><?php echo $this->session->userdata('logged_in')['first_name'] ." ".$this->session->userdata('logged_in')['last_name']  ; ?> </h2> <a href="<?php echo base_url('package/logout'); ?>"> Logout</a>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<h4></h4>
			<div class="row">
			<?php foreach ($data->result() as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="<?php echo base_url().'assets/images/'.$row->package_image;?>">
						<div class="caption">
							<h4><?php echo $row->package_name;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo number_format($row->package_price);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->package_id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-packageid="<?php echo $row->package_id;?>" data-packagename="<?php echo $row->package_name;?>" data-packageprice="<?php echo $row->package_price;?>">Add To Cart</button>
						</div>
					</div>
				</div>
			<?php endforeach;?>
				
			</div>

		</div>
		<div class="col-md-4">
			<h4>Shopping Cart</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Items</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="detail_cart">

				</tbody>
				
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var package_id    = $(this).data("packageid");
			var package_name  = $(this).data("packagename");
			var package_price = $(this).data("packageprice");
			var quantity   	  = $('#' + package_id).val();
			$.ajax({
				url : "<?php echo site_url('package/add_to_cart');?>",
				method : "POST",
				data : {package_id: package_id, package_name: package_name, package_price: package_price, quantity: quantity},
				success: function(data){
					$('#detail_cart').html(data);
				}
			});
		});

		
		$('#detail_cart').load("<?php echo site_url('package/load_cart');?>");

		
		$(document).on('click','.romove_cart',function(){
			var row_id=$(this).attr("id"); 
			$.ajax({
				url : "<?php echo site_url('package/delete_cart');?>",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>
</body>
</html>