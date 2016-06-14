<?php
	$args = array(
	    'offset'     => 1,
	);

	$blogs = wp_get_sites( $args );
?>


<div class="simplenewsletter" data-showon='<?php echo get_option('simplenewsletter_showon'); ?>'>
	<?php $formID = uniqid('form_simplenewsletter-'); ?>
	<form method='POST' id='submit_simplenewsletter' class='<?php echo $formID ?> form-inline'>
	    <div class="form-group">
			<select name="simplenewsletter[tipo]" class="form-control sltTransparente" id="area" required>
				<option value="">Escolha sua área</option>
		            <?php
		            	foreach($blogs as $blog){
	            		$blog_details = get_blog_details( array( 'blog_id' => $blog["blog_id"] ) );

	            		$nome = $blog_details->blogname;

	            		$nomeOk = replace_accents($nome);
	          		?>
	            	<option value="<?php echo $nomeOk; ?>"><?php echo $nomeOk; ?></option>
		        	<?php
		        		}
		        		restore_current_blog();
	        		?>
        		</select>

			<input name="simplenewsletter[name]" type="text" class="form-control" placeholder="Nome">
			<input name='simplenewsletter[email]' class="form-control" type='email' placeholder='seu@email.com' required />

			<input type="submit" value="Cadastrar" class='btn btn-default' />
	    </div>
	</form>

	<div class="simplenewsletter_spinner" style="display:none;">
		<img src="<?php echo plugins_url('../images/loading.svg', __FILE__) ?>" style="margin-left:45%;">
	</div>

	<script>
		initSimpleNewsletter('.<?php echo $formID; ?>');
	</script>

</div>
