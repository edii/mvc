<?php if(is_array($childs_list) and count($childs_list) > 0): ?>
    <ul class="padding-null box-list hidden sortable">
<!--   <ul class="sortable subcat-section section hidden">-->
    <?php 
    
//    echo "<pre>";
//    var_dump( $childs_list );
//    echo "</pre>"; die('stop');
    
    $lavel ++;
//    $_nbsp = '';
//    for($i = 0; $i < $lavel; $i++) {
//        $_nbsp .= '<div class="iteration">-</div>';
//    }
    foreach($childs_list as $_key => $_item): ?>
        <li>
            <div class="left col-lg-1 text-center">
                <span class="tabledrag">+</span>
                    <?= $_item['SectionID'] ?>/lv:<a class="table-toggle" href="#"><?= $lavel ?></a>
            </div>
            <div class="left col-lg-1 text-center"><?= $_item['UserID'] ?></div>
            <div class="left col-lg-2 text-center"><?= $_item['TimeCreated'] ?></div>
            <div class="left col-lg-2 text-center"><?= $_item['SectionName'] ?></div>
            <div class="left col-lg-1 text-center"><?= $_item['SectionType'] ?></div>
            <div class="left col-lg-2 text-center"><?= $_item['SectionController'] ?>/<?= $_item['SectionAction'] ?></div>
            <div class="left col-lg-1 text-center"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
            <div class="left col-lg-2">
                <div class="controls center">
                    <a target="_blank"
                        href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" 
                       title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                    <a target="_blank"
                        class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                </div>
            </div>  
               
            <?php
              // childs
              if(isset($_item['childs']) and !empty($_item['childs'])) : ?>
                 
                 <?php $this->renderView('childs', array('childs_list' => $_item['childs'], 'lavel' => $lavel)); ?>
                    
              <?php endif; ?>
        </li>
        

<!--        <tr data-id="<?= $_item['SectionParentID'] ?>_<?= $lavel ?>" class="odd gradeX hidden">
            <td><span><?php echo str_repeat('-', $lavel); ?></span> <?= $_item['SectionID'] ?>/lv:<a class="item-edit tabledrag" href="#"><?= $lavel ?></a></td>
            <td><?= $_item['UserID'] ?></td>
            <td><?= $_item['TimeCreated'] ?></td>
            <td><?= $_item['SectionName'] ?></td>
            <td><?= $_item['SectionType'] ?></td>
            <td><?= $_item['SectionController'] ?>/<?= $_item['SectionAction'] ?></td>
            <td><input type="checkbox" name="checkbox" value="1" class="styled" /></td>
            <td>
                <div class="controls center">
                    <a target="_blank"
                        href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" 
                       title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                    <a target="_blank"
                        class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                </div>
            </td>
        </tr>                                    -->

      

    <?php endforeach; ?>
   </ul> 
  <?php endif; ?> 