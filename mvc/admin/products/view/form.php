<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3><?php // $sections_actual['name'] ?></h3>                    

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
                <li class="active"><?php // $sections_actual['name'] ?></li>
            </ul>

        </div><!-- End .heading-->

        <!-- FORM (Add/Edit) -->
        <form class="form-horizontal" action="#">
            <input type="hidden" name="method" value="<?= ($this->getParam('method') == 'edit') ? 'edit': 'add' ?>" />
            <!-- edit -->
            <?php if((int)$this->getParam('id')): ?>
                <input type="hidden" name="product[id]" value="<?= $this->getParam('id') ?>" />
                <input type="hidden" name="product[timeSaved]" value="<?= date('Y-m-d H:i:s') ?>" />
            <?php endif; ?>
            <!-- add -->
            <?php if($this->getParam('method') == 'add'): ?>
                <input type="hidden" name="product[timeCreated]" value="<?= date('Y-m-d H:i:s') ?>" />
            <?php endif; ?>
            
            
            <div class="row-fluid row">
                <div class="col-sm-12 col-md-12 col-lg-12 mb10">
                    
                    <div class="title left">
                        <h4> 
                            <span><?= $title ?></span>
                        </h4>
                    </div>
                    <div class="form-actions left ml10">
                       <button type="submit" class="btn btn-info">Save changes</button>
                       <button type="button" class="btn btn-default">Cancel</button>
                    </div>
                    
                </div>    
                
                <!-- default params -->
                <div class="col-sm-6 col-md-6 col-lg-6">

                    <div class="box">
                        <div class="title">
                            <h4>
                                <span>Main</span>
                            </h4>
                        </div>
                        <div class="content">
                            <!-- alies -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Alias</label>
                                        <input class="span8" id="normalInput" type="text" name="product[alias]" value="<?= (isset($listing['alias'])) ? $listing['alias'] : '' ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Code -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Code</label>
                                        <input class="span8" id="normalInput" type="text" name="product[code]" value="<?= (isset($listing['code'])) ? $listing['code'] : '' ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- CategoryID -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">CategoryID</label>
                                        <select name="product[categoryID]">
                                            <option value="0"> -- Root category -- </option>
                                            <option value="1"> Test 1 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">ExtraCategoryID</label>
                                        <select name="product[extraCategoryID]">
                                            <option value="0"> -- Root category -- </option>
                                            <option value="1"> Test 1 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
<!--                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Normal Textarea</label>
                                        <textarea class="span8" id="textarea" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>-->

                            
                        </div>
                    </div><!-- End .box -->

                </div>
                <!-- end -->

                <div class="col-sm-6 col-md-6 col-lg-6">

                    <div class="box">

                        <div class="title">

                            <h4> 
                                <span>Settings</span>
                            </h4>

                        </div>
                        <div class="content">
                            <!-- Name -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Name</label>
                                        <input class="span8" id="normalInput" type="text" name="product[name]" value="<?= (isset($listing['name'])) ? $listing['name'] : '' ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Price</label>
                                        <input class="span8" id="normalInput" type="text" name="product[price]" value="<?= (isset($listing['price'])) ? $listing['price'] : '' ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tags -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="tags">Tags</label>
                                        <div class="span8 controls">
                                            <input id="tags" type="text" value="awesome,nice" style="width:100%;" />
                                        </div>
                                    </div>
                                </div>  
                            </div>  

                            <!-- Description -->
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Description</label>
                                        <textarea class="span8" id="textarea" name="product[description]" rows="3"><?= (isset($listing['description'])) ? $listing['description'] : '' ?></textarea>
                                    </div>
                                </div>

                            </div>
                            
                            
<!--                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Grid fields</label>
                                            <div class="grid-inputs span8">
                                                <input class="span3" type="text" placeholder=".span2" />
                                                <input class="span5" type="text" placeholder=".span4" />
                                                <input class="span8" type="text" placeholder=".span6" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="textarea">File input</label>
                                            <input type="file" name="fileinput" id="file" />
                                        </div>
                                    </div>  
                                </div>-->

<!--                                <div class="form-actions">
                                   <button type="submit" class="btn btn-info">Save changes</button>
                                   <button type="button" class="btn">Cancel</button>
                                </div>-->

                        </div>

                    </div><!-- End .box -->

                </div>
                  
            </div>  
            
        </form>    
        <!-- END FROM -->
    </div>
</div>    