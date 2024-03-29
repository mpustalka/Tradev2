<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?html_escape($title):null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("backend/cms/news/form/$article->article_id") ?>
                <?php echo form_hidden('article_id', html_escape($article->article_id)) ?> 
                    <div class="form-group row">
                        <label for="headline_en" class="col-sm-2 col-form-label"><?php echo display('headline_en') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <input name="headline_en" value="<?php echo htmlspecialchars($article->headline_en) ?>" class="form-control" placeholder="<?php echo display('headline_en') ?>" type="text" id="headline_en">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline_fr" class="col-sm-2 col-form-label"><?php echo display('headline')." ".html_escape($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <input name="headline_fr" value="<?php echo htmlspecialchars($article->headline_fr) ?>" class="form-control" placeholder="<?php echo display('headline')." ".html_escape($web_language->name) ?>" type="text" id="headline_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article_image" class="col-sm-2 col-form-label"><?php echo display('image') ?></label>
                        <div class="col-sm-10">
                            <input name="article_image" class="form-control" placeholder="<?php echo display('image') ?>" type="file" id="article_image">
                             <input type="hidden" name="article_image_old" value="<?php echo html_escape($article->article_image) ?>">
                             <?php if (!empty($article->article_image)) { ?>
                                <img src="<?php echo base_url().html_escape($article->article_image) ?>" width="150">
                             <?php } ?>   
                             <span  class="mention-text">290x205 px(jpg, jpeg, png, gif, ico)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_en" class="col-sm-2 col-form-label"><?php echo display('article_en') ?></label>
                        <div class="col-sm-10">
                            <textarea  id="summernote" name="article1_en" class="form-control" placeholder="<?php echo display('article_en') ?>" id="article1_en"><?php echo htmlspecialchars($article->article1_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_fr" class="col-sm-2 col-form-label"><?php echo display('article')." ".html_escape($web_language->name) ?></label>
                        <div class="col-sm-10">
                            <textarea id="summernote1" name="article1_fr" class="form-control" placeholder="<?php echo display('article')." ".html_escape($web_language->name) ?>" id="article1_fr"><?php echo htmlspecialchars($article->article1_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cat_id" class="col-sm-2 col-form-label"><?php echo display('select_cat') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-10">
                            <select class="form-control basic-single" name="cat_id">
                                <option value=""><?php echo display('select_cat') ?></option>
                                <?php foreach ($child_cat as $key => $value) { ?>
                                    <option value="<?php echo html_escape($value->cat_id); ?>" <?php echo ($article->cat_id==$value->cat_id)?'Selected':'' ?>><?php echo htmlspecialchars_decode($value->cat_name_en); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $article->article_id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- summernote css -->
<link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
<!-- summernote js -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
