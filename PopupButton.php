<?php

namespace aayushmhu\popupbutton;
use yii;

/**
 * @author Aayush Saini <aayushsaini9999@gmail.com>
 */
class PopupButton extends \yii\bootstrap4\Button {

    const DEFAULT_BUTTON = 'aayushmhu-popupbtn';
    public $formid;
    public $searchformid;
    public $spinerclass = '"fa fa-spin fa-spinner"';
    public $popupwithsearch =false;
    public $options = [
        'id'=>'aayushmhu-popupbtn',
        'value'=>'',
    ];
    public $cssFile = '@aayushmhu/popupbutton/assets/default.css';
    /**
     * Auto Run Function
     *
     * @return void
     */
    public function run() {
        $this->cssFile = dirname(__DIR__).'/yii2-popupbutton/assets/default.css';
        $view = $this->getView();
        $js = "
        $('.popupButton').unbind( 'click' ).click( function () {
                $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));

                $('#modal').on('shown.bs.modal', function (e) {
                    var form =jQuery('#{$this->formid}');
                    form.on('beforeSubmit', function(e) {
                        var submit = form.find(':submit');
                        submit.html('<span class=".$this->spinerclass."></span> Processing...');
                        submit.prop('disabled', true);
                        e.preventDefault();
                        jQuery.ajax({
                            url: form.attr('action'),
                                type: form.attr('method'),
                                data: new FormData(form[0]),
                                mimeType: 'multipart/form-data',
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: 'json',
                                success: function (data) {
                                    if(data.success === true){
                                        $('#modal').modal('hide');
                                    }
                                },
                                error  : function (e)
                                {
                                    console.log(e);
                                }   
                        });
                        return false;        
                    })
                    $('#modal form')[0].reset();
                    
                });
            });
        ";

        $searchjs = "
        $('.popupButton').unbind( 'click' ).click( function () {
            $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
            
            $('#modal').on('shown.bs.modal', function (e) {
                var form =jQuery('#{$this->formid}');
                form.on('beforeSubmit', function(e) {
                    var submit = form.find(':submit');
                    submit.html('<span class=".$this->spinerclass."></span> Processing...');
                    submit.prop('disabled', true);
                    e.preventDefault();
                    jQuery.ajax({
                        url: form.attr('action'),
                            type: form.attr('method'),
                            data: new FormData(form[0]),
                            mimeType: 'multipart/form-data',
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: 'json',
                            success: function (data) {
                                if (data.success === true) {
                                    $('#{$this->searchformid}').submit();
                                    $('#modal').modal('hide');
                                }
                            },
                            error  : function (e)
                            {
                                console.log(e);
                            }   
                    });
                    return false;        
                })
                $('#modal form')[0].reset();
                
            });
        });
        ";

        if($this->popupwithsearch == True){
            $view->registerJs($searchjs);
        }else{
            $view->registerJs($js);
        }

        $view->registerCss(file_get_contents($this->cssFile));
        
        return parent::run();
    }

}
