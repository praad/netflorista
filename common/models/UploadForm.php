<?php

class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }
}
