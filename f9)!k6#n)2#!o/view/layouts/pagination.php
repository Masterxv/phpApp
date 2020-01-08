<?php
if (isset($_GET['sterm'])) {
    $sterm = 'sterm='.$_GET['sterm'].'&';
} else {
    $sterm = '';
}
?>
<?php if($total_pages > 1): ?>
<ul class="pagination">
    <li><a href="?<?php echo $sterm; ?>pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?".$sterm."pageno=".($pageno - 1); } ?>">Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?".$sterm."pageno=".($pageno + 1); } ?>">Next</a>
    </li>
    <li><a href="?<?php echo $sterm; ?>pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<?php endif; ?>