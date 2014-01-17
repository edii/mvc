<?php
//    echo "<pre>";
//    var_dump( $tree );
//    echo "</pre>";
?>
<?php if(is_array($tree) and count($tree) > 0 and $validate): ?>
<div class="sidenav">

    <div class="sidebar-widget" style="margin: -1px 0 0 0;">
        <h5 class="title" style="margin-bottom:0">Navigation</h5>
    </div><!-- End .sidenav-widget -->

    <div class="mainnav">
        <ul>
            <?php foreach ($tree as $_items): ?>
                <li>
                    <div class="section-item">
                        <a href="/<?= _request_uri ?>/<?= $_items['SectionUrl'] ?>">
                            <span class="icon16 icomoon-icon-stats-up"></span>
                            <?= $_items['SectionName'] ?> 
                        </a>
                        <?php if(is_array($_items['childs']) and count($_items['childs']) > 0) { ?> 
                            <span class="notification red section-item-control">sub<?= count($_items['childs']) ?></span> 
                        <?php } ?> 
                    </div>
                    <?php if(is_array($_items['childs']) and count($_items['childs']) > 0): ?>
                        <ul class="sub">
                        <?php foreach($_items['childs'] as $_child): ?>
                            <li><a href="/<?= _request_uri ?>/<?= $_child['SectionUrl'] ?>"><span class="icon16 icomoon-icon-file"></span><?= $_child['SectionName'] ?></a></li>
                        <?php endforeach; ?>
                        </ul>    
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            
            
        </ul>
    </div>
</div><!-- End sidenav -->
<?php endif; ?>