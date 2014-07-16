<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array('bootstrap.css', 'datepicker.css')); ?>
	<?php echo Asset::js(array('jquery-1.8.3.js', 'bootstrap-datepicker.js', 'bootstrap-datepicker.ja.js')); ?>
	<style>
		body { margin: 20px; }
	</style>
	<script type="text/javascript">
		$(function(){
			$('.dp').datepicker({
				format: 'yyyy/mm/dd',
				language: 'ja',
				autoclose: 'true'
			})
		})
	</script>

</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h2><?php echo $title; ?></h2>
			<?php if (! isset($is_menu)) : ?>
				<?php echo Html::anchor('menu', '<span class="glyphicon glyphicon-th"></span> メニュー', array('class' => 'btn btn-primary')); ?>
			<?php endif; ?>
			<hr>
<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>処理完了</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>エラー</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>
		</div>
		<div class="col-md-12">
<?php echo $content; ?>
		</div>
		<footer>
		</footer>
	</div>
</body>
</html>
