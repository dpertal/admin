<?php

class PageController extends Controller
{
	public function actionIndex()
	{
            $page = new Page();
            $RetailerCategory  = new RetailerCategory();
            
            $page_category = new PageCategory();
            
            $Pages = $page->findAll();
            $page_arr = array();
            foreach ($Pages as $page){
                $page_arr[$page->id] = $page->title;
            }
            
            $categories = RetailerCategory::model()->findAll();
            $category_arr = array();
            foreach ($categories as $cetgory){
                $category_arr[$cetgory->id] = $cetgory->name;
            }
            
            
            if(isset($_POST['PageCategory'])) {

                $post_page = Yii::app()->request->getPost('PageCategory');
                $post_page_id = Page::model()->findByPk($post_page['page_id']);
                $post_category_id = Page::model()->findByPk($post_page['category_id']);
                 
                if($post_page_id != Null && $post_category_id != Null){
                    $issetPage= PageCategory::model()->findByPk($post_page['page_id']);
                        if($issetPage == Null){
                            $page_category->setAttributes($post_page);
                            if($page_category->validate()){
                                $page_category->save();
                            } 
                        }else{
                            $issetPage->setAttributes($post_page);
                            if($issetPage->validate()){
                                $issetPage->save();
                            }                             
                        }                                                                     
                }
            }
            
            $this->render('index',array('pages'=>$page_category,'page_arr'=>$page_arr,'category_arr'=>$category_arr));
	}
}