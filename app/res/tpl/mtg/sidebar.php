<div class="sidebar">
    <div class="navscroll">
        <ul>
        <?php foreach ($subnav as $id => $record): ?>
        <li><a href="<?php echo $record['url'] ?>"><?php echo $record['name'] ?></a></li>
        <?php endforeach ?>
        </ul>
    </div>
</div>