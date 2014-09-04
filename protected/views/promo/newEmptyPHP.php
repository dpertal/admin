<?php

class Default_Model_AggregatorMessageRequest extends Default_Model_Base {

    public function init() {
        parent::init('AggregatorMessageRequest');
    }

    private $rowsTotal;

    public function getMessages(Default_Model_Domain_MessageSearch $filter, $limit) {


        if ($filter->getCommunicationMethod() == 'MMS') {

            $MMSSql = $this->getMMSMessages($filter);
            $campaignMMSSql = $this->getMMSCampaignMessages($filter);

            $finalQuery = "
		select drive_table.*,drive_table_member.Card_Number as Member_Id  From  (
		 $campaignMMSSql
		UNION ALL $MMSSql
		 
		) drive_table 
                left outer join
                ( 
                  SELECT Card_Number, Phone_Number FROM CustomerRequest WHERE CampaignId = '{$filter->getCampaignId()}'
                   
                )drive_table_member
                on (drive_table.CommunicationId=drive_table_member.Phone_Number )
		";
        } else if ($filter->getCommunicationMethod() == 'SMS') {

            $aggregateSql = $this->getAggreegateMessages($filter);
            $campaignSql = $this->getCampaignMessages($filter);

            $finalQuery = "
                select drive_table.*,drive_table_member.Card_Number as Member_Id From  (
                $aggregateSql
                UNION ALL $campaignSql
 
                	
                ) drive_table
                left outer join
                ( 
                  SELECT Card_Number, Phone_Number FROM CustomerRequest WHERE CampaignId = '{$filter->getCampaignId()}'
                   
                )drive_table_member
                on (drive_table.CommunicationId=drive_table_member.Phone_Number )
                ";
        } else if ($filter->getCommunicationMethod() == 'Email') {

            $emailRequestSql = $this->getEmailRequestMessages($filter);
            $campaignEmail = $this->getCampaignEmailMessages($filter);

            $finalQuery = "
			                select drive_table.*,drive_table_member.Card_Number as Member_Id  From  (
							 $emailRequestSql
			                UNION ALL $campaignEmail
			 
			                ) drive_table 
                                        left outer join
                ( 
                  SELECT Card_Number, Phone_Number FROM CustomerRequest WHERE CampaignId = '{$filter->getCampaignId()}'
                   
                )drive_table_member
                on (drive_table.CommunicationId=drive_table_member.Phone_Number )
			                ";
        } else if ($filter->getCommunicationMethod() == 'All') {

            $aggregateSql = $this->getAggreegateMessages($filter);
            $campaignSql = $this->getCampaignMessages($filter);
            $emailRequestSql = $this->getEmailRequestMessages($filter);
            $campaignEmail = $this->getCampaignEmailMessages($filter);
            $MMSSql = $this->getMMSMessages($filter);
            $campaignMMSSql = $this->getMMSCampaignMessages($filter);

            echo $finalQuery = "
			                select drive_table.*,drive_table_member.Card_Number as Member_Id  From  (
			                $aggregateSql
			                UNION ALL $campaignSql
			                UNION ALL $emailRequestSql
			                UNION ALL $campaignEmail
			                UNION ALL $campaignMMSSql
			                UNION ALL $MMSSql
			 
			                ) drive_table
                                        left outer join
                                        ( 
                                            SELECT Card_Number, Phone_Number FROM CustomerRequest 
                                                WHERE CampaignId = '{$filter->getCampaignId()}'
                   
                                        )drive_table_member
                                        on (drive_table.CommunicationId=drive_table_member.Phone_Number )
                                         
			                ";
                                                die();
        }

        $finalQuery.=" ORDER BY drive_table.Effective_Date Desc";

        if ($limit != "") {
            $finalQuery.= $limit;
        }
        //echo $finalQuery;

        $result = parent::getAdapter()->query($finalQuery, array())->fetchAll(
                Zend_Db::FETCH_OBJ);
        $rowsTotal = count($result);


        $this->setRowsTotal($rowsTotal);


        return $result;
    }

    private function getAggreegateMessages(
    Default_Model_Domain_MessageSearch $filter) {

        $aggregateSql = "
		SELECT
		drive_aggregate.*
		FROM (SELECT
		request.Phone_Number         AS CommunicationId,
		request.Campaign_Id          AS CampaignId,
		request.Message_Text,
		request.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'Text'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		irf.Communication_Source_Code AS Communication_Source_Code,
		request.Interval_Description AS Interval_Type,
		request.Event_Detail AS eventTitle
		FROM AggregatorMessageRequest request
		INNER JOIN AggregatorMessageResponse response
		ON (response.Message_Req_No = request.Message_Req_No)		
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = request.MessageTypeId)
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.Error_Code
		INNER JOIN InstantRedemption irf
		ON (irf.Redemption_Id = request.Redemption_Id
		/*AND irf.Claim_Status = 0*/)
		WHERE request.Communication_Path='SMS') drive_aggregate
		WHERE drive_aggregate.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_aggregate.Effective_Date <= '{$filter->getToDate()} 23:59:59'		
		";

        if ($filter->getCampaignId() != "") {
            $aggregateSql.=" AND drive_aggregate.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $aggregateSql.=" AND drive_aggregate.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $aggregateSql.=" AND drive_aggregate.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $aggregateSql.=" AND drive_aggregate.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $aggregateSql.=" AND drive_aggregate.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            //$aggregateSql.=" AND drive_aggregate.Communication_Method = '{$filter->getCommunicationMethod()}' ";			
        }
        if ($filter->getMessageStatus() != "") {
            $aggregateSql.=" AND drive_aggregate.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $aggregateSql.=" AND drive_aggregate.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $aggregateSql.=" AND drive_aggregate.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $aggregateSql.=" AND drive_aggregate.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }



        return $aggregateSql;
    }

    private function getCampaignMessages(
    Default_Model_Domain_MessageSearch $filter) {

        $sql = "
		SELECT
		drive_campaign.*
		FROM (SELECT
		customerRequest.Phone_Number         AS CommunicationId,
		request.Campaign_Id          AS CampaignId,
		response.Message_Text,
		request.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'Text'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		customerRequest.Communication_Source_Code AS Communication_Source_Code,
		request.Interval_Description AS Interval_Type,
		request.Event_Detail AS eventTitle
		FROM CampaignMessageRequest request
		INNER JOIN CampaignMessageReqRes response
		ON (response.CMR_Seq_No = request.CMR_Seq_No)
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.Error_Code
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = request.Message_Type_Id)
		
		
		INNER JOIN CustomerRequest customerRequest
		ON (customerRequest.CR_Seq_No = request.CR_Seq_No
		)
		WHERE request.Communication_Path = 'SMS') drive_campaign
		WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'
	
	
		";


        if ($filter->getCampaignId() != "") {
            $sql.=" AND drive_campaign.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $sql.=" AND drive_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $sql.=" AND drive_campaign.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $sql.=" AND drive_campaign.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $sql.=" AND drive_campaign.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            //$sql.=" AND drive_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
        }
        if ($filter->getMessageStatus() != "") {
            $sql.=" AND drive_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $sql.=" AND drive_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $sql.=" AND drive_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $sql.=" AND drive_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }

        return $sql;
    }

    private function getMMSMessages(Default_Model_Domain_MessageSearch $filter) {


        $sql = "
		SELECT
		drive_aggregate.*
		FROM (SELECT
		request.Phone_Number         AS CommunicationId,
		request.Campaign_Id          AS CampaignId,
		request.Message_Text,
		request.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'Text'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		irf.Communication_Source_Code AS Communication_Source_Code,
		request.Interval_Description AS Interval_Type,
		request.Event_Detail AS eventTitle
		FROM AggregatorMessageRequest request
		INNER JOIN AggregatorMessageResponse response
		ON (response.Message_Req_No = request.Message_Req_No)
		
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = request.MessageTypeId)
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.Error_Code
		INNER JOIN InstantRedemption irf
		ON (irf.Redemption_Id = request.Redemption_Id
		/*AND irf.Claim_Status = 0*/)
		WHERE request.Communication_Path='MMS' ) drive_aggregate
		WHERE drive_aggregate.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_aggregate.Effective_Date <= '{$filter->getToDate()} 23:59:59'
		AND drive_aggregate.CampaignId = '{$filter->getCampaignId()}'
		UNION ALL
		SELECT
		drive_campaign.*
		FROM (SELECT
		customerRequest.Phone_Number         AS CommunicationId,
		rresponse.Campaign_Id          AS CampaignId,
		CONCAT('/RxCDI/mmstmpdir/',rresponse.Phone_Number,campMsgs.MMSImageName,'.',campMsgs.MMSImageType) AS Message_Text,
		request.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'MMS'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		customerRequest.Communication_Source_Code AS Communication_Source_Code,
		rresponse.Interval_Description AS Interval_Type,
		rresponse.Event_Detail AS eventTitle
		FROM MMSCampaignMessageRequestParsedData request
		INNER JOIN MMSCampaignMessageReqRes rresponse
		ON (rresponse.MMS_CMR_Seq_No = request.MMS_CMR_Seq_No)
		INNER JOIN MMSCampaignMessageResponseParsedData response
		ON (response.MMS_CMR_Seq_No = request.MMS_CMR_Seq_No)
		
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.CMRSPD_StatusCode
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = rresponse.Message_Type_Id)
		
		
		INNER JOIN CustomerRequest customerRequest
		ON (customerRequest.CR_Seq_No = rresponse.CR_Seq_No
		)
		INNER JOIN CampaignMessages campMsgs
    ON (campMsgs.CampaignId = rresponse.Campaign_Id
    AND campMsgs.FolderId = rresponse.Folder_Id
    AND campMsgs.MessageTypeId = rresponse.Message_Type_Id 
    ) WHERE campMsgs.Communication_Path = 'MMS' 
		) drive_campaign
		WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'
		
	
		";
        if ($filter->getCampaignId() != "") {
            $sql.=" AND drive_campaign.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $sql.=" AND drive_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $sql.=" AND drive_campaign.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $sql.=" AND drive_campaign.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $sql.=" AND drive_campaign.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            $sql.=" AND drive_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
        }
        if ($filter->getMessageStatus() != "") {
            $sql.=" AND drive_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $sql.=" AND drive_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $sql.=" AND drive_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $sql.=" AND drive_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }



        return $sql;
    }

    private function getMMSCampaignMessages(Default_Model_Domain_MessageSearch $filter) {

        $sql = "
				SELECT
		drive_campaign.*
		FROM (SELECT
		customerRequest.Phone_Number         AS CommunicationId,
		request.Campaign_Id          AS CampaignId,
		response.Message_Text,
		request.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'Text'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		customerRequest.Communication_Source_Code AS Communication_Source_Code,
		request.Interval_Description AS Interval_Type,
		request.Event_Detail AS eventTitle
		FROM CampaignMessageRequest request
		INNER JOIN CampaignMessageReqRes response
		ON (response.CMR_Seq_No = request.CMR_Seq_No)
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.Error_Code
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = request.Message_Type_Id)
		
		
		INNER JOIN CustomerRequest customerRequest
		ON (customerRequest.CR_Seq_No = request.CR_Seq_No
		)
		WHERE request.Communication_Path='MMS' ) drive_campaign
		WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'	
		AND drive_campaign.CampaignId='{$filter->getCampaignId()}'	
		UNION ALL
		SELECT
		drive_campaign.*
		FROM (
		SELECT
		rresponse.Phone_Number         AS CommunicationId,
		rresponse.Campaign_Id          AS CampaignId,
		CONCAT('/RxCDI/mmstmpdir/',rresponse.Phone_Number,campMsgs.MMSImageName,'.',campMsgs.MMSImageType) AS Message_Text,
		response.Effective_Date,
		GatewayCode.Code_Type   AS Response_Type,
		'MMS'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		irf.Communication_Source_Code AS Communication_Source_Code,
		rresponse.Interval_Description AS Interval_Type,
		rresponse.Event_Detail AS eventTitle
		FROM RxMMSRedemptionResponse response
		INNER JOIN RxMMSRedemptionReqRes rresponse
		ON (rresponse.MMS_Req_No = response.MMS_Req_No)
		INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.CMRSPD_StatusCode
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = rresponse.MessageTypeId)
		 INNER JOIN InstantRedemption irf
		ON (irf.Redemption_Id = rresponse.Redemption_Id		AND irf.Claim_Status = 0)
		INNER JOIN CampaignMessages campMsgs ON (campMsgs.CampaignId = rresponse.Campaign_Id AND campMsgs.FolderId=rresponse.FolderId AND campMsgs.MessageTypeId=rresponse.MessageTypeId
		AND campMsgs.Communication_Path = rresponse.Communication_Path)
		) drive_campaign
		WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'
	 	
	
		";
        if ($filter->getCampaignId() != "") {
            $sql.=" AND drive_campaign.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $sql.=" AND drive_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $sql.=" AND drive_campaign.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $sql.=" AND drive_campaign.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $sql.=" AND drive_campaign.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            $sql.=" AND drive_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
        }
        if ($filter->getMessageStatus() != "") {
            $sql.=" AND drive_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $sql.=" AND drive_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $sql.=" AND drive_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $sql.=" AND drive_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }


        return $sql;
    }

    private function getEmailRequestMessages(
    Default_Model_Domain_MessageSearch $filter) {
        $sql = "
		SELECT
		drive_email_request.*
		FROM (SELECT
		request.Email         AS CommunicationId,
		request.Campaign_Id          AS CampaignId,
		request.Email_Body AS Message_Text,
		request.Effective_Date,
		response.Email_Status   AS Response_Type,
		'Email'                       AS Communication_Method,
		messageType.MessageTypeTitle AS Message_Type,
		irf.Communication_Source_Code AS Communication_Source_Code,
		request.Interval_Description AS Interval_Type,
		request.Event_Detail AS eventTitle
		FROM EmailRequest request
		INNER JOIN EmailResponse response
		ON (response.Email_Req_No = request.Email_Req_No)
		
		INNER JOIN MessageType AS messageType
		ON (messageType.MessageTypeId = request.MessageTypeId)
		
		INNER JOIN InstantRedemption irf
		ON (irf.Redemption_Id = request.Redemption_Id
		/*AND irf.Claim_Status = 0*/)) drive_email_request
		WHERE drive_email_request.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
		AND drive_email_request.Effective_Date <= '{$filter->getToDate()} 23:59:59'
	
		";
        if ($filter->getCampaignId() != "") {
            $sql.=" AND drive_email_request.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $sql.=" AND drive_email_request.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $sql.=" AND drive_email_request.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $sql.=" AND drive_email_request.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $sql.=" AND drive_email_request.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            $sql.=" AND drive_email_request.Communication_Method = '{$filter->getCommunicationMethod()}' ";
        }
        if ($filter->getMessageStatus() != "") {
            $sql.=" AND drive_email_request.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $sql.=" AND drive_email_request.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $sql.=" AND drive_email_request.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $sql.=" AND drive_email_request.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }



        return $sql;
    }

    private function getCampaignEmailMessages(
    Default_Model_Domain_MessageSearch $filter) {
        $sql = "
			SELECT
			drive_email_campaign.*
			FROM (SELECT
			request.Email         AS CommunicationId,
			request.Campaign_Id          AS CampaignId,
			request.Email_Body AS Message_Text,
			request.Effective_Date,
			response.Email_Status  AS Response_Type,
			'Email'                       AS Communication_Method,
			messageType.MessageTypeTitle AS Message_Type,
			customerRequest.Communication_Source_Code AS Communication_Source_Code,
			request.Interval_Description AS Interval_Type,
			request.Event_Detail AS eventTitle
			FROM CampaignEmailRequest request
			INNER JOIN CampaignEmailResponse response
			ON (response.Email_Req_No = request.Email_Req_No)
			
			INNER JOIN MessageType AS messageType
			ON (messageType.MessageTypeId = request.Message_Type_Id)
			
			INNER JOIN EmailCustomerRequest customerRequest
			ON (customerRequest.ECR_Seq_No = request.ECR_Seq_No
			)) drive_email_campaign
			WHERE drive_email_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
			AND drive_email_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'
		
			";
        if ($filter->getCampaignId() != "") {
            $sql.=" AND drive_email_campaign.CampaignId = '{$filter->getCampaignId()}' ";
        }
        if ($filter->getCommunicationId() != "") {
            $sql.=" AND drive_email_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
        }
        if ($filter->getMessageType() != "") {
            $sql.=" AND drive_email_campaign.Message_Type = '{$filter->getMessageType()}' ";
        }
        if ($filter->getEvent() != "") {
            $sql.=" AND drive_email_campaign.eventTitle = '{$filter->getEvent()}' ";
        }
        if ($filter->getInterval() != "") {
            $sql.=" AND drive_email_campaign.Interval_Type = '{$filter->getInterval()}' ";
        }
        if ($filter->getCommunicationMethod() != "" && $filter->getCommunicationMethod() != "All") {
            $sql.=" AND drive_email_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
        }
        if ($filter->getMessageStatus() != "") {
            $sql.=" AND drive_email_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
        }
        if ($filter->getEffectiveDate() != "") {
            $sql.=" AND drive_email_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
            $sql.=" AND drive_email_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
        }
        if ($filter->getMessageSource() != "") {
            $sql.=" AND drive_email_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
        }
        return $sql;
    }

    /* 	private function getMMSMessages1(Default_Model_Domain_MessageSearch $filter)
      {

      $sql="

      SELECT
      drive_campaign.*
      FROM (SELECT
      customerRequest.Phone_Number         AS CommunicationId,
      rresponse.Campaign_Id          AS CampaignId,
      CONCAT('/RxCDI/mmstmpdir/',rresponse.Phone_Number,campMsgs.MMSImageName,'.',campMsgs.MMSImageType) AS Message_Text,
      request.Effective_Date,
      GatewayCode.Code_Type   AS Response_Type,
      'MMS'                       AS Communication_Method,
      messageType.MessageTypeTitle AS Message_Type,
      customerRequest.Communication_Source_Code AS Communication_Source_Code,
      rresponse.Interval_Description AS Interval_Type,
      rresponse.Event_Detail AS eventTitle
      FROM MMSCampaignMessageRequestParsedData request
      INNER JOIN MMSCampaignMessageReqRes rresponse
      ON (rresponse.MMS_CMR_Seq_No = request.MMS_CMR_Seq_No)
      INNER JOIN MMSCampaignMessageResponseParsedData response
      ON (response.MMS_CMR_Seq_No = request.MMS_CMR_Seq_No)

      INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.CMRSPD_StatusCode
      INNER JOIN MessageType AS messageType
      ON (messageType.MessageTypeId = rresponse.Message_Type_Id)


      INNER JOIN CustomerRequest customerRequest
      ON (customerRequest.CR_Seq_No = rresponse.CR_Seq_No
      )
      INNER JOIN CampaignMessages campMsgs
      ON (campMsgs.CampaignId = rresponse.Campaign_Id
      AND campMsgs.FolderId = rresponse.Folder_Id
      AND campMsgs.MessageTypeId = rresponse.Message_Type_Id
      ) WHERE campMsgs.Communication_Path = 'MMS'
      ) drive_campaign
      WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
      AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'


      ";
      if($filter->getCampaignId()!=""){
      $sql.=" AND drive_campaign.CampaignId = '{$filter->getCampaignId()}' ";
      }
      if($filter->getCommunicationId()!=""){
      $sql.=" AND drive_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
      }
      if($filter->getMessageType()!=""){
      $sql.=" AND drive_campaign.Message_Type = '{$filter->getMessageType()}' ";
      }
      if($filter->getEvent()!=""){
      $sql.=" AND drive_campaign.eventTitle = '{$filter->getEvent()}' ";
      }
      if($filter->getInterval()!=""){
      $sql.=" AND drive_campaign.Interval_Type = '{$filter->getInterval()}' ";
      }
      if($filter->getCommunicationMethod()!="" && $filter->getCommunicationMethod()!="All"){
      $sql.=" AND drive_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
      }
      if($filter->getMessageStatus()!=""){
      $sql.=" AND drive_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
      }
      if($filter->getEffectiveDate()!=""){
      $sql.=" AND drive_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
      $sql.=" AND drive_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
      }
      if($filter->getMessageSource()!=""){
      $sql.=" AND drive_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
      }


      return $sql;
      }

      private function getMMSCampaignMessages1(Default_Model_Domain_MessageSearch $filter)
      {


      $sql="

      SELECT
      drive_campaign.*
      FROM (
      SELECT
      rresponse.Phone_Number         AS CommunicationId,
      rresponse.Campaign_Id          AS CampaignId,
      CONCAT('/RxCDI/mmstmpdir/',rresponse.Phone_Number,campMsgs.MMSImageName,'.',campMsgs.MMSImageType) AS Message_Text,
      response.Effective_Date,
      GatewayCode.Code_Type   AS Response_Type,
      'MMS'                       AS Communication_Method,
      messageType.MessageTypeTitle AS Message_Type,
      irf.Communication_Source_Code AS Communication_Source_Code,
      rresponse.Interval_Description AS Interval_Type,
      rresponse.Event_Detail AS eventTitle
      FROM RxMMSRedemptionResponse response
      INNER JOIN RxMMSRedemptionReqRes rresponse
      ON (rresponse.MMS_Req_No = response.MMS_Req_No)
      INNER JOIN GatewayCode ON GatewayCode.Error_Code=response.CMRSPD_StatusCode
      INNER JOIN MessageType AS messageType
      ON (messageType.MessageTypeId = rresponse.MessageTypeId)
      INNER JOIN InstantRedemption irf
      ON (irf.Redemption_Id = rresponse.Redemption_Id		AND irf.Claim_Status = 0)
      INNER JOIN CampaignMessages campMsgs ON (campMsgs.CampaignId = rresponse.Campaign_Id AND campMsgs.FolderId=rresponse.FolderId AND campMsgs.MessageTypeId=rresponse.MessageTypeId
      AND campMsgs.Communication_Path = rresponse.Communication_Path)
      ) drive_campaign
      WHERE drive_campaign.Effective_Date >= '{$filter->getFromDate()} 00:00:00'
      AND drive_campaign.Effective_Date <= '{$filter->getToDate()} 23:59:59'


      ";
      if($filter->getCampaignId()!=""){
      $sql.=" AND drive_campaign.CampaignId = '{$filter->getCampaignId()}' ";
      }
      if($filter->getCommunicationId()!=""){
      $sql.=" AND drive_campaign.CommunicationId = '{$filter->getCommunicationId()}' ";
      }
      if($filter->getMessageType()!=""){
      $sql.=" AND drive_campaign.Message_Type = '{$filter->getMessageType()}' ";
      }
      if($filter->getEvent()!=""){
      $sql.=" AND drive_campaign.eventTitle = '{$filter->getEvent()}' ";
      }
      if($filter->getInterval()!=""){
      $sql.=" AND drive_campaign.Interval_Type = '{$filter->getInterval()}' ";
      }
      if($filter->getCommunicationMethod()!="" && $filter->getCommunicationMethod()!="All"){
      $sql.=" AND drive_campaign.Communication_Method = '{$filter->getCommunicationMethod()}' ";
      }
      if($filter->getMessageStatus()!=""){
      $sql.=" AND drive_campaign.Response_Type = '{$filter->getMessageStatus()}' ";
      }
      if($filter->getEffectiveDate()!=""){
      $sql.=" AND drive_campaign.Effective_Date >= '{$filter->getEffectiveDate()} 00:00:00' ";
      $sql.=" AND drive_campaign.Effective_Date <= '{$filter->getEffectiveDate()} 23:59:59' ";
      }
      if($filter->getMessageSource()!=""){
      $sql.=" AND drive_campaign.Communication_Source_Code = '{$filter->getMessageSource()}' ";
      }


      return $sql;
      } */

    /**
     *
     * @return the $rowsTotal
     */
    public function getRowsTotal() {
        return $this->rowsTotal;
    }

    /**
     *
     * @param number $rowsTotal
     */
    public function setRowsTotal($rowsTotal) {
        $this->rowsTotal = $rowsTotal;
    }

}

?>