<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Овернульч. Divided by Zero. United as One.</title>
	
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= $old_base_URL ?>/fav/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $old_base_URL ?>/fav/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $old_base_URL ?>/fav/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $old_base_URL ?>/fav/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= $old_base_URL ?>/fav/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= $old_base_URL ?>/fav/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?= $old_base_URL ?>/fav/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?= $old_base_URL ?>/fav/favicon-16x16.png" sizes="16x16" />
	<meta name="application-name" content="Овернульч"/>
	<meta name="msapplication-TileColor" content="#000000" />
	<meta name="msapplication-TileImage" content="<?= $old_base_URL ?>/fav/mstile-144x144.png" />
	<link rel="stylesheet" href="css/carcass.css">

	<link rel="stylesheet" href="hxv.css">
	<link rel="stylesheet" href="cells-10.css">
	<script src="dom-utils.js"></script>
	<script src="hxv.js"></script>
</head>
<body>
	<input type="checkbox" class="state-checkbox" id="search-state-on" <?= ($search ? 'checked' : '') ?>>
	<input type="checkbox" class="state-checkbox" id="offline-toggle" <?= ($offline ? 'checked' : '') ?>>
	<div class="cells" id="menu-cells">
		<div class="cell menu-cell" id="c-logo">
			<div class="cell-bg"></div>
			<?= makeIcon('logo') ?>
		</div>
		<?= ($search
			? '<a href="." class="cell menu-cell" id="c-search"'
			: '<label class="cell menu-cell" id="c-search" for="search-state-on"' ) ?> title="Поиск">
			<div class="cell-bg"></div>
			<?= makeIcon('search') ?>
			<form action="." id="search-form">
				<input type="text" name="q" <?= ($search ? "value=\"$q\"" : '') ?>>
			</form>
		<?= ($search ? '</a>'	: '</label>' ) ?>
		<a target="_blank" href="<?= $old_base_URL ?>/catalog" class="cell menu-cell" id="c-catalog" title="Каталог">
			<div class="cell-bg"></div>
			<?= makeIcon('catalog') ?>
		</a>
		<a href="./?shuffle=1" class="cell menu-cell" id="c-shuffle" title="Перемешать">
			<div class="cell-bg"></div>
			<?= makeIcon('shuffle') ?>
		</a>
		<label class="cell menu-cell" id="c-offline" for="offline-toggle" title="Показать/скрыть мертвые борды">
			<div class="cell-bg"></div>
			<?= makeIcon('skull') ?>
		</label>
		<a target="_blank" href="<?= $old_base_URL ?>/editor" class="cell menu-cell" id="c-editor" title="Редактор">
			<div class="cell-bg"></div>
			<?= makeIcon('pencil') ?>
		</a>
		<a target="_blank" href="<?= $old_base_URL ?>/" class="cell menu-cell" id="c-home" title="Старая домашняя страница">
			<div class="cell-bg"></div>
			<?= makeIcon('home') ?>
		</a>
	</div>
	<div class="cells" id="chans-online"><?= $seven_divs . $chans_online ?></div>
	<div class="cells" id="chans-offline"><?= $seven_divs . $chans_offline ?></div>
	<div id="invisible-cells" style="display:none"></div>
	<div id="shade"></div>
	<script>main()</script>
</body>