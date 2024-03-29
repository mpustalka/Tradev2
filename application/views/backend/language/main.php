<div class="panel panel-bd lobidrag">

    <div class="panel-heading">
        <div class="btn-group"> 
            <a class="btn btn-success" href="<?php echo base_url("backend/dashboard/language/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a> 
        </div> 
    </div>


    <div class="panel-body">
      <table class="table table-striped">
        <thead>
            <tr>
                <td colspan="3">
                    <?php echo  form_open('backend/dashboard/language/addlanguage', ' class="form-inline" ') ?> 
                        <div class="form-group">
                            <label class="sr-only" for="addLanguage"> Language Name</label>
                            <input name="language" type="text" class="form-control" id="addLanguage" placeholder="Language Name">
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Save</button>
                    <?php echo  form_close(); ?>
                </td>
            </tr>
            <tr>
                <th><i class="fa fa-th-list"></i></th>
                <th>Language</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>


        <tbody>
            <?php if (!empty($languages)) {?>
                <?php $sl = 1 ?>
                <?php foreach ($languages as $key => $language) {?>
                <tr>
                    <td><?php echo  html_escape($sl++) ?></td>
                    <td><?php echo  html_escape($language) ?></td>
                    <td><a href="<?php echo  base_url("backend/dashboard/language/editPhrase/$key") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>  
                    </td> 
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>

      </table>
    </div>
  
</div>

