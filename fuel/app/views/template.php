<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array('bootstrap.css', 'datepicker.css')); ?>
	<?php echo Asset::js(array('jquery-1.8.3.js', 'bootstrap-datepicker.js', 'bootstrap-datepicker.ja.js')); ?>
	<?php echo html_tag('link', array( 'rel' => 'shortcut icon', 'type' => 'image/x-icon', 'href' => Asset::get_file('favicon.ico', 'img'), ) ); ?>
	<?php echo html_tag('link', array( 'rel' => 'icon', 'type' => 'image/x-icon', 'href' => Asset::get_file('favicon.ico', 'img'), ) ); ?>
        <!-- 画面固有の追加分 -->
        <?php echo Asset::render('css_for_chart');?>
	<?php echo Asset::render('js_for_chart'); ?>
        
	<style>
		body { margin: 20px; }
	</style>
	<script type="text/javascript">
		$(function(){
			$('.dp').datepicker({
				format: 'yyyy/mm/dd',
				language: 'ja',
				autoclose: 'true'
			});
		})
	</script>

</head>
<body>
	<div class="container">
	<nav class="navbar navbar-default">
		<div class="col-md-12"  style="display:table;">
                    <span class="h3 navbar-text" style="text-align: left; vertical-align: middle;"><?php echo $title; ?></span>
			<?php if (! isset($is_menu)) : ?>
				<?php echo Html::anchor('menu', '<span class="glyphicon glyphicon-th"></span> メニュー', array('class' => 'btn btn-primary navbar-btn', 'style' => 'vertical-align: middle;')); ?>
			<?php endif; ?>
			<?php if (! isset($is_login)) : ?>
				<?php echo Html::anchor('menu/logout', '<span class="glyphicon glyphicon-log-out"></span> ログアウト', array('class' => 'btn btn-primary navbar-btn', 'style' => 'vertical-align: middle;', 'onclick' => "return confirm('ログアウトしてもよろしいですか？')")); ?>
			<?php endif; ?>
		</div>
	</nav>
	<hr>
	<div class="col-md-12">
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
