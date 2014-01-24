<?php if(is_array($childs_list) and count($childs_list) > 0): ?>
   <ul>
    <?php 
    $lavel += 1;
    $_nbsp = '';
    for($i = 0; $i < $lavel; $i++) {
        $_nbsp .= '<div class="iteration">-</div>';
    }
    foreach($childs_list as $_key => $_item): ?>
        <li id="custom">
            <div class="item-sorttable"><?= $_nbsp ?><a class="tabledrag" href="#"> <?= $lavel ?>  </a></div>
            <div class="item-sorttable"><?= $_item['TimeCreated'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionAlias'] ?></div>
            <div class="item-sorttable"><?= $_item['UserID'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionType'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionParentID'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionName'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionController'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionAction'] ?></div>
            <div class="item-sorttable"><?= $_item['SectionUrl'] ?></div>
            <div class="item-sorttable"><?= $_item['hidden'] ?></div>
            <div class="item-sorttable" class="chChildren"><input type="checkbox" name="checkbox" value="1" class="styled" /></div>
            <div class="item-sorttable">
                <div class="controls center">
                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                    <a class="delete" href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                </div>
            </div>
          </li>

          <?php
          // childs
          if(isset($_item['childs']) and !empty($_item['childs'])) :
              $this->renderView('childs', array('childs_list' => $_item['childs'], 'lavel' => $lavel));
          endif; ?>

    <?php endforeach; ?>
   </ul>      
  <?php endif; ?> 