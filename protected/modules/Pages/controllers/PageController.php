<?php

class PageController extends Controller {

    public function actionSaveProduct() {

        if(!empty($_POST)  && isset($_POST['data']) && isset($_POST['page_id'])) {
            $new_product = new PageProducts();
            $prod_info = serialize($_POST['data']);
            $page_id = intval($_POST['page_id']);
            $page_data = PageProducts::model()->findByAttributes(array(
                'page_id' => $page_id
            ));
            if($page_data) {
                $page_data->data = $prod_info;
                $page_data->save();
            }

            else {
                $new_product->page_id = $page_id;
                $new_product->data = $prod_info;
                if($new_product->validate())
                    $new_product->save();

            }

        }
        die;

    }


    public function actionIndex() {
        
        $page = new Page();
        $Product_pages = new PageProducts();
        $RetailerCategory = new RetailerCategory();

        $page_category = new PageCategory();

        $Pages = $page->findAll();
        $page_arr = array();
        foreach ($Pages as $page) {
            $page_arr[$page->id] = $page->title;
        }

        $categories = RetailerCategory::model()->findAll();
        $category_arr = array();
        foreach ($categories as $cetgory) {
            $category_arr[$cetgory->id] = $cetgory->name;
        }

        $render_arr = array('pages' => $page_category, 'page_arr' => $page_arr, 'category_arr' => $category_arr, 'model_prod' => $Product_pages);        

        if (isset($_POST['PageCategory'])) {


            $post_page = Yii::app()->request->getPost('PageCategory');
//                $page_product = PageProducts::model()->find("page_id = ".$post_page['page_id']);
            $post_page_id = Page::model()->findByPk($post_page['page_id']);
            $post_category_id = $page_category->findByPk($post_page['category_id']);

            if ($post_page_id != Null && $post_category_id != Null) {
                //$issetPage = PageCategory::model()->findByPk($post_page['page_id']);
                $issetPage = PageCategory::model()->findByAttributes(array(
                    'page_id' => $post_page['page_id']
                ));

                if ($issetPage == Null) {
                    $page_category->setAttributes($post_page);
                    if ($page_category->validate()) {
                        $page_category->save();
                    }
                } else {

                    $issetPage->setAttributes($post_page);
                    if ($issetPage->validate()) {

                        $issetPage->save();
                    }
                }

                $query_params = PageCategory::model()->find("page_id = " . $post_page['page_id']);

                $categories = RetailerCategory::model()->findByPk($query_params['category_id']);
                $url = 'http://productsearch.linksynergy.com/productsearch?token=004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9&keyword=' . $categories['name'] . '&cat=' . $categories['name'] . '&MaxResults=' . $query_params['count'] . '&pagenumber=1&mid=2557&sort=retailprice&sorttype=asc&sort=productname&sorttype=asc';
                $products = $this->curl_get_contents($url);
                $render_arr = array('pages' => $page_category, 'page_arr' => $page_arr, 'category_arr' => $category_arr, 'productCount' => $query_params['count'], 'products' => $products, 'model_prod' => $Product_pages, 'page_id' => $post_page['page_id']);

//                        }
            }
        }

        $this->render('index', $render_arr);
    }

    function curl_get_contents($url) {


        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(header('Content-Type: application/Json')));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $data = curl_exec($curl);

        curl_close($curl);

        $data = simplexml_load_string($data);

        return array(
            'data' => $data
        );
    }

}
