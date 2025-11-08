<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
date_default_timezone_set('Asia/Kolkata');
class KYCModel extends CI_model
{
    public function get_KYC_data()
    {
        $this->load->database();
        $param=$this->input->post();
        $this->db->where("id", $param['id']);
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('kyc');
        $this->db->last_query();
        $data=$q->result_array();
        $i=1;
        ?>
        <div class="col-12 pull-left">
            <div class=" col-12 pull-left pt-1 pb-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                <div class="text-center fs-4 text-black fw-bold mb-1">Corporate Details
                    <div class="pull-right pe-1 edit_customer fs-6" data-bs-target="#kyc_form" data-bs-toggle="modal" onclick="set_id('','#kyc_form input[type=text]'),set_id('','#kyc_form textarea'),set_id('<?php echo $data[0]['id'] ?>','#kyc_form .id'),get_kyc_form_data('<?php echo $data[0]['id'] ?>','kyc')">
                        <button type="button" class="btn btn-primary btn-block btn-sm"><ion-icon name="create-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon> Edit</button>                                
                    </div>
                    <div class="pull-right pe-1 fs-6" onclick="save_pdf('<?php echo $data[0]['id'] ?>')">
                        <button type="button" class="btn btn-primary btn-block btn-sm"><ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon> <span class="download-btn">Download</span></button>                                
                    </div>
                </div>
                <div class="pull-left br8 w-100 font-blue border-blue overflow-hidden ">
                    <div class="col-12 pull-left text-left blue-back bold p-0 d-flex">
                        <div class="col-1 pull-left border-right" style="min-height: 21px;">
                            Date
                        </div>
                        <div class="col-2 pull-left border-right">
                            Corporate Name
                        </div>
                        <div class="col-1 pull-left border-right">
                            Type
                        </div>
                        <div class="col-2 pull-left border-right">
                            Address
                        </div>
                        <div class="col-2 pull-left border-right">
                            Email
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            Contact
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            GST No.
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            Nature of Business
                        </div>
                        <div class="col-1 pull-left text-left">
                            Yr / Month of Establishment
                        </div>
                    </div>
                    <div class="col-12 d-flex text-left pull-left pull-left text-center border-top p-0">
                        <div class="col-1 pull-left border-right" style="min-height: 21px;">
                            <?php echo $data[0]['datetime']?>
                        </div>
                        <div class="col-2 pull-left border-right">
                            <?php echo $data[0]['corporate_name']?>
                        </div>
                        <div class="col-1 pull-left border-right">
                        <?php echo $data[0]['corporate_type']?>
                        </div>
                        <div class="col-2 pull-left border-right">
                        <?php echo $data[0]['corporate_address']?>
                        </div>
                        <div class="col-2 pull-left border-right word-break">
                        <?php echo $data[0]['corporate_email']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break">
                        <?php echo $data[0]['corporate_phone']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break" onmouseover="show_tooltip(event,'<?php echo $data[0]['corporate_gst']?>')" onmouseout="hide_tooltip(event)">
                        <?php echo $data[0]['corporate_gst']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break" onmouseover="show_tooltip(event,'<?php echo $data[0]['nature_of_business']?>')" onmouseout="hide_tooltip(event)">
                        <?php echo $data[0]['nature_of_business']?>
                        </div>
                        <div class="col-1 pull-left text-left word-break">
                        <?php echo $data[0]['corporate_establishment']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                    Particulars of owner                            
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_name']?></div>
                        </div>
                        <div class="col-12 p-0 pull-left">
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Designation :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_designation']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Address :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_address']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Email :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_email']?></div>
                            </div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Contact :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_phone']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-0 pull-left border-blue blue-back br8 mt-1">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                    Confirm and declare
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Verified By :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['confirm_name']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Designation :</div>
                            <div class="col-9 p-0 pull-left font-blue"><?php echo $data[0]['confirm_designation']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Remark :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['remark']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                    Person in Account Department
                </div>
                <div class="col-12 pull-left " >
                    <div class=" col-12 pull-left pt-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['accountant_name']?></div>
                        </div>
                        <div class="col-12 p-0 pull-left">
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Designation :</div>
                                <div class="col-9 p-0 pull-left font-blue"><?php echo $data[0]['accountant_designation']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Address :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['accountant_address']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Email :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['accountant_email']?></div>
                            </div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Contact :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['accountant_phone']?></div>
                        </div>
                    </div>
                    
                    <div class=" col-12 pull-left mt-3 mb-1 pt-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['name']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Designation :</div>
                            <div class="col-9 p-0 pull-left font-blue"><?php echo $data[0]['designation']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Address :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['address']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Email :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['email']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Contact :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['phone']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 mb-2 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                    Supporting Documents
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 pb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left p-0">
                            <span class="col-4 pull-left" <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['pan']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">PAN Card</button></span>
                            <span class="col-4 pull-left" <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['aadhar']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">Aadhar</button></span>
                            <span class="col-4 pull-left"  <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['gst']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">GST Certificate</button></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-0 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-1 fw-bold pb-1 fs-5 font-blue ">
                    Verified by Zest
                    <div class="pull-right pe-1 edit_customer fs-6" data-bs-target="#addCredit" data-bs-toggle="modal" onclick="set_id('','#addCredit input[type=text]'),set_id('','#addCredit textarea'),set_id('<?php echo $data[0]['id'] ?>','#addCredit .id')<?php if ($data[0]['verified'] == 'yes') {?>,get_credit_data('<?php echo $data[0]['id'] ?>')<?php }?>">
                        <ion-icon name="create-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon>
                        <span class="font-blue" style="font-size: 13px;">Edit </span>
                    </div>
                </div>
                <div class="col-12 mb-1 pull-left " >
                    <div class=" col-12 pull-left pt-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['verified_by']?></div>
                        </div>
                        <div class="col-12 p-0 pull-left">
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Designation :</div>
                                <div class="col-9 p-0 pull-left font-blue"><?php echo $data[0]['verified_designation']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Credit Limit :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['credit_limit']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Credit Period :</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['credit_period']?></div>
                            </div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Validity :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['verification_validity']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Note :</div>
                            <div class="col-9 text-ellipsis pull-left p-0 font-blue"><?php echo $data[0]['verification_note']?></div>
                        </div>
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class="col-3 pull-left p-0 font-red">Document :</div>
                            <div class="col-9 pull-left p-0 font-blue text-ellipsis pointer" onclick="javascript:window.open('<?php echo $data[0]['verification_document']?>')"><?php echo $data[0]['verification_document']?></div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
        
        <?php
        
    }
    public function get_agent_KYC_data()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("id", $param['id']);
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('agent');
        $this->db->last_query();
        $data=$q->result_array();
        $i=1;
        ?>
        <div class="col-12 pull-left">
            <div class=" col-12 pull-left pt-1 pb-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                <div class="text-center fs-4 text-black fw-bold mb-1">Corporate Details
                    <div class="pull-right pe-1 edit_customer fs-6" data-bs-target="#kyc_form" data-bs-toggle="modal" onclick="set_id('','#kyc_form input[type=text]'),set_id('','#kyc_form textarea'),set_id('<?php echo $data[0]['id'] ?>','#kyc_form .id'),get_kyc_form_data('<?php echo $data[0]['id'] ?>','agent')">
                        <button type="button" class="btn btn-primary btn-block btn-sm"><ion-icon name="create-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon> Edit</button>                                
                    </div>
                    <div class="pull-right pe-1 fs-6" onclick="save_pdf('<?php echo $data[0]['id'] ?>')">
                        <button type="button" class="btn btn-primary btn-block btn-sm"><ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon> <span class="download-btn">Download</span></button>                                
                    </div>
                </div>
                <div class="pull-left br8 w-100 font-blue border-blue overflow-hidden ">
                    <div class="col-12 pull-left text-left blue-back bold p-0 d-flex">
                        <div class="col-1 pull-left border-right" style="min-height: 21px;">
                            Date
                        </div>
                        <div class="col-2 pull-left border-right">
                            Name of the Company
                        </div>
                        <div class="col-1 pull-left border-right">
                            Address
                        </div>
                        <div class="col-2 pull-left border-right">
                            Partnership
                        </div>
						<div class="col-1 pull-left border-right">
                            Remark
                        </div>
                        <div class="col-1 pull-left border-right">
                            TAAI/TAFI
                        </div>
                        <div class="col-1 pull-left border-right">
                            Company Type
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            Office Tel. No
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            Office Fax Nos
                        </div>
                        <div class="col-1 pull-left text-left border-right">
                            Mobile Nos
                        </div>
                        <div class="col-1 pull-left text-left">
                            Email Address
                        </div>
                    </div>
                    <div class="col-12 d-flex text-left pull-left pull-left text-center border-top p-0">
                        <div class="col-1 pull-left border-right" style="min-height: 21px;">
                            <?php echo $data[0]['datetime']?>
                        </div>
                        <div class="col-2 pull-left border-right">
                            <?php echo $data[0]['company_name']?>
                        </div>
                        <div class="col-1 pull-left border-right">
                        <?php echo $data[0]['company_address']?>
                        </div>
                        <div class="col-2 pull-left border-right">
                            <?php echo $data[0]['company_partnership']?>
                        </div>
                        <div class="col-1 pull-left border-right word-break">
                        <?php echo $data[0]['membership_number']?>
                        </div>
                        <div class="col-1 pull-left border-right word-break">
                        <?php echo $data[0]['company_type']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break">
                        <?php echo $data[0]['office_number']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break" onmouseover="show_tooltip(event,'<?php echo $data[0]['office_phone']?>')" onmouseout="hide_tooltip(event)">
                        <?php echo $data[0]['office_phone']?>
                        </div>
                        <div class="col-1 pull-left text-left border-right word-break" onmouseover="show_tooltip(event,'<?php echo $data[0]['office_mobile']?>')" onmouseout="hide_tooltip(event)">
                        <?php echo $data[0]['office_mobile']?>
                        </div>
                        <div class="col-1 pull-left text-left word-break">
                        <?php echo $data[0]['office_email']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                        Owners/Director 1                                 
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Full Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_name']?></div>
                        </div>
                        <div class="col-12 p-0 pull-left">
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Address</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_address']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Mobile</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner_mobile']?></div>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                        Owners/Director 2                                 
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left border-blue-bot p-0">
                            <div class=" pull-left p-0 font-red col-3">Full Name :</div>
                            <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner2_name']?></div>
                        </div>
                        <div class="col-12 p-0 pull-left">
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Address</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner2_address']?></div>
                            </div>
                            <div class="col-12 pull-left border-blue-bot p-0">
                                <div class="col-3 pull-left p-0 font-red">Mobile</div>
                                <div class="col-9 pull-left p-0 font-blue"><?php echo $data[0]['owner2_mobile']?></div>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 mt-2 pull-left">
            <div class="col-12 p-0 mb-2 pull-left border-blue blue-back br8">
                <div class="col-12 pull-left text-center pt-2 fw-bold pb-2 fs-5 font-blue ">
                    Supporting Documents
                </div>
                <div class="col-12 pull-left">
                    <div class=" col-12 pull-left pt-1 mb-1 pb-1 border-blue font12 br8" style=" background: white; "> 
                        <div class="col-12 pull-left p-0">
                            <span class="col-4 pull-left" <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['pan']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">PAN Card</button></span>
                            <span class="col-4 pull-left" <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['aadhar']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">Aadhar</button></span>
                            <span class="col-4 pull-left"  <?php if ($data[0]['pan'] == '') {echo "disabled";}?> <?php if($data[0]['pan']!=''){?> onclick="javascript:window.open('<?php echo $data[0]['gst']?>')"<?php }?>><button type="button" class="btn btn-primary btn-block btn-sm">GST Certificate</button></span>
                        </div>
                    </div>
                </div>
            </div>                   
        </div>
        <?php
        
    }

  	public function strreplace($text)
    {
      $text=str_replace('amp;','&',$text);
      return $text=str_replace('plussss','+',$text);
    }
    public function get_KYC()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("verified", '');
        $q=$this->db->get('kyc');
        $data=$q->result_array();
        $i=1;
        
        foreach($data as $key=>$val)
        {
            ?>
            <div class="col-12 p-0 pull-left text-ellipsis border-top b-l-r Flex" style="background-color: #ebeefe;;" ondblclick="javascript:window.location.href='get_document.html?id=<?php echo $val['id']?>'">
                <div class="pull-left text-ellipsis Flex-item font-blue" style="width: 4%;padding-left: 8px;"><?php echo $i++ ?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 7%;"><?php echo $this->strreplace(date('d-m-Y',strtotime($val['datetime'])));?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 14%;"><?php echo $this->strreplace($val['corporate_name']);?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['corporate_gst'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" onmouseover="show_tooltip(event,'<?php echo $this->strreplace($val['corporate_address'])?>')" onmouseout="hide_tooltip(event)" style="width: 14%;"><?php echo $this->strreplace($val['corporate_address'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['owner_name'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['owner_designation'])?></div>
                <div class="col-2 pull-left text-ellipsis Flex-item font-blue" style="width: 10%;"><?php echo $this->strreplace($val['owner_phone'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue text-center" style="width: 12%;"><button data-bs-target="#addCredit" data-bs-toggle="modal" onclick="set_id('','#addCredit input[type=text]'),set_id('','#addCredit textarea'),set_id('<?php echo $val['id']?>','#addCredit .id')" type="button" class="btn btn-primary btn-sm me-1" style="height: 20px;margin-top: 2.5px;">Verify & add credit</button></div>                     
            </div>            
            <?php
        }
        
    }
    public function get_agent_KYC()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("verified", '');
        $q=$this->db->get('agent');
        $data=$q->result_array();
        $i=1;
        
        foreach($data as $key=>$val)
        {
            ?>
            <div class="col-12 p-0 pull-left text-ellipsis border-top b-l-r Flex" style="background-color: #ebeefe;;" ondblclick="javascript:window.location.href='get_document_agent.html?id=<?php echo $val['id']?>'">
                <div class="pull-left text-ellipsis Flex-item font-blue" style="width: 4%;padding-left: 8px;"><?php echo $i++ ?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 7%;"><?php echo $this->strreplace(date('d-m-Y',strtotime($val['datetime'])));?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 14%;"><?php echo $this->strreplace($val['company_name']);?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['company_address'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" onmouseover="show_tooltip(event,'<?php echo $this->strreplace($val['company_partnership'])?>')" onmouseout="hide_tooltip(event)" style="width: 14%;"><?php echo $this->strreplace($val['company_partnership'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['office_number'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['office_mobile'])?></div>
                <div class="col-2 pull-left text-ellipsis Flex-item font-blue" style="width: 10%;"><?php echo $this->strreplace($val['office_email'])?></div>                  
            </div>            
            <?php
        }
        
    }
    
    public function get_filter_KYC()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("verified", $param['verified']);
        if ($param['value'] != '') 
        {
            $this->db->where("(corporate_name LIKE '%" . $param['value'] . "%' escape '!' OR corporate_gst LIKE '%" . $param['value'] . "%' escape '!' OR corporate_address LIKE '%" . $param['value'] . "%' escape '!' OR owner_name LIKE '%" . $param['value'] . "%' escape '!' OR owner_designation LIKE '%" . $param['value'] . "%' escape '!' OR owner_phone LIKE '%" . $param['value'] . "%' escape '!')");
        }
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('kyc');
        $data=$q->result_array();
        $i=1;
        
        foreach($data as $key=>$val)
        {
            ?>
            <div class="col-12 p-0 pull-left text-ellipsis border-top b-l-r Flex" style="background-color: #ebeefe;" ondblclick="javascript:window.location.href='get_document.html?id=<?php echo $val['id']?>'">
                <div class="pull-left text-ellipsis Flex-item font-blue" style="width: 4%;padding-left: 8px;"><?php echo $i++ ?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 7%;"><?php echo $this->strreplace(date('d-m-Y',strtotime($val['datetime'])));?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 14%;"><?php echo $this->strreplace($val['corporate_name']);?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['corporate_gst'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" onmouseover="show_tooltip(event,'<?php echo $this->strreplace($val['corporate_address'])?>')" onmouseout="hide_tooltip(event)" style="width: 14%;"><?php echo $this->strreplace($val['corporate_address'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['owner_name'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['owner_designation'])?></div>
                <div class="col-2 pull-left text-ellipsis Flex-item font-blue" style="width: 10%;"><?php echo $this->strreplace($val['owner_phone'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue text-center" style="width: 12%;"><button data-bs-target="#addCredit" data-bs-toggle="modal" onclick="set_id('','#addCredit input[type=text]'),set_id('','#addCredit textarea'),set_id('<?php echo $val['id'] ?>','#addCredit .id')<?php if ($val['verified'] == 'yes') {?>,get_credit_data('<?php echo $val['id'] ?>')<?php }?>" type="button" class="btn btn-primary btn-sm me-1" style="height: 20px;margin-top: 2.5px;"><?php if ($val['verified'] == 'yes') {
                       echo "Edit Verification detail";
                   } else {
                       echo "Verify & add credit";
                   } ?></button></div>                     
            </div>            
            <?php
        }
        
    }
    public function get_filter_agent_KYC()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("verified", $param['verified']);
        if ($param['value'] != '') 
        {
            $this->db->where("(company_name LIKE '%" . $param['value'] . "%' escape '!' OR company_address LIKE '%" . $param['value'] . "%' escape '!' OR company_partnership LIKE '%" . $param['value'] . "%' escape '!' OR office_number LIKE '%" . $param['value'] . "%' escape '!' OR office_mobile LIKE '%" . $param['value'] . "%' escape '!' OR office_email LIKE '%" . $param['value'] . "%' escape '!')");
        }
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('agent');
        $data=$q->result_array();
        $i=1;
        
        foreach($data as $key=>$val)
        {
            ?>
            <div class="col-12 p-0 pull-left text-ellipsis border-top b-l-r Flex" style="background-color: #ebeefe;" ondblclick="javascript:window.location.href='get_document_agent.html?id=<?php echo $val['id']?>'">
                <div class="pull-left text-ellipsis Flex-item font-blue" style="width: 4%;padding-left: 8px;"><?php echo $i++ ?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 7%;"><?php echo $this->strreplace(date('d-m-Y',strtotime($val['datetime'])));?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 14%;"><?php echo $this->strreplace($val['company_name']);?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['company_address'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" onmouseover="show_tooltip(event,'<?php echo $this->strreplace($val['company_partnership'])?>')" onmouseout="hide_tooltip(event)" style="width: 14%;"><?php echo $this->strreplace($val['company_partnership'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['office_number'])?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 13%;"><?php echo $this->strreplace($val['office_mobile'])?></div>
                <div class="col-2 pull-left text-ellipsis Flex-item font-blue" style="width: 10%;"><?php echo $this->strreplace($val['office_email'])?></div>
                </button></div>                     
            </div>            
            <?php
        }
        
    }
    
    public function addKYC()
    {
        $param=$this->input->post();
        $this->load->database();
        if($param['pan']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['pan']);
            $param['pan']=$this->Upload->upload_image($pdf,rand(0,1000000).'_pan');
        }
        if($param['aadhar']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['aadhar']);
            $param['aadhar']=$this->Upload->upload_image($pdf,rand(0,1000000).'_aadhar');
        }
        if($param['gst']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['gst']);
            $param['gst']=$this->Upload->upload_image($pdf,rand(0,1000000).'_gst');
        }
        $param['datetime'] = date('Y-m-d H:i');
        
        $q=$this->db->insert('kyc',$param);    
        
        $this->db->where("type","corporate");
        $this->db->where("token",$param['token']);
        $q=$this->db->get('token');
        $data=$q->result_array();
        
        $this->db->where("id",$data[0]['id']);
        $q=$this->db->update('token',array('used'=>'yes'));    
        
        if($q)
        {
            echo "ok";
        }    
    }
    public function addagentKYC()
    {
        $param=$this->input->post();
        $this->load->database();
        if($param['pan']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['pan']);
            $param['pan']=$this->Upload->upload_image($pdf,rand(0,1000000).'a_pan');
        }
        if($param['aadhar']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['aadhar']);
            $param['aadhar']=$this->Upload->upload_image($pdf,rand(0,1000000).'a_aadhar');
        }
        if($param['gst']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['gst']);
            $param['gst']=$this->Upload->upload_image($pdf,rand(0,1000000).'a_gst');
        }
        $param['datetime'] = date('Y-m-d H:i');
        
        $q=$this->db->insert('agent',$param);    
        $this->db->where("type","agent");
        $this->db->where("token",$param['token']);
        $q=$this->db->get('token');
        $data=$q->result_array();
        
        $this->db->where("id",$data[0]['id']);
        $q=$this->db->update('token',array('used'=>'yes'));    
        
        if($q)
        {
            echo "ok";
        }    
    }
    
    public function updateKYC()
    {
        $param=$this->input->post();
        $this->load->database();
        $params = array();
        $table=$param['table'];
        unset($param['table']);
        if($param['pan']!='')
        {
            if (strpos($param['pan'], ";base64,") !== false) {
                $this->load->model('Upload');
                $pdf = str_replace('plusssss', '+', $param['pan']);
                $params['pan'] = $this->Upload->upload_image($pdf, rand(0, 1000000) . '_pan');
                $this->db->where('id', $param['id']);
                $q = $this->db->update($table, $params);
                unset($param['pan']);
            }
        }
        if($param['aadhar']!='')
        {
            if (strpos($param['aadhar'], ";base64,") !== false) {
                $this->load->model('Upload');
                $pdf = str_replace('plusssss', '+', $param['aadhar']);
                $params['aadhar'] = $this->Upload->upload_image($pdf, rand(0, 1000000) . '_aadhar');
                $this->db->where('id', $param['id']);
                $q = $this->db->update($table, $params);
                unset($param['aadhar']);
            }
        }
        if($param['gst']!='')
        {
            if (strpos($param['gst'], ";base64,") !== false) {
                $this->load->model('Upload');
                $pdf = str_replace('plusssss', '+', $param['gst']);
                $params['gst'] = $this->Upload->upload_image($pdf, rand(0, 1000000) . '_gst');
                $this->db->where('id', $param['id']);
                $q = $this->db->update($table, $params);
                unset($param['gst']);
            }
        }        
        $this->db->where('id', $param['id']);
        $q = $this->db->update($table, $param);
                
        if($q)
        {
            echo "ok";
        }    
    }
    public function addCredit()
    {
        $param=$this->input->post();
        if($param['verification_validity']!='')
        {
            $param['verification_validity']=date('Y-m-d',strtotime($param['verification_validity']));
        }
      	$this->load->database();
        $this->db->where('id', $param['id']);
        if($param['verification_document']!='')
        {
            $this->load->model('Upload');
            $pdf=str_replace('plusssss','+',$param['verification_document']);
            $param['verification_document']=$this->Upload->upload_image($pdf,rand(0,1000000).'_verification_document');
        }
        $param['verified'] = 'yes';
        $q=$this->db->update('kyc',$param);    
        if($q)
        {
            echo "ok";
        }    
    }
    public function get_credit_data()
    {
        $param=$this->input->post();
        $this->load->database();
        $this->db->where('id', $param['id']);
        $q=$this->db->get('kyc');
        //$this->db->last_query();        
        $data=$q->result_array();
        echo json_encode($data);
    }

    public function get_kyc_form_data()
    {
        $param=$this->input->post();
        $this->load->database();
        $this->db->where('id', $param['id']);
        $q=$this->db->get($param['table']);
        //$this->db->last_query();        
        $data=$q->result_array();
        echo json_encode($data);
    }
    function create_pdf()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("id", $param['id']);
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('kyc');
        $this->db->last_query();
        $data=$q->result_array();
        

        include APPPATH."third_party/tcpdf/config/tcpdf_include.php";
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) ); 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Zest KYC');
        $pdf->SetFont('freeserif', '', 10, '', true); 
        $pdf->AddPage();
        $corporate_name=$data[0]['corporate_name'];
        $corporate_type=$data[0]['corporate_type'];
$html= <<<EOD
<style>
@font-face{font-family:'Montserrat';src:url(../fonts/Montserrat-Regular.ttf) format('truetype')}
@font-face{font-family:'Montserrat500';src:url(../fonts/Montserrat-SemiBold.ttf) format('truetype')}
.Montserrat{font-family: 'Montserrat';}

.border{border:1px solid #000;}
.b-l{border-left:1px solid #000;}
.b-r{border-right:1px solid #000;}
.b-t{border-top:1px solid #000;}
.b-b{border-bottom:1px solid #000;}
.text-right{text-align:right;}
.text-center{text-align:center;}
.bold{font-weight:bold}
.f-30{font-size:30px}
.f-16{font-size:16px}
.f-18{font-size:18px}
.f-22{font-size:22px}
.m-t-10{margin-top:10px}
.w-100 {
    width: 100%!important;
}
.bgm-black {
    background-color: #000!important;
}
.c-white {
    color: #fff!important;
}
.p-10 {
    padding: 10px!important;
}
.pull-left {
    float: left!important;
}
</style><br><br><br><br><br><br>
<table cellpadding="6">
    <tr>
		<td colspan="2" class="text-center Montserrat bold" style="font-size:16px;line-height:30px">{$corporate_name}</td>
	</tr>
</table>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Corporate Details</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Type</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$corporate_type}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['corporate_address']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Email</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['corporate_email']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Contact</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['corporate_phone']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">GST No</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['corporate_gst']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Nature of Business</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['nature_of_business']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Yr / Month of Establishment</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['corporate_establishment']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Particulars of owner</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Name</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_name']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Designation</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_designation']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_address']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Email</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_email']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Contact</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_phone']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Person in Account Department</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Name</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['accountant_name']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Designation</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['accountant_designation']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['accountant_address']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Email</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['accountant_email']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Contact</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['accountant_phone']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Name</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['name']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Designation</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['designation']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['address']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Email</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['email']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Contact</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['phone']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Supporting Documents</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">PAN Card</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['pan']}">{$data[0]['pan']}</a></td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Aadhar Card</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['aadhar']}">{$data[0]['aadhar']}</a></td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">GST Certificate</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['gst']}">{$data[0]['gst']}</a></td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Verified by Zest</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Name</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['verified_by']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Designation</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['verified_designation']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Credit Limit</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['credit_limit']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Credit Period</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['credit_period']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Validity</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['verification_validity']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Note</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['verification_note']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Document</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['verification_document']}">{$data[0]['verification_document']}</a></td>
    </tr>
</table>
EOD;
$pdf->writeHTML($html, true, false, true, false, '');
if(file_exists(BASEPATH.'pdf/KYC'.$param['id'].'.pdf'))
    unlink(BASEPATH.'pdf/KYC'.$param['id'].'.pdf');
$pdf->Output(BASEPATH.'pdf/KYC'.$param['id'].'.pdf', 'F');
    
            

    }
    function download_pdf()
    {
        $param = $this->input->get();
        $this->load->database();
        $file_name= BASEPATH.'pdf/KYC'.$param['id'].'.pdf';
        $this->db->where("id", $param['id']);
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('kyc');
        $data=$q->result_array();
        $corporate_name=$data[0]['corporate_name'];
        if($file_name) 
        {
            $fsize = filesize($file_name);
            $path_parts = pathinfo($file_name);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                    header("Content-type: application/pdf"); // add here more headers for diff. extensions
                    header("Content-Disposition:attachment; filename=\"".$corporate_name.".pdf\"");
                    break;                    
                }
                if($fsize) {//checking if file size exist
                  header("Content-length: $fsize");
                };
                readfile($file_name);
                exit;
            //  unlink('pdf/'.$vendor_id.'.pdf');
            
             }
    }
    function create_agent_pdf()
    {
        $this->load->database();
        $param=$this->input->get();
        $this->db->where("id", $param['id']);
        $this->db->order_by("datetime","DESC");
        $q=$this->db->get('agent');
        $this->db->last_query();
        $data=$q->result_array();
        

        include APPPATH."third_party/tcpdf/config/tcpdf_include.php";
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) ); 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Zest KYC');
        $pdf->SetFont('freeserif', '', 10, '', true); 
        $pdf->AddPage();
        $corporate_name=$data[0]['corporate_name'];
        $corporate_type=$data[0]['corporate_type'];
$html= <<<EOD
<style>
@font-face{font-family:'Montserrat';src:url(../fonts/Montserrat-Regular.ttf) format('truetype')}
@font-face{font-family:'Montserrat500';src:url(../fonts/Montserrat-SemiBold.ttf) format('truetype')}
.Montserrat{font-family: 'Montserrat';}

.border{border:1px solid #000;}
.b-l{border-left:1px solid #000;}
.b-r{border-right:1px solid #000;}
.b-t{border-top:1px solid #000;}
.b-b{border-bottom:1px solid #000;}
.text-right{text-align:right;}
.text-center{text-align:center;}
.bold{font-weight:bold}
.f-30{font-size:30px}
.f-16{font-size:16px}
.f-18{font-size:18px}
.f-22{font-size:22px}
.m-t-10{margin-top:10px}
.w-100 {
    width: 100%!important;
}
.bgm-black {
    background-color: #000!important;
}
.c-white {
    color: #fff!important;
}
.p-10 {
    padding: 10px!important;
}
.pull-left {
    float: left!important;
}
</style><br><br><br><br><br><br>
<table cellpadding="6">
    <tr>
		<td colspan="2" class="text-center Montserrat bold" style="font-size:16px;line-height:30px">{$corporate_name}</td>
	</tr>
</table>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Corporate Details</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Type</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$corporate_type}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['company_address']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Proprietorship/Partnership/Pvt.Ltd.Co</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['company_partnership']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">TAAI/TAFI Membership Number</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['membership_number']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Office Tel. No</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['office_number']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Office Fax Nos</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['office_phone']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Mobile Nos</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['office_mobile']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Email Address</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['office_email']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Company Type</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['company_type']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Owners/Director 1</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Full Name of Owners/Director</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_name']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Tel No</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_number']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Mobile</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner_mobile']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Owners/Director 2</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Full Name of Owners/Director</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner2_name']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Tel No</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner2_number']}</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Mobile</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat">{$data[0]['owner2_mobile']}</td>
    </tr>
</table><br><br>
<table cellpadding="6">    
    <tr>
        <td colspan="2" class="text-left Montserrat bold" style="font-size:16px;line-height:30px">Supporting Documents</td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">PAN Card</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['pan']}">{$data[0]['pan']}</a></td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">Aadhar Card</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['aadhar']}">{$data[0]['aadhar']}</a></td>
    </tr>
    <tr>
        <td style="width:30%;font-weight:bold;color:#283477;border-bottom: 1px solid #000;" class="text-left Montserrat">GST Certificate</td>
        <td style="width:70%;font-weight:bold;border-bottom: 1px solid #000;" class="text-left Montserrat"><a href="{$data[0]['gst']}">{$data[0]['gst']}</a></td>
    </tr>
</table>
EOD;
$pdf->writeHTML($html, true, false, true, false, '');
if(file_exists(BASEPATH.'pdf/KYC'.$param['id'].'.pdf'))
    unlink(BASEPATH.'pdf/KYC'.$param['id'].'.pdf');
$pdf->Output(BASEPATH.'pdf/KYC'.$param['id'].'.pdf', 'F');
    
            

    }
public function create_token()
{
    $param=$this->input->post();
    $this->load->database();
    $param['datetime']=date('Y-m-d H:i:s');
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < 50; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    if($param['id']=='')
    {
        $param['token']=$randomString;
        unset($param['id']);
        $q=$this->db->insert('token',$param);
        $data=array();
        if($q)
        {
            $data['success']='true';
            $data['token']=$randomString;
        }
    }
    else
    {
        $this->db->where("id",$param['id']);
        unset($param['type']);
        unset($param['id']);
        $q=$this->db->update('token',$param);
        $data=array();
        if($q)
        {
            $data['success']='true';
        }
    }
    echo json_encode($data);
}
    function validateToken()
    {
        $param=$this->input->post();
        $this->load->database();
        
        $this->db->where("token",$param['token']);
        $q=$this->db->get('token');
        $data=$q->result_array();
        if(count($data)>0)
        {
            if($data[0]['used']=='yes')
            {
                echo "Token is already in use";
            }
            else
            {
                echo "ok";
            }
        }
        else
        {
            echo "Token is Invalid";
        }
    }    
    
 function get_token_list()
    {
        $param=$this->input->post();
        $this->load->database();
        
        $q=$this->db->get('token');
        $data=$q->result_array();      
        $i=1;
        foreach($data as $key=>$value)  
        {
            $type='';
            if($value['type']=='agent')
            {
                $type=$value['type'].".html";
            }
            $link="http://localhost/kyc_files/".$type."?token=".$value['token'];
            ?>
            <div class="col-12 p-0 pull-left text-ellipsis border-top b-l-r Flex" style="background-color: #ebeefe;;">
                <div class="col-1 pull-left Flex-item font-blue" style="width: 4%;"><?php echo $i++?></div>
                <div class="col-1 pull-left Flex-item font-blue" style="width: 15%;"><?php echo date('Y-m-d h:i a',strtotime($value['datetime'])) ?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 25%;"><?php echo "http://localhost/kyc_files/".$type."?token=".$value['token']?></div>
                <div class="col-1 pull-left text-ellipsis Flex-item font-blue" style="width: 25%; cursor: pointer;" onclick="get_remark('<?php echo $value['id']?>','<?php echo addslashes($value['remark'])?>','<?php echo $value['type']?>')" data-bs-toggle="modal" data-bs-target="#createToken"><?php echo $value['remark']?> <svg xmlns="http://www.w3.org/2000/svg" width="20px" class="float-end" viewBox="0 0 512 512"><path d="M384 224v184a40 40 0 01-40 40H104a40 40 0 01-40-40V168a40 40 0 0140-40h167.48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M459.94 53.25a16.06 16.06 0 00-23.22-.56L424.35 65a8 8 0 000 11.31l11.34 11.32a8 8 0 0011.34 0l12.06-12c6.1-6.09 6.67-16.01.85-22.38zM399.34 90L218.82 270.2a9 9 0 00-2.31 3.93L208.16 299a3.91 3.91 0 004.86 4.86l24.85-8.35a9 9 0 003.93-2.31L422 112.66a9 9 0 000-12.66l-9.95-10a9 9 0 00-12.71 0z"/></svg></div>
                <div class="col-1 pull-left Flex-item font-blue" style="width: 10%;"><?php echo $value['type']?></div>                                    
                <div class="col-1 pull-left Flex-item font-blue" style="width: 10%;" onclick="copy_clipboard('<?php echo $link?>')"><svg width="20px" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><rect x="128" y="128" width="336" height="336" rx="57" ry="57" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M383.5 128l.5-24a56.16 56.16 0 00-56-56H112a64.19 64.19 0 00-64 64v216a56.16 56.16 0 0056 56h24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg> Copy Link</div>                                    
                <div class="col-1 pull-left Flex-item <?php if($value['used']=='yes'){echo "text-success";}else{echo "text-danger";}?>" style="width: 9%;"><?php if($value['used']=='yes'){echo "Form Filled";}else{echo "Pending";} ?></div>                                    
            </div>
            <?php
        }
    }
}

?>
