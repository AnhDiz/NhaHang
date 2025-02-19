<?php if (session('errorsMsg')) : ?>
    <?php 
        $errors = session('errorsMsg');
        if (is_array($errors)) :
            foreach ($errors as $error) : 
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= esc($error) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php break; endforeach; 
        else : // Nếu là chuỗi, hiển thị trực tiếp 
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= esc($errors) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (session('succsessing')) : ?>
    <?php 
        $messages = session('succsessing');
        if (is_array($messages)) :
            foreach ($messages as $message) : 
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc($message) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php break; endforeach; 
        else : // Nếu là chuỗi, hiển thị trực tiếp
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc($messages) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
<?php endif; ?>