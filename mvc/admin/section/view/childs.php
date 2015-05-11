<?php if(is_array($childs_list) and count($childs_list) > 0): ?>
    <ul class="padding-null box-list hidden">
    <?php 
    $lavel ++;
    foreach($childs_list as $_key => $_item): ?>
        <li>
            <div class='list-item'>
                <div class="left col-lg-1 text-center">
                    <div class='left'><?= str_repeat("-", $lavel - 1) ?></div>
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
                        <a href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" 
                           title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                        <a class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                    </div>
                </div>  
            </div>   
            <?php
              // childs
              if(isset($_item['childs']) and !empty($_item['childs'])) : ?>
                 
                 <?php $this->renderView('childs', array('childs_list' => $_item['childs'], 'lavel' => $lavel)); ?>
                    
              <?php endif; ?>
        </li>
        
    <?php endforeach; ?>
   </ul> 
  <?php endif; ?> 