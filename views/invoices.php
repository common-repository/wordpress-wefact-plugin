<div class="wrap wefact">
	<?php echo WPWF::get_admin_tabs(); ?>
	<div class="section">
		<div class="grid-12">
			<h2><?php _e('Invoices overview', 'wp_wefact') ?></h2>
			<?php $this->showMsg() ?>
		</div>
	</div>

	<div class="section">
		<div class="grid-12">
			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<th><?php _e('Invoicenr.', 'wp_wefact') ?></th>
						<th><?php _e('Debtor', 'wp_wefact') ?></th>
						<th><?php _e('Price incl. VAT', 'wp_wefact') ?></th>
						<th><?php _e('Invoice date', 'wp_wefact') ?></th>
						<th><?php _e('Status', 'wp_wefact') ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php _e('Invoicenr.', 'wp_wefact') ?></th>
						<th><?php _e('Debtor', 'wp_wefact') ?></th>
						<th><?php _e('Price incl. VAT', 'wp_wefact') ?></th>
						<th><?php _e('Invoice date', 'wp_wefact') ?></th>
						<th><?php _e('Status', 'wp_wefact') ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php $i = 0; ?>
					<?php foreach ( (array) $invoices as $row): ?>
						<tr <?php echo ($i&1 ? 'class="alternate"' : ''); ?>>
							<td>
								<a href="<?php echo admin_url('admin.php?page=wpwf_view_invoice&id='.$row['Identifier']); ?>">
									<?php echo $row['InvoiceCode']; ?>
								</a>
							</td>
							<td>
								<a href="<?php echo admin_url('admin.php?page=wpwf_view_debtor&id='.$row['Debtor']); ?>">
									<?php echo $row['CompanyName']; ?>
								</a>
							</td>
							<td><?php echo WPWF::price($row['AmountIncl']); ?></td>
							<td><?php echo WPWF::dmy($row['Date']); ?></td>
							<td>
								<?php echo WPWF::invoice_statuses($row['Status']) ?>
								<?php if ($row['Status'] == 2): ?>
									(<a href="<?php echo admin_url('admin.php?page=wpwf_view_invoice&id='.$row['Identifier'].'&status=4'); ?>"><?php _e('Paid', 'wp_wefact') ?></a>)
								<?php endif; ?>
							</td>
						</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php
			if ($pages > 1) {
				for($i = 1; $i <= $pages; $i++) {
					$class = ($i == $curpage ? 'active' : '');
					echo '<a href="admin.php?page=wpwf_invoices&pagination=' . $i . '" class="pagination '.$class.'">' . $i . '</a>';
				}
			}
			?>
		</div>
	</div>
<?php include(WPWF_PLUGIN_DIR . '/views/footer.php'); ?>