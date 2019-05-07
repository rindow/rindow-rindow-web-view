<?php $paginator->setPageRangeSize(3) ?>
<?php $paginator->setPageScrollingStyle('jumping') ?>
<div class="mdl-grid">
<div style="margin-left:auto">
<?php foreach($paginator->getPagesInRange() as $page) : ?>
	<button class="mdl-button mdl-js-button mdl-button--icon"<?= ($paginator->getPage()==$page) ? ' disabled' : '' ?>>
		<a href="<?= $this->url()->fromRoute($route, null,array('query'=>array_merge($query,array('page' => $page)))) ?>" style="text-decoration:none">
			<?=$page?>
		</a>
	</button>
<?php endforeach ?>
	<button class="mdl-button mdl-js-button mdl-button--icon"<?= $paginator->hasPreviousPage() ? '' : ' disabled' ?>>
	  <a href="<?= $this->url()->fromRoute($route,null,array('query'=>array_merge($query,array('page' => $paginator->getPreviousPage())))) ?>">
	    <i class="material-icons">navigate_before</i>
	  </a>
	</button>
	<button class="mdl-button mdl-js-button mdl-button--icon"<?= $paginator->hasNextPage() ? '' : ' disabled' ?>>
	  <a href="<?= $this->url()->fromRoute($route, null,array('query'=>array_merge($query,array('page' => $paginator->getNextPage())))) ?>">
	    <i class="material-icons">navigate_next</i>
	  </a>
	</button>
</div>
</div>