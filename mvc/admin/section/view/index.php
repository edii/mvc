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
        
        <div class="row">
            <div class="col-lg-12">
                <div class="box">

                    <div class="title">
                        <div class="row margin-null">
                            <h4 class="left col-lg-2">
                                <span><?= $sections_actual['name'] ?></span>
                            </h4>

                            <form class="box-form left p-t9 p-b9" action="">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <!-- type -->
                                        <select name="type" class="left form-control">
                                            <option value="0">-- Type --</option>
                                            <option value="admin">admin</option>
                                            <option value="front">front</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <!-- userID -->
                                        <select name="userID" class="left form-control">
                                            <option value="0">-- UserID --</option>
                                            <option value="admin">admin</option>
                                            <option value="front">front</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                            
                            <form class="box-form right p-t9 p-b9 m-r40" action="">
                                
                                <a style="margin-right: 5px;" href="<?= $this->_getUrl() ?>/manager/method/add">Добавить</a> 

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
                            
                        </div>    
                    </div>
                    
                    <div class="content noPad clearfix">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <ul class="padding-null box-list">
                                    <li>
                                        <div class="left col-lg-1 text-center">#</div>
                                        <div class="left col-lg-1 text-center">UserID</div>
                                        <div class="left col-lg-2 text-center">TimeCreated</div>
                                        <div class="left col-lg-2 text-center">Name <span class="alies">(Alias)</span></div>
                                        <div class="left col-lg-1 text-center">Type</div>
                                        <div class="left col-lg-2 text-center">Controller/Action</div>
                                        <div class="left col-lg-1 text-center"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                        <div class="left col-lg-2 text-center">Actions</div>
                                    </li>
                                </ul>
                                
                            </div>
                            <div class="col-lg-12">
                            <ul class="padding-null box-list">
                                <?php if(is_array($section_list) and count($section_list) > 0): ?>
                                    <?php 
                                    $lavel = 1;
                                    foreach($section_list as $_key => $_item): ?>
                                    <li>
                                        <div class='list-item'>
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
                                                    <a href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" 
                                                       title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php
                                          // childs
                                          if(isset($_item['childs']) and !empty($_item['childs'])) : ?>
                                        
                                          <?php    $this -> renderView('childs', 
                                                      array('childs_list' => $_item['childs'], 
                                                            'lavel' => $lavel)); ?>
                                           
                                         <?php endif; 
                                        ?>
                                    </li>   
                                    <?php endforeach; ?>
                                <?php endif; ?>    
                            </ul>
                            </div>    
                            <div class="col-lg-12">
                                <ul class="padding-null box-list">
                                    <li>
                                        <div class="left col-lg-1 text-center">#</div>
                                        <div class="left col-lg-1 text-center">UserID</div>
                                        <div class="left col-lg-2 text-center">TimeCreated</div>
                                        <div class="left col-lg-2 text-center">Name <span class="alies">(Alias)</span></div>
                                        <div class="left col-lg-1 text-center">Type</div>
                                        <div class="left col-lg-2 text-center">Controller/Action</div>
                                        <div class="left col-lg-1 text-center"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                        <div class="left col-lg-2 text-center">Actions</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    
                </div><!-- End .box -->
            </div> <!-- End span -->
            
        </div>
        

    </div><!-- End contentwrapper -->
</div><!-- End #content -->


<?php endif; ?>