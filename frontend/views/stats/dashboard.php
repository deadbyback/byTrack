<?php

use yii\bootstrap\Nav;
use kartik\widgets\SideNav;
use yii\widgets\Pjax;
?>

<div class="col-md-2">
<?php echo SideNav::widget([
	'type' => SideNav::TYPE_DEFAULT,
	'heading' => 'Attributes',
	'items' => [
		[
			'url' => 'project',
			'label' => 'Project reports',
			'icon' => 'home'
        ],
        [
			'url' => 'status',
			'label' => 'Status reports',
			'icon' => 'share'
        ],
        [
			'url' => 'severity',
			'label' => 'Severity reports',
			'icon' => 'share'
        ],
        [
			'url' => 'priority',
			'label' => 'Priority reports',
			'icon' => 'share'
        ],
        [
			'url' => 'user-report',
			'label' => 'User\'s reports',
			'icon' => 'file'
        ],
        [
			'url' => 'user-stats',
			'label' => 'User\'s stats',
			'icon' => 'user'
		],
	],
]);
?>
</div>
<?php Pjax::begin()
?>

<?php Pjax::end(); ?>
dfqwddfewfefwf
<style>
    .menu {
    }
</style>
