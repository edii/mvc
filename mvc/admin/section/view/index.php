<?php if(!$validate): ?>
    <!-- error fatall or other -->
<?php else: ?>

        
<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3><?= $sections_actual['name'] ?></h3>                    

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                    <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                </form>

            </div><!-- End search -->

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" title="back to dashboard">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-3"></span>
                    </span>
                </li>
                <li class="active"><?= $sections_actual['name'] ?></li>
            </ul>

        </div><!-- End .heading-->
        
        <div class="row-fluid">
            <div class="span">
                <div class="box">

                    <div class="title">

                        <h4>
                            <span class="icon16 icomoon-icon-equalizer-2"></span>
                            <span>Sections controls</span>
                            
                             
                            
                            <form class="box-form right" action="">
                                <a style="margin-right: 5px;" href="<?= $this->_getUrl() ?>/manager_s/method/add">Добавить</a> 
                                
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="icon16 icomoon-icon-cog-2"></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><span class="icon-pencil"></span> Скрыть </a></li>
                                    <li><a href="#"><span class="icon-pencil"></span> Отобразить </a></li>
                                    <li><a class="delete" href="#"><span class="icon-trash"></span> Удалить </a></li>
                                </ul>
                            </form>
                            
                        </h4>
                        
                        <a href="#" class="minimize"> Минимизация </a>
                    </div>
                    
                    <div class="content noPad clearfix">
                        
                        
                        <ul class="sortable section clearfix">
                            <li id="head">
                                <div class="item-sorttable">#</div>
                                <div class="item-sorttable">TimeCreated</div>
                                <div class="item-sorttable">Alias</div>
                                <div class="item-sorttable">UserID</div>
                                <div class="item-sorttable">Type</div>
                                <div class="item-sorttable">ParentID</div>
                                <div class="item-sorttable">Name</div>
                                <div class="item-sorttable">Controller</div>
                                <div class="item-sorttable">Action</div>
                                <div class="item-sorttable">Url</div>
                              
                                <div id="masterCh" class="item-sorttable ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                <div class="item-sorttable">Actions</div>
                            </li>
                           
                                <?php 
                              // var_dump($section_list); die('stop');
                              if(is_array($section_list) and count($section_list) > 0): ?>
                                <?php 
                                $lavel = 1;
                                foreach($section_list as $_key => $_item): ?>
                                    <li id="custom">
                                        <div class="item-sorttable"><a class="tabledrag" href="#"><?= $lavel ?></a></div>
                                        <div class="item-sorttable"><?= $_item['TimeCreated'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionAlias'] ?></div>
                                        <div class="item-sorttable"><?= $_item['UserID'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionType'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionParentID'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionName'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionController'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionAction'] ?></div>
                                        <div class="item-sorttable"><?= $_item['SectionUrl'] ?></div>
                                        
                                        <div class="item-sorttable" class="chChildren"><input type="checkbox" name="checkbox" value="1" class="styled" /></div>
                                        <div class="item-sorttable">
                                            <div class="controls center">
                                                <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a class="delete" href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </div>
                                        </div>
                                      
                                      
                                      <?php
                                      // childs
                                      if(isset($_item['childs']) and !empty($_item['childs'])) :
                                          $this -> renderView('childs', array('childs_list' => $_item['childs'], 'lavel' => $lavel));
                                      endif; 
                                      ?>
                                      
                                    </li>  
                                        
                                <?php endforeach; ?>
                              <?php endif; ?>  
                            
                        </ul>
                        
                        
                    </div>

                </div><!-- End .box -->
            </div> <!-- End span -->
            
        </div>

    </div><!-- End contentwrapper -->
</div><!-- End #content -->


<?php endif; ?>