<?php declare(strict_types=1);

use phpOMS\Uri\UriFactory;

$costcenter = $this->data['costcenter'];

$isNew = $costcenter->id === 0;

/** @var \phpOMS\Views\View $this */
echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}accounting/costcenter?csrf={$CSRF}'); ?>">
                <div class="portlet-head"><?= $this->getHtml('CostCenter'); ?></div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                        <input type="text" name="id" id="iId" value="<?= $costcenter->id; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="iCode"><?= $this->getHtml('Code'); ?></label>
                        <input type="text" name="code" id="iCode" value="<?= $this->printHtml($costcenter->code); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="iParent"><?= $this->getHtml('Parent'); ?></label>
                        <input type="text" name="parent" id="iParent" value="<?= $this->printHtml($costcenter->parent?->code); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iName"><?= $this->getHtml('Name'); ?></label>
                        <input type="text" name="Name" id="iName" value="<?= $this->printHtml($costcenter->getL11n()); ?>"<?php $isNew ? '' : ' disabled'; ?>>
                    </div>
                </div>
                <div class="portlet-foot">
                    <?php if ($isNew) : ?>
                        <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    <?php else : ?>
                        <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                    <?php endif; ?>
                </div>
            </form>
        </section>
    </div>
</div>

<?php if (!$isNew) : ?>
<div class="row">
    <?= $this->data['l11nView']->render(
        $this->data['l11nValues'],
        [],
        '{/api}accounting/costcenter/l11n?csrf={$CSRF}'
    );
    ?>
</div>
<?php endif; ?>