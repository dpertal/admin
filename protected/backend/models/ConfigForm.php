<?php
class ConfigForm extends CFormModel
{
	public $template_id;

    public function rules()
    {
        return array(
            array('template_id','required'),
        );
    }
}
?>