<?php $paginator->setPageRangeSize(3) ?>
<?php $paginator->setPageScrollingStyle('jumping') ?>
<nav>
<ul class="pagination">
	<li class="page-item<?= $paginator->hasPreviousPage() ? '' : ' disabled' ?>">
		<a class="page-link" href="<?= $this->url()->fromRoute($route,null,array('query'=>array_merge($query,array('page' => $paginator->getPreviousPage())))) ?>">
			&laquo; Previous
		</a>
	</li>
	<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>
<?php foreach($paginator->getPagesInRange() as $page) : ?>
	<li class="page-item<?= ($paginator->getPage()==$page) ? ' active' : '' ?>">
		<a class="page-link" href="<?= $this->url()->fromRoute($route, null,array('query'=>array_merge($query,array('page' => $page)))) ?>">
			<?=$page?>
		</a>
	</li>
<?php endforeach ?>
	<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>
	<li class="page-item<?= $paginator->hasNextPage() ? '' : ' disabled' ?>">
		<a class="page-link" href="<?= $this->url()->fromRoute($route, null,array('query'=>array_merge($query,array('page' => $paginator->getNextPage())))) ?>">
			Next &raquo;
		</a>
	</li>
</ul>
</nav>