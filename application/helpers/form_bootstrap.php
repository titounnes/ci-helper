<?php
if ( ! function_exists('data_form'))
{
 function data_form($data,$button=true)
  {
    $form=form_open($data['action'],'class="form-horizontal" role="form"');
    $action=isset($data['action'])?$data['action']:'';
    $button_bar=$button?'':'style="display:none"';
    $button_new=$data['new']?'':'style="display:none"';
    $output=<<<EOL
    <div class="modal-content">
      <div class="modal-body" id="dialog-body">    
        {$form}
            <div class="modal-header box box-body">
                <h4 class="modal-title" id="dialog-title"> &nbsp;
                  <b id="title-bar">&nbsp; {$data['title']}</b>
                  <span class="pull-right" {$button_bar} id="buttonbar">
                      <a href="#" accesskey="s" class="btn btn-load btn-default btn-ajax-save" title="Simpan">
                        <i class="fa fa-floppy-o"></i> <u>S</u>ave 
                      </a>
                      <a href="#" accesskey="n" $button_new class="btn btn-load btn-default new-ajax" title="Data Baru">
                        <i class="fa fa-file-o"></i> <u>N</u>ew</a>
                      <a href="#" accesskey="c" class="btn btn-default cls-ajax" title="Tutup" data-dismiss="modal">
                        <i class="fa fa-close"></i> <u>C</u>lose 
                      </a>
                  </span>
                </h4>
            </div>

            <div class="widget-main">
EOL;
              foreach($data['field'] as $key=>$row)
              {
                $output.='<div class="form-group has-feedback">';
                $output.='<label class="col-sm-4 control-label no-padding-right" for="'.$key.'">';
                $output.=$row['label'];
                $output.='</label>';
                $output.='<div class="col-sm-7">';
                switch($row['type'])
                {
                  case 'select' : $output.=form_dropdown($row['name'],$row['option'],$row['value'],$row['extra']);break; 
                  default : $output.=form_input($row);break
                }
                $output.='</div></div>';
              }
              $output.=<<<EOL
              
            </div>
      </form>
    </div>
  </div>
EOL;
      return $output;
  }
}
