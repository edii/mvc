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
                                
<!--                                <div class="table">
                                    <div class="table-row">
                                        <div class="table-cell">#</div>
                                        <div class="table-cell">UserID</div>
                                        <div class="table-cell">TimeCreated</div>
                                        <div class="table-cell">Name <span class="alies">(Alias)</span></div>
                                        <div class="table-cell">Type</div>
                                        <div class="table-cell">Controller/Action</div>
                                        <div class="table-cell"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                        <div class="table-cell">Actions</div>
                                    </div>
                                </div>-->
                                
<!--                                <ul class="row box-list">
                                    <li class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-1">#</div>
                                            <div class="col-lg-1">UserID</div>
                                            <div class="col-lg-2">TimeCreated</div>
                                            <div class="col-lg-2">Name <span class="alies">(Alias)</span></div>
                                            <div class="col-lg-1">Type</div>
                                            <div class="col-lg-2">Controller/Action</div>
                                            <div class="col-lg-1"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                            <div class="col-lg-2">Actions</div>
                                        </div>    
                                    </li>
                                    
                                </ul>-->
                            </div>
                            <div class="col-lg-12">
                            <ul class="padding-null box-list sortable">
                                <?php if(is_array($section_list) and count($section_list) > 0): ?>
                                    <?php 
                                    $lavel = 1;
                                    foreach($section_list as $_key => $_item): ?>
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
                                        
                                          <?php    $this -> renderView('childs', 
                                                      array('childs_list' => $_item['childs'], 
                                                            'lavel' => $lavel)); ?>
                                           
                                         <?php endif; 
                                        ?>
                                        
                                        
<!--                                        <dl>
                                            <dt class="text-center table-cell">
                                                <span class="tabledrag">+</span>
                                                <?= $_item['SectionID'] ?>/lv:<a class="table-toggle" href="#"><?= $lavel ?></a>
                                            </dt>
                                            <dt class="text-center table-cell"><?= $_item['UserID'] ?></dt>
                                            <dt class="text-center table-cell"><?= $_item['TimeCreated'] ?></dt>
                                            <dt class="text-center table-cell"><?= $_item['SectionName'] ?></dt>
                                            <dt class="text-center table-cell"><?= $_item['SectionType'] ?></dt>
                                            <dt class="text-center table-cell"><?= $_item['SectionController'] ?>/<?= $_item['SectionAction'] ?></dt>
                                            <dt class="text-center table-cell"><input type="checkbox" name="checkbox" value="all" class="styled" /></dt>
                                            <dt class="text-center table-cell">
                                                <div class="controls center">
                                                    <a target="_blank"
                                                        href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" 
                                                       title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                    <a target="_blank"
                                                        class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                                </div>
                                            </dt>
                                        </dl>-->
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
                        
                        
                        <?php /*
                        <table cellpadding="0" 
                               cellspacing="0" 
                               border="0" 
                               class="dynamicTable display table table-bordered" 
                               width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">UserID</th>
                                    <th class="text-center">TimeCreated</th>
                                    <th class="text-center">Name <span class="alies">(Alias)</span></th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Controller/Action</th>
                                    <th class="text-center"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($section_list) and count($section_list) > 0): ?>
                                    <?php 
                                    $lavel = 1;
                                    foreach($section_list as $_key => $_item): ?>
                                        <tr class="odd gradeX">
                                            <td><span class="tabledrag">+</span><?= $_item['SectionID'] ?>/lv:<a class="table-toggle" href="#"><?= $lavel ?></a></td>
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
                                        </tr>
                                        <?php
                                          // childs
                                          if(isset($_item['childs']) and !empty($_item['childs'])) :
                                              $this -> renderView('childs', 
                                                      array('childs_list' => $_item['childs'], 
                                                            'lavel' => $lavel));
                                          endif; 
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">UserID</th>
                                    <th class="text-center">TimeCreated</th>
                                    <th class="text-center">Name <span class="alies">(Alias)</span></th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Controller/Action</th>
                                    <th class="text-center"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                         * 
                         */ ?>
                    </div>
                    
                    <?php /*
                    <div class="title">

                        <h4 class="clearfix">
                            <div class="container col-lg-12">
                                <div class="row">
                                    <span class="icon16 icomoon-icon-equalizer-2 col-lg-1"></span>
                                    <span class="col-lg-7">Sections controls</span>



                                    <form class="box-form right col-lg-2" action="">
                                        <!-- type -->
                                        <select name="type" class="form-control">
                                            <option value="admin">admin</option>
                                            <option value="front">front</option>
                                        </select>
                                        
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
                        </h4>
                        
                        <a href="#" class="minimize"> Минимизация </a>
                    </div>
                    
                    <div class="content noPad clearfix">
                        <div class='container col-lg-12'>
                            <div class="row">    
                               
                                    <div class="col-lg-1 font-bold">#</div>
                                    <div class="col-lg-1 font-bold">ID</div>
                                    <div class="col-lg-1 font-bold">UserID</div>
                                    <div class="col-lg-1 font-bold">TimeCreated</div>
                                    <div class="col-lg-3 font-bold">Name <span class="alies">(Alias)</span></div>
                                    <div class="col-lg-1 font-bold">Type</div>
                                    <div class="col-lg-2 font-bold">Controller/Action</div>
                                    <div id="masterCh" class="col-lg-1 ch font-bold"><input type="checkbox" name="checkbox" value="all" class="styled" /></div>
                                    <div class="col-lg-1 action font-bold">Actions</div>
                                
                            </div>
                        </div> <!-- .container -->    
                            
                        <!-- list -->
                        <?php if(is_array($section_list) and count($section_list) > 0): ?>
                        <div class='container col-lg-12'>
                            <div class="row">
                                <?php 
                                        $lavel = 1;
                                        foreach($section_list as $_key => $_item): ?>
                                <ul class="box-section col-lg-12">
                                    <li class="col-lg-1">
                                        lv: <a class="item-edit tabledrag" href="#"><?= $lavel ?></a>
                                        <br /><span id="sections" class="open-subcat"> sub </span>
                                    </li>
                                    <li class="col-lg-1">
                                        <?= $_item['SectionID'] ?>
                                    </li>
                                    <li class="col-lg-1">
                                        <?= $_item['UserID'] ?>
                                    </li>
                                    <li class="col-lg-1">
                                        <?= $_item['TimeCreated'] ?>
                                    </li>
                                    <li class="col-lg-3">
                                        <?= $_item['SectionName'] ?>
                                    </li>
                                    <li class="col-lg-1">
                                        <?= $_item['SectionType'] ?>
                                    </li>
                                    <li class="col-lg-2">
                                        <?= $_item['SectionController'] ?>/<?= $_item['SectionAction'] ?>
                                    </li>
                                    <li class="col-lg-1">
                                        <input type="checkbox" name="checkbox" value="1" class="styled" />
                                    </li>
                                    <li class="col-lg-1">
                                        <div class="controls center">
                                            <a href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $_item['SectionID'] ?>" title="Редактировать Section" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                            <a class="delete" href="<?= $this->_getUrl() ?>/delete/id/<?= $_item['SectionID'] ?>" title="Удалить Section" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                        </div>
                                    </li>
                                </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>    
                        <?php endif; ?>
                        <!-- end -->
                        
                    </div>
                    */ ?>
                </div><!-- End .box -->
            </div> <!-- End span -->
            
        </div>
        

    </div><!-- End contentwrapper -->
</div><!-- End #content -->


<?php endif; ?>