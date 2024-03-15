<?php declare(strict_types=1);

use phpOMS\Uri\UriFactory;

$account = $this->data['account'];

$isNew = $account->id === 0;

/** @var \phpOMS\Views\View $this */
echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}accounting/coa'); ?>">
                <div class="portlet-head"><?= $this->getHtml('Account'); ?></div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                        <input type="text" name="id" id="iId" value="<?= $this->printHtml($account->id); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="iCode"><?= $this->getHtml('Code'); ?></label>
                        <input type="text" name="code" id="iCode" value="<?= $this->printHtml($account->code); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iParent"><?= $this->getHtml('Parent'); ?></label>
                        <input type="text" name="parent" id="iParent" value="<?= $this->printHtml($account->parent?->code); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iName"><?= $this->getHtml('Name'); ?></label>
                        <input type="text" name="Name" id="iName" value="<?= $this->printHtml($account->getL11n()); ?>" disabled>
                    </div>
                </div>
                <div class="portlet-foot">
                    <input id="iSubmit" name="submit" type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
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
        '{/api}accounting/coa/l11n'
    );
    ?>
</div>
<?php endif; ?>