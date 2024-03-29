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
                <?php echo form_open_multipart("backend/cms/contact") ?>
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
                            <input name="headline_fr" value="<?php echo htmlspecialchars($article->headline_fr)." ".$web_language->name ?>" class="form-control" placeholder="<?php echo display('headline_fr') ?>" type="text" id="headline_fr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_en" class="col-sm-2 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-sm-10">
                            <textarea name="article1_en" class="form-control editor" placeholder="<?php echo display('address') ?>" type="text" id="article1_en"><?php echo htmlspecialchars($article->article1_en) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article1_fr" class="col-sm-2 col-form-label"><?php echo display('phone') ?></label>
                        <div class="col-sm-10">
                            <textarea id="summernote" name="article1_fr" class="form-control editor" placeholder="<?php echo display('phone') ?>" type="text" id="article1_fr"><?php echo htmlspecialchars($article->article1_fr) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="article2_en" class="col-sm-2 col-form-label"><?php echo display('office_time') ?></label>
                        <div class="col-sm-10">
                            <textarea id="summernote1" name="article2_en" class="form-control editor" placeholder="<?php echo display('office_time') ?>" type="text" id="article2_en"><?php echo htmlspecialchars($article->article2_en) ?></textarea>
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