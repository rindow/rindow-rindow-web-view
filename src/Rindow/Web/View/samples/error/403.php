<?php $this->placeholder()->set('title','Forbidden') ?>
<div class="container grid-container mdl-layout__content">
<div class="row grid-x mdl-grid">
<div class="col-sm-12 columns cell small-12 mdl-cell mdl-cell--12-col">
<h1>Forbidden</h1>
<?php if(isset($policy['display_detail']) && $policy['display_detail']) : ?>
<p>Exception: <?= $exception ?></p>
<p>Code: <?= $code ?></p>
<p>Message: <?= $message ?></p>
<hr>
<?php foreach($dataTables as $dataTable): ?>
<h3><?= $dataTable['label'] ?></h3>
<dl>
<?php foreach($dataTable['data'] as $name => $value): ?>
<dt><?= $name ?></dt>
<dd><?= var_export($value,true) ?></dd>
<?php endforeach ?>
</dl>
<?php endforeach ?>
<hr>
<p>Source: <?= $file ?>(<?= $line ?>)</p>
<p>Trace:</p>
<pre>
<?= $trace ?>
</pre>
<?php endif ?>
</div>
</div><!--class="row"-->
</div><!--class="container"-->
