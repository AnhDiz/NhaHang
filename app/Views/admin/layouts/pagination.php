<?php  $pager->setSurroundCount(2)?>
<ul class="pagination pagination-sm m-0 float-right">
    <?php if ($pager->hasPreviousPage()): ?>
        <li class="page-item"><a class="page-link" href="<?= $pager->getPreviousPage() ?>">&laquo; Previous</a></li>
    <?php else: ?>
        <li class="disabled page-item"><a class="page-link" href="#">&laquo; Previous</a></li>
    <?php endif; ?>

    <?php foreach ($pager->links() as $link): ?>
        <li class="<?= $link['active'] ? 'active' : '' ?> page-item">
            <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
        </li>
    <?php endforeach; ?>

    <?php if ($pager->hasNextPage()): ?>
        <li class="page-item"><a class="page-link" href="<?= $pager->getNextPage() ?>">Next &raquo;</a></li>
    <?php else: ?>
        <li class="disabled page-item"><a class="page-link" href="#">Next &raquo;</a></li>
    <?php endif; ?>
</ul>