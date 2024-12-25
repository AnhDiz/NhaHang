<?php if(session('errorsMsg')) : ?>
    <?php foreach (session('errorsMsg') as $error) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $error?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php break; 
    endforeach ?>
<?php endif ?>
<?php if(session('succsessing')) : ?>
    <?php foreach (session('succsessing') as $message) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $message?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php break; endforeach ?>
<?php endif ?>