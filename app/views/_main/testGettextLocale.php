<div id="testGettext">
    <h1><?=gettext('Introduction')?></h1>
    <p><?=gettext('We\'re now translating some strings')?></p>

    <?php $name = 'NameTest'; ?>
    <?php $unread = 2; ?>

    <h1><?=sprintf(gettext('Welcome, %s!'), $name)?></h1>
    <?php if ($unread): ?>
        <h2><?=sprintf(ngettext('Only one unread message', '%d unread messages', $unread), $unread)?></h2>
    <?php endif ?>
</div>