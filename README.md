# popupbutton

For Use This Plugin You Need to Install Bootstrap 4

Example

IN View

use \aayushmhu\popupbutton\PopupButton;
\aayushmhu\popupbutton\PopupButton::widget([
'options' => [
'id'=>\aayushmhu\popupbutton\PopupButton::DEFAULT_BUTTON,
'value'=>'/site/popup',
'class'=>'btn btn-primary popupButton',
],
'formid'=>'department-form',
'type'=>\aayushmhu\popupbutton\PopupButton::POPUP_VIEWONLY,
'label'=>'Popup',
]);

in Controllers Use
public function actionPopup(){

    $model = $this->yourmodel();

return $this->renderAjax('contact', [
'model' => $model,
]);
}

value : This is the Url of Rendered Page
formid : This is Form if of Your Form if You Used form inside Popup

Note : Class Must be Used "popupButton" Other wise Plugin Not Worked

type: Popuptype Defineed if You use Popup With Diffrent Diffent Type

1. POPUP_VIEWONLY Popup is Just Render of Any Page
2. POPUP_WITHFORM This Type of Popup is Used for Form Submmision
3. POPUP_WITHFORM_SEARCH This Type of Popup is Used for Form Submission With a Search Form and if Pagination is True in Page Then it Will submit Data and PAge Will Stay on Pagination You Just See Form Submit and Page not Refreshed and Data Submitted and Updated

When You Use POPUP_WITHFORM_SEARCH you Must Defined "searchformid" On Page
