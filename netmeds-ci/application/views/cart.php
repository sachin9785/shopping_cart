<?php foreach ($this->cart->contents() as $items) { ?>
	<tr>
		<td><?php echo $items['name']; ?></td>
		<td>$<?php echo number_format($items['price']);?></td>
		<td><?php echo $items['qty']; ?></td>
		<td>$<?php echo number_format($items['subtotal']); ?></td>
		<td><button type="button" id="<?php echo $items['rowid']; ?>" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
	</tr>
<?php } ?>
	<tr>
		<th colspan="3">Total</th>
		<th colspan="2">$<?php echo  number_format($this->cart->total()); ?></th>
	</tr>