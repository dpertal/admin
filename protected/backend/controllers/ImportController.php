<?php

class ImportController extends Controller {

    public $layout = '//layouts/column1';

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('dgm', 'view'),
                'users' => array('*'),
            ),
        );
    }

    public function actionLinkShareImport() {
        //Get Merchants
        $client = new SoapClient('http://lld2.linksynergy.com/services/soapLinks/?wsdl');
        $result = $client->getMerchByAppStatus(array('token' => '004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9', 'status' => 'approved'));
        $retailers = $result->return;
        $retailerIds = array();
        
        foreach ($retailers as $retailer) {
            echo $name = $retailer->name;
            $externalId = $retailer->mid;
           
            //Check If Retailer already exists
            $retailerDB = Retailer::model()->find('name="' . $name . '"');
            if (!isset($retailerDB)) {
                $retailerDB = new Retailer();
            }

            //Save merchant details
            $retailerDB->name = $name;
            $retailerDB->affiliate_network_id = 2;
            //$retailerDB->vars['url'] = $retailer->clickurl;
            $retailerDB->external_id = $externalId;
            $retailerDB->commission = $retailer->offer->commissionTerms;
            $retailerDB->commission_type_id = 4;

            /*
              $catExtIDs = explode(' ', $retailer->categories);
              $retCatIDs = array();
              $impCatIDs = array();
              foreach ($catExtIDs as $catExtID) {
              print "LOOKING FOR CATEGORY $catExtID\n";
              $importedCat = $this->mapRecord('ImportedCategory', $catExtID, 'externalID', false);
              //$this->ImportedCategory->find('first', array('conditions' => array('affiliate_network_id'=>$this->affiliateNetworkID, 'external_id'=>$catExtID)));
              if ($importedCat) {
              print "FOUND CAT " . $importedCat->vars['name'] . "\n";
              $impCatIDs[] = $importedCat->vars['id'];
              foreach ($importedCat->arrayValueForRelationship('rCategories') as $retCat) {
              print "MAPPING RETAILER CAT " . $retCat->vars['name'] . "\n";
              $retCatIDs[] = $retCat->vars['id'];
              }
              }
              }
              //$categories[] = $this->mapRecord($this->ImportedCategory, 'imported_category_id', 'ImportedCategory', $retailer->Category, $retailerDB);
             */

            //$checksum = md5(serialize(array($retailer, $impCatIDs, $retCatIDs)));
            //$checksumDB = safeValue($retailerDB->vars, 'checksum');
            //print "CHECKSUM IS $checksum\n";
            //if ($checksumDB != $checksum) {
            $retailerDB->checksum = 0;//$checksum;
            $retailerDB->active = 0;
            $retailerDB->updated = date('Y-m-d H:i:s');
            //$saveArr = array('Retailer' => $retailerDB, 'ImportedCategory' => array('ImportedCategory' => $impCatIDs), 'RetailerCategory' => array('RetailerCategory' => $retCatIDs));
            //        print "\nSAVING\n";
            //        print_r($saveArr);
            $retailerDB->save();
            //$this->processJoin($retailerID, $impCatIDs, 'ImportedCategoryRetailer', 'importedCategoryID');
            //$this->processJoin($retailerID, $retCatIDs, 'RetailerCategoryRetailer', 'retailerCategoryID');
            //} else {
            //   print "CHECKSUM MATCHES. NOT SAVING\n";          b      9ir8rrz\erfgv 
            //}
            $retailerID = $retailerDB->id;       
            $retailerIds[$externalId] = $retailerID;
        }
     
        //import banners
        $this->importLinkShareBanners($client,$retailerIds);
        
        //import couponsd x nxxn jxjnxn jxnxnxxjxx x x  x xxxx xnxxmjxnxmhhhhhhhhhhxx xjmhxx hhxnmhxmxmxmhxjnxmhmxmhxmhxmmmmmmmmmmmmmmmmmmmhxmxmmmmmxnmxmhxxxmhxmhxmxmmmmmmmmmmmmmmmmmmmmhxxxxxyxxyxmmmmmmmmmmmmmmmmmmh./h/y/;.h.hh;hhh;.h.;.h
        $this->importLinkShareCoupon($client,$retailerIds);
    }

    public function actionCommissionFatoryImport($id) {

        //Get Merchants
        $retailers = json_decode(file_get_contents('https://api.commissionfactory.com.au/V1/Affiliate/Merchants?apiKey=62a4da25a7294aa190afccd3414f8d20&contentType=application/JSON&status=joined'));

        $retailerIds = array();
        foreach ($retailers as $retailer) {

            $name = $retailer->Name;
            $updated = $retailer->DateModified;
            $externalId = $retailer->Id;

            //Check If Retailer already exists
            $retailerDB = Retailer::model()->find('name="' . $name . '"');
            if (!isset($retailerDB)) {
                $retailerDB = new Retailer();
            }

            $updatedDB = $retailerDB->updated;
            if ($updatedDB && (strtotime($updatedDB) >= strtotime($updated))) {
                $retailerId = $retailerDB->id;
            } else {
                //Save merchant details
                $retailerDB->name = $name;
                $retailerDB->logo_url = $retailer->AvatarUrl;
                $retailerDB->affiliate_network_id = 1;
                $retailerDB->description = $retailer->Summary;
                $retailerDB->url = $retailer->TrackingUrl;
                $retailerDB->external_id = $externalId;
                $cType = CommissionType::model()->find('title="' . $retailer->CommissionType . '"');
                if (!isset($cType)) {
                    $cType = new CommissionType();
                }
                $retailerDB->commission_type_id = $cType->id;

                $commision = $retailer->CommissionRate;
                $bonus = $commision * 0.8;

                $commissionType = $cType->id;
                if ($commissionType == 1) {
                    $commisionStr = $commision . '%';
                    $bonusCash = $bonus . '%';
                } else if ($commissionType == 2) {
                    $commisionStr = '$' . number_format($commision, 2);
                    $bonusCash = '$' . number_format($bonus, 2);
                } else if ($commissionType == 3) {
                    $commisionStr = '$' . number_format($commision, 2) . ' Per Lead';
                    $bonusCash = '$' . number_format($bonus, 2);
                }
                if (isset($commisionStr) && isset($bonusCash)) {
                    $retailerDB->commission = $commisionStr;
                    if (is_numeric($commision)) {
                        $retailerDB->bonus_cash = $bonusCash;
                    }
                } else {
                    echo "UNKOWN COMISSION TYPE $commissionType\n";
                }

                $retailerDB->updated = $updated;
                $retailerDB->save();

                $this->manageRetailerCategories($retailerId, $retailer->Category);
            }

            $retailerIds[$externalId] = $retailerId;
        }

        //import banners
        $this->importCFBanners($retailerIds);

        //import coupons
        $this->importCFCoupons($retailerIds);
    }

    public function actionDgmImport($id) {
        //Get Merchants
        $retailers = json_decode(file_get_contents('https://IRkUox36xP4988106GZ34zqD4HrBqxTxC3:ZNnq3mKFvamsMjZ5KFSDpDRTbpimGRDf@api.impactradius.com/2010-09-01/Mediapartners/IRkUox36xP4988106GZ34zqD4HrBqxTxC3/Campaigns.json'));

        $retailerIds = array();

        do {
            foreach ($retailers->Campaign as $retailer) {

                $checksum = md5(serialize($retailer));
                $name = $retailer->CampaignName;
                $externalId = $retailer->CampaignId;

                $retailerDB = Retailer::model()->find('name="' . $name . '"');
                if (!isset($retailerDB)) {
                    $retailerDB = new Retailer();
                }
                $checksumDB = $retailerDB->checksum;
                if ($checksumDB == $checksum) {
                    print "skipping $name\n";
                } else {
                    print "updating $name\n";
                    //Save merchant details
                    $retailerDB->logo_url = 'http://dgmperformance.com.au/' . $retailer->CampaignLogoUri;
                    $retailerDB->name = $name;
                    $retailerDB->affiliate_network_id = 3;
                    $retailerDB->url = $retailer->TrackingLink;
                    $retailerDB->external_id = $externalId;
                    $retailerDB->active = 0;
                    $retailerDB->checksum = $checksum;
                    $retailerDB->save();
                }
                $retailerId = $retailerDB->id;
                $retailerIds[$externalId] = $retailerId;
            }
            $nextPage = $retailers->{'@nextpageuri'};
            $retailers = $nextPage ? json_decode(file_get_contents($nextPage)) : null;
        } while (!empty($retailers));

        //Download Banners
        $url_start = 'https://IRkUox36xP4988106GZ34zqD4HrBqxTxC3:ZNnq3mKFvamsMjZ5KFSDpDRTbpimGRDf@api.impactradius.com';
        $promos = json_decode(file_get_contents($url_start . '/2010-09-01/Mediapartners/IRkUox36xP4988106GZ34zqD4HrBqxTxC3/PromoAds.json'));
        do {
            foreach ($promos->PromotionalAd as $promo) {
                //verify merchant
                $merchantId = $promo->CampaignId;
                if (array_key_exists($merchantId, $retailerIds)) {
                    $retailerId = $retailerIds[$merchantId];
                } else {
                    print 'skipping banner for unknown ext id: ' . $merchantId . "\n";
                    continue;
                }

                //check tpye of promotion
                $promoType = $promo->PromoType;
                if ($promoType == 'COUPONS') {
                    //Coupon, check code, ignore image, etc.
                    $this->importDgmCoupon($promo, $retailerId);
                } else if ($promo->AdSize) {
                    //If Valid Image in Ad, treat as banner
                    $this->importDgmBanners($promo, $retailerId);
                } else {
                    print "SKIPPING " . $promo->LinkText . " - NOT COUPON OR BANNER.\n;";
                }
            }
            $nextPage = $promos->{'@nextpageuri'};
            $promos = $nextPage ? json_decode(file_get_contents($url_start . $nextPage)) : null;
        } while (!empty($promos));
    }

    function importDgmBanners($banner, $retailerId) {

        $externalId = $banner->Id;
        $bannerDB = Banner::model()->find("external_id='$externalId'");
        if (!isset($bannerDB)) {
            $bannerDB = new Banner();
        }
        $bannerDB->retailer_id = $retailerId;
        $bannerDB->target_url = $banner->TrackingLink;
        $bannerDB->updated = date('Y-m-d H:i:s');
        if ($bannerDB->external_id != '' && $bannerDB->external_id != 0) {
            $bannerDB->created = date('Y-m-d H:i:s');
        }

        //get image url
        $matches = array();
        $match = preg_match('/img src="(http:\/\/[^"]*)/', str_replace("\n", '', $banner->AdHtml), $matches);
        if ($match) {
            $bannerDB->image_url = $matches[1];
        }

        //get size
        $sizeName = $banner->AdSize;
        $sizeDB = BannerSize::model()->find("name='$sizeName'");
        if (!isset($sizeDB)) {
            $sizeDB = new BannerSize();
        }
        $sizeParts = explode('x', $sizeName);
        $sizeDB->width = $sizeParts[0];
        $sizeDB->height = $sizeParts[1];

        //save image size
        $sizeDB->save();

        $bannerDB->banner_size_id = $sizeDB->id;

        //save banner
        $bannerDB->save();
    }

    function importDgmCoupon($coupon, $retailerId) {
        $externalId = $coupon->Id;
        $couponDB = AffiliateCoupon::model()->find("external_id='$externalId'");
        if (!isset($couponDB)) {
            $couponDB = new AffiliateCoupon();
            $couponDB->created = date('Y-m-d H:i:s');
        }
        $couponDB->updated = date('Y-m-d H:i:s');

        $couponDB->retailer_id = $retailerId;
        $couponDB->target_url = $coupon->TrackingLink;
        $couponDB->description = $coupon->LinkText;
        $couponDB->code = $coupon->PromoCode;
        $date = new DateTime($coupon->StartDate);
        $couponDB->start_date = $date->format('Y-m-d H:i:s');
        $date = new DateTime($coupon->EndDate);
        $couponDB->end_date = $date->format('Y-m-d H:i:s');
        $couponDB->save();
    }

    public function manageRetailerCategories($retailerId, $keyowrd) {
        $retailerMachingCategories = RetailerCategory::model()->findAll('keywords like "%' . $keyowrd . '%"');
        foreach ($retailerMachingCategories as $category) {
            $association = new RetailerCategoryAssociation();
            $association->retailer_id = $retailerId;
            $association->category_id = $category->id;
            $association->save();
        }
    }

    public function importCFBanners($retailerIds) {
        //Download Banners
        $banners = json_decode(file_get_contents('https://api.commissionfactory.com.au/V1/Affiliate/Banners?apiKey=62a4da25a7294aa190afccd3414f8d20&contentType=application/JSON'));
        foreach ($banners as $banner) {
            $merchantId = $banner->MerchantId;
            if (array_key_exists($merchantId, $retailerIds)) {
                $retailerId = $retailerIds[$merchantId];
            } else {
                print 'skipping banner for unknown ext id: ' . $merchantId . "\n";
                continue;
            }
            $externalId = $banner->Id;
            $updated = $banner->DateModified;

            $bannerDB = Banner::model()->find("external_id='$externalId'");
            if (!isset($bannerDB)) {
                $bannerDB = new Banner();
            }
            $updatedDB = $bannerDB->updated;
            if ($updatedDB && (strtotime($updatedDB) >= strtotime($updated))) {
                print "Skipping Banner " . $banner->MerchantName . ': ' . $banner->Name . ' (already seen)' . "\n";
                continue;
            }

            print "Processing Banner " . $banner->MerchantName . ': ' . $banner->Name . "\n";

            $bannerDB->created = $banner->DateCreated;
            $bannerDB->retailer_id = $retailerId;
            $bannerDB->target_url = $banner->TrackingUrl;
            $bannerDB->image_url = $banner->ImageUrl;

            //get Size
            $sizeDB = BannerSize::model()->find("name='" . $banner->Size . "'");
            if (!isset($sizeDB)) {
                $sizeDB = new BannerSize();
            }
            $sizeDB->width = $banner->Width;
            $sizeDB->height = $banner->Height;
            $sizeDB->save();

            $bannerDB->banner_size_id = $sizeDB->id;
            $bannerDB->save();
            print_r($bannerDB->errors);
        }
    }

    public function importCFCoupons($retailerIds) {
        //Download Coupons
        $coupons = json_decode(file_get_contents('https://api.commissionfactory.com.au/V1/Affiliate/Coupons?apiKey=62a4da25a7294aa190afccd3414f8d20&contentType=application/JSON'));
        foreach ($coupons as $coupon) {
            $merchantId = $coupon->MerchantId;
            if (array_key_exists($merchantId, $retailerIds)) {
                $retailerId = $retailerIds[$merchantId];
            } else {
                print 'skipping coupon for unknown ext id: ' . $merchantId . "\n";
                continue;
            }

            $externalId = $coupon->Id;
            $updated = $coupon->DateModified;

            $couponDB = AffiliateCoupon::model()->find("external_id='$externalId'");
            if (!isset($couponDB)) {
                $couponDB = new AffiliateCoupon();
                $couponDB->created = $coupon->DateCreated;
            }

            $updatedDB = $couponDB->updated;
            if ($updatedDB && (strtotime($updatedDB) >= strtotime($updated))) {
                print "Skipping Coupon " . $coupon->MerchantName . ': ' . $coupon->Description . ' (already seen)' . "\n";
                continue;
            }
            print "Processing Coupon " . $coupon->MerchantName . ': ' . $coupon->Description . "\n";

            $couponDB->updated = $updated;
            $couponDB->retailer_id = $retailerId;
            $couponDB->target_url = $coupon->TrackingUrl;
            $couponDB->description = $coupon->Description;
            $couponDB->code = $coupon->Code;
            $couponDB->start_date = $coupon->StartDate;
            $couponDB->end_date = $coupon->EndDate;

            $couponDB->save();
        }
    }

    public function importLinkShareBanners($client,$retailerIds) {
        //Download Banners
        $pageNo = 1;
        $result = $client->getBannerLinks(array('token' => '004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9', 'page' => '1'));
        $banners = $result->return;
        do {
            foreach ($banners as $banner) {

                $merchantID = $banner->mid;
                if (array_key_exists($merchantID, $retailerIds)) {
                    $retailerID = $retailerIds[$merchantID];
                } else {
                    print 'skipping banner for unknown ext id: ' . $merchantID . "\n";
                    continue;
                }

                $externalId = $banner->linkID;
                $bannerDB = Banner::model()->find("external_id='$externalId'");
                if (!isset($bannerDB)) {
                    $bannerDB = new Banner();
                }
                print "Processing Banner " . $retailerID . ': ' . $banner->linkName . "\n";

                $bannerDB->updated = date('Y-m-d H:i:s');
                if (!$createdDB->created) {
                    $bannerDB->created = date('Y-m-d H:i:s');
                }

                $bannerDB->retailer_id = $retailerID;
                $bannerDB->target_url = $banner->clickURL;
                $bannerDB->image_url = $banner->imgURL;

                //get Size
                $sizeExtID = $banner->size;
                print "GETTING SIZE $sizeExtID";
                //get Size
                $sizeDB = BannerSize::model()->find("name='$sizeName'");
                if (!isset($sizeDB)) {
                    $sizeDB = new BannerSize();
                }
                $bannerDB->banner_size_id = $sizeDB->external_id;
                $bannerDB->save();
                print_r($bannerDB->errors);
                die();
            }
            $result = $client->getBannerLinks(array('token' => '004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9', 'page' => ++$pageNo));
            $banners = isset($result->return) ? $result->return : null;
        } while (!empty($banners));
    }

    public function importLinkShareCoupon($client,$retailerIds) {
        //Download Coupons
        $pageNo = 1;
        $coupons = file_get_contents('http://couponfeed.linksynergy.com/coupon?token=004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9&resultsperpage=500');
        $couponXML = new SimpleXMLElement($coupons);
        $pageCount = $couponXML->TotalPages;
        do {
            foreach ($couponXML->link as $coupon) {
                $merchantID = $coupon->advertiserid . '';
                if (array_key_exists($merchantID, $retailerIds)) {
                    $retailerID = $retailerIds[$merchantID];
                } else {
                    continue;
                }

                $externalId = $coupon->couponcode;
                if (!$externalId) {
                    continue;
                }
                $externalId .= '_' . $merchantID;

                $couponDB = AffiliateCoupon::model()->find("external_id='$externalId'");
                if (!isset($couponDB)) {
                    $couponDB = new AffiliateCoupon();
                    $couponDB->created = date('Y-m-d H:i:s');
                }

                $couponDB->updated = date('Y-m-d H:i:s');
                $couponDB->retailer_id = $retailerID;
                $couponDB->target_url = $coupon->clickurl;
                $couponDB->description = $coupon->offerdescription . ' ' . $coupon->couponrestriction;
                $couponDB->code = $coupon->couponcode;
                $couponDB->start_date = $coupon->offerstartdate;
                $couponDB->end_date = $coupon->offerenddate;

                $couponDB->save();
                print_r($couponDB->errors);
                die();
            }
            if ($pageNo++ == $pageCount) {
                break;
            } else {
                $coupons = json_decode(file_get_contents('http://couponfeed.linksynergy.com/coupon?token=004fdfcbd783c723a20436a65dab14dcd57c6094a9db8cb400bb866fd778e1a9&resultsperpage=500&page_number=' . $pageNo));
            }
        } while ($pageNo <= $pageCount);
    }

}
