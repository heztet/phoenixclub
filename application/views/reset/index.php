<div class="row">
	<div class="col-sm-10">
		<h2><?php echo $title; ?></h2>
	</div>
</div>

<br />

<?php if (!empty($resetFailure) and ($resetFailure == 1)) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-danger fade-message" id="ResetFailure" style="padding: 3px 0px 3px 0px;">Bad password: could not reset</p>
		</div>
	</div>
<?php elseif (!empty($resetSuccess) and ($resetSuccess) == 1) : ?>
	<div class="row">
		<div class="col-sm-3">
			<p class="bg-success fade-message" id="ResetSuccess" style="padding: 3px 0px 3px 0px;">Success! Data has been reset.</p>
		</div>
	</div>
<?php endif; ?>

<div class="row">
	<div class="col-sm-10">
		<a href="<?php echo site_url('').'/reset/floors'; ?>" class="btn btn-danger" role="button">Reset Floor Points</a>
	</div>
</div>

<br />

<div class="row">
	<div class="col-sm-10">
		<a href="<?php echo site_url('').'/reset/semester'; ?>" class="btn btn-danger" role="button">Reset Semester Points</a>
	</div>
</div>

<br />

<div class="row">
	<div class="col-sm-10">
		<a href="<?php echo site_url('').'/reset/year'; ?>" class="btn btn-danger" role="button">Reset Year Points</a>
	</div>
</div>