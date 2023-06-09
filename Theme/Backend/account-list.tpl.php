<template id="entry-list-tpl">
    <div id="entry-list" class="box" style="z-index: 99; position: relative; top: 20px; display: block; margin: 0 auto; width: 20%;">
        <table class="default sticky">
            <caption><?= $this->getHtml('Accounts'); ?><i class="fa fa-download end-xs download btn"></i></caption>
            <thead>
            <tr>
                <td><?= $this->getHtml('ID', '0', '0'); ?>
                <td class="wf-100"><?= $this->getHtml('Account'); ?>
            <tbody>
        </table>
    </div>
</template>