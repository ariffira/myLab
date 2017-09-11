<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mopayone extends CI_Model {

  public static $mid = '27439';
  public static $portalid = '2019583';
  public static $aid = '27449';
  public static $key = 'SIN2fm6t8VilY4X9';


  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  public function post($msg, $type = 'elv')
  {
    // $post_data = array(
    //   'val[0]' => 'val1',
    //   'val[1]' => 'val2',
    //   'an_arr' => array(
    //     'attr' => 'stuff',
    //     'attr2' => 'stuff2',
    //   ),
    //   'anotehr_arr' => array(
    //     'stuff',
    //     'stuff2',
    //   ),
    // );

    // $response = http_post_fields(site_url('package/echopost'), $post_data);

    // var_dump($response);

    $package = $this->input->post('package');
    $package = $this->mopack->get_name($package);
    $payment = $msg->payment;

    $title              = $this->input->post('title');
    $gender             = $this->input->post('gender');
    $first_name         = $this->input->post('first_name');
    $last_name          = $this->input->post('last_name');
    $street             = $this->input->post('street');
    $street_additional  = $this->input->post('street_additional');
    $postal_code        = $this->input->post('postal_code');
    $locality           = $this->input->post('locality');
    $email              = $this->input->post('email');
    $telephone          = $this->input->post('telephone');

    $data = array(
      // Common
      'mid' => self::$mid,
      'portalid' => self::$portalid,
      'key' => md5(self::$key), 
      'mode' => 'test',
      'request' => 'authorization',
      'encoding' => 'UTF-8',

      // ---------
      // Request "authorization" 
      // ---------
      'aid' => self::$aid,
      // 'clearingtype' => 'elv',
      // 'clearingtype' => 'elv', // Debit payment
      // 'clearingtype' => 'cc', // Credit card
      // 'clearingtype' => 'rec', // Invoice
      // 'clearingtype' => 'cod', // Cash on delivery
      // 'clearingtype' => 'sb', // Online Bank Transfer
      // 'clearingtype' => 'wlt', // e-wallet
      // 'clearingtype' => 'fnc', // Financing
      'reference' => $ref = random_string('alnum', 20),
      'amount' => $package->price_cent, 
      'currency' => 'EUR',
    );

    $data = array_merge($data, array(
      // ---------
      // Parameter ( personal data ) 
      // ---------
      'customerid'      => $this->m->user_value('regid'), // - AN..20 Merchant's customer ID (Permitted symbols: 0-9, a-z, A-Z, .,-,_,/)
      'userid'          => $this->m->user_value('p1_userid'), // - N..12 Debtor ID (PAYONE)
      // 'salutation'      => '', // - AN..10 Title (e.g. "Mr", "Mrs", "company") 
      'title'           => $title, // - AN..20 Title (e.g. "Dr", "Prof.") 
      'firstname'       => $first_name, // o AN..50 First name (optional if company is used) (Mandatory for payment type KLV)
      'lastname'        => $last_name, // + AN..50 Surname 
      // 'company'         => '', // - AN..50 Company 
      'street'          => $street, // - AN..50 Street number and name (Mandatory for payment type KLV)
      'addressaddition' => $street_additional, // - AN..50 Address line 2 (e.g. "7th floor", "c/o Maier") (Mandatory for payment type KLV in NL)
      'zip'             => $postal_code, // - AN..10 Postcode (Mandatory for payment type KLV)
      'city'            => $locality, // - AN..50 City (Mandatory for payment type KLV)
      // 'state'           => '', // - Default State (ISO 3166-2 subdivisions) (only if country=US, CA, CN, JP, MX, BR, AR, ID, TH, IN)
      'country'         => 'DE', // + Default Country (ISO 3166) 
      'email'           => $this->m->user_value('email'), // - AN..50 Email address (Mandatory for payment type BSV, KLV)
      'telephonenumber' => $telephone, // - AN..30 Telephone number (Mandatory for payment type KLV)
      // 'birthday'        => '', // - N8 Date of birth (YYYYMMDD) (Mandatory for payment type KLV)
      // 'language'        => '', // - Default Language indicator (ISO 639)(Mandatory for payment type KLV , KLV supports sv, nb (norwegian), fi, da, de, nl)
      // 'vatid'           => '', // - AN..50 VAT identification number
      'gender'          => $gender == 1 ? 'f' : 'm', // - Default f=female, m=male(Mandatory for payment type KLV DE, NL, AT)
      // 'personalid'      => '', // - AN..32 Person specific numbers or characters - Mandatory for payment type KLV SE, FI, DK, NO Format: A-Z, a-z, 0-9, +-./()
      // 'ip'              => '', // - AN..15 Customer's IP-V4-address (123.123.123.123) (Mandatory for payment type KLV)

      // ---------
      // Parameter ( delivery data ) 
      // ---------
      'shipping_firstname' => $first_name, //- AN..50 First name 
      'shipping_lastname'  => $last_name, //- AN..50 Surname 
      // 'shipping_company'   => '', //- AN..50 Company 
      'shipping_street'    => $street, //- AN..50 Street number and name
      'shipping_zip'       => $street_additional, //- AN..10 Postcode 
      'shipping_city'      => $locality, //- AN..50 City 
      // 'shipping_state'     => '', //- Default State (ISO 3166-2 subdivisions) (only if country=US, CA, CN, JP, MX, BR, AR, ID, TH, IN)
      'shipping_country'   => 'DE', //- Default Country (ISO 3166)

      // ---------
      // Parameter ( debit payment )
      // ---------
      'clearingtype' => 'elv',
      // o - Account type/ country 
      // for use with BBAN: DE
      // mandatory with bankcode, bankaccount
      // optional with iban/bic 
      'bankcountry' => $this->input->post('bankcountry'),

      // o - Account number (BBAN)
      // DE only: IBAN/BIC can be calculated by PAYONE 
      // platform automatically given by 
      // bankcode/bankaccount
      'bankaccount' => $this->input->post('bankaccount'),

      // o - Sort code (BBAN) (only in DE)
      // DE only: IBAN/BIC can be calculated by PAYONE 
      // platform automatically given by bankcode/bankaccount (BBAN)
      'bankcode' => $this->input->post('bankcode'),

      // - - Account holder
      'bankaccountholder' => $this->input->post('bankaccountholder'),

      // o - International Bank Account Number
      // Only capital letters and digits, no spaces
      // If both (BBAN and IBAN) are submitted, IBAN is 
      // splitted into BBAN and processed. BBAN 
      // parameters are ignored.
      // Eg. DE89370400440532013000
      'iban' => $this->input->post('iban'),

      // o - Bank Identifier Code
      // Only capital letters and digits, no spaces
      'bic' => $this->input->post('bic'),

      // o - Can be used to enforce a merchant specific 
      // mandate identification. The 
      // mandate_identification has to be unique. Allowed 
      // characters: A-Z a-z 0-9 + - . ( )
      // If the mandate_identification is not set PAYONE 
      // will create an unique mandate identification.
      // PCS: This parameter must not be used!
      // 'mandate_identification' => $ref_mdt = random_string('alnum', 20),

      // ---------
      // Parameter ( online transfer )
      // ---------
      // 'clearingtype' => 'sb',
      // + Default
      // PNT Sofortbanking (DE, AT, CH, NL)
      // GPY giropay (DE)
      // EPS eps – online transfer (AT)
      // PFF PostFinance E-Finance (CH)
      // PFC PostFinance Card (CH)
      // IDL iDEAL (NL)
      // 'onlinebanktransfertype' => 'PNT',

      // o Default Account type/ country 
      // for use with BBAN: DE, AT, CH, NL
      // mandatory with bankcode, bankaccount
      // optional with iban/bic
      // 'bankcountry' => 'DE',

      // o AN..14 Account number (giropay & Sofortbanking only)
      // DE only: IBAN/BIC can be calculated by PAYONE
      // 'bankaccount' => 'DE89370400440532013000',

      // o N..8 Sort code (giropay & Sofortbanking only)
      // DE only: IBAN/BIC can be calculated by PAYONE
      // 'bankcode' => '',

      // o Default Bank Group (see chapter 5)
      // (eps & iDEAL only)
      // 'bankgrouptype' => '',

      // o AN..35 International Bank Account Number
      // Only capital letters and digits, no spaces
      // If both (BBAN and IBAN) are submitted, IBAN is 
      // splitted into BBAN and processed.
      // 'iban' => '',

      // o AN..11 Bank Identifier Code
      // Only capital letters and digits, no spaces
      // 'bic' => '',

      // 'successurl' => '', // o AN..255 URL "payment successful"
      // 'errorurl' => '', // o AN..255 URL "faulty payment"
      // 'backurl' => '', // o AN..255 URL "Back" or "Cancel"

      // ---------
      // Parameter ( e-wallet )
      // ---------
      // 'clearingtype' => 'wlt',
      // + Default Wallet provider
      // PPE: PayPal Express
      // 'wallettype' => 'PPE',

      // 'successurl' => '', // o AN..255 URL "payment successful"
      // 'errorurl' => '', // o AN..255 URL "faulty payment"
      // 'backurl' => '', // o AN..255 URL "Back" or "Cancel"

      // ---------
      // Parameter ( credit card ) 
      // ---------
      // 'clearingtype' => 'cc',
      // 'cardpan' => '', // + N..19 Card number 

      // + Default Card type 
      // V Visa
      // M MasterCard
      // A American Express
      // D Diners
      // J JCB
      // O Maestro International
      // U Maestro UK
      // C Discover
      // B Carte Bleue
      // 'cardtype' => '',

      // 'cardexpiredate' => '', // + N4 Expiry date YYMM 
      // 'cardcvc2' => '', // o N..4 Credit verification number (CVC)
      // 'cardissuenumber' => '', // - N..2 Card issue number (only Maestro UK cards)
      // 'cardholder' => '', // - AN..50 Card holder

      // - Default Credit card transaction type:
      // internet eCommerce Transaction (SSL secured)
      // 3dsecure 3-D Secure transaction (can be enabled alternatively in the risk settings)
      // moto Mail or telephone order transaction
      // 'ecommercemode' => '', 

      // ---------
      // Parameter ( credit card with pseudo card number )
      // ---------
      // 'pseudocardpan' => '', // + N..19 Pseudo card number (This card number can be submitted alternatively to the rest of the card data)

      // ---------
      // Parameter ( 3-D Secure )
      // ---------
      // 'xid' => '', // o AN..40 3-D Secure transaction ID (if the request "3dscheck" was used previous transactions)
      // 'cavv' => '', // - AN..40 3-D Secure authentication value 
      // 'eci' => '', // - AN..2 3-D Secure e-commerce indicator 
      // 'successurl' => '', // o AN..255 URL "payment successful"
      // 'errorurl' => '', // o AN..255 URL "faulty payment"


    ));

    $result = new stdClass();
    $result->data = $data;

    if ($msg->status == 'POST')
    {
      $url = 'https://api.pay1.de/post-gateway/';

      // echo $ref.'<br/>';
      // echo $ref_mdt.'<br/>';

      // use key 'http' even if you send the request to https://...
      $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data),
        ),
      );
      $context  = stream_context_create($options);

      if ($package->price_cent > 0)
      {
        $post_result = file_get_contents($url, FALSE, $context);
      }
      else
      {
        $post_result = 'status=APPROVED';
      }

      $post_result_exp = explode("\n", $post_result);
      foreach ($post_result_exp as $key => $row)
      {
        $exp = explode('=', $row);
        if (isset($exp[0]) && isset($exp[1]) && $exp[0] && $exp[1])
        {
          $result->$exp[0] = $exp[1];
        }
      }

      if ($result->status != 'APPROVED')
      {
        // NOT approved (return $result obj)
        // Delete [doctors/patients]_payment
        $this->m->port->p->where('id', $payment->id);
        $this->m->port->p->limit(1);

        if ($this->m->user_role() == 'doctor')
        {
          $this->m->port->p->delete('doctors_payment');
        }

        if ($this->m->user_role() == 'patient')
        {
          $this->m->port->p->delete('patients_payment');
        }

        return $result;
      }
      else
      {
        // APPROVED
        // Update [doctors/patients]_payment
        $this->m->port->p->db_select();
        $this->m->port->p->set('package'                   , $package->name);
        $this->m->port->p->set('txid'                      , $result->txid);
        $this->m->port->p->set('userid'                    , $result->userid);
        $this->m->port->p->set('cdate'                     , date('Y-m-d H:i:s', time()));

        $this->m->port->p->where('id', $payment->id);
        $this->m->port->p->limit(1);

        if ($this->m->user_role() == 'doctor')
        {
          $this->m->port->p->update('doctors_payment');
        }

        if ($this->m->user_role() == 'patient')
        {
          $this->m->port->p->update('patients_payment');
        }

        // Update doctors/patients.`p1_userid`
        $this->m->port->p->set('p1_userid', $result->userid);
        $this->m->port->p->set('package', $package->name);

        $this->m->port->p->where('id', $this->m->user_id());
        $this->m->port->p->limit(1);

        if ($this->m->user_role() == 'doctor')
        {
          $this->m->port->p->update('doctors');
        }

        if ($this->m->user_role() == 'patient')
        {
          $this->m->port->p->update('patients');
        }

        // Activating Modules
        if (isset($package->activating_modules) && is_array($package->activating_modules) && count($package->activating_modules) > 0)
        {
          $this->load->model('module');
          Module::$role = $this->m->user_role() == 'doctor' ? Module::DOCTOR_MODULES : Module::PATIENT_MODULES;
          foreach ($package->activating_modules as $m) {
            $this->mule->activate($this->m->user_id(), $m);
          }
        }
      }
    }

    if (is_array($result->data) && count($result->data) > 0)
    {
      foreach ($result->data as $key => $value)
      {
        if (!$key || !$value) continue;

        $this->m->port->p->set('payment_id', $payment->id);
        $this->m->port->p->set('key', $this->encrypt->encode($key));
        $this->m->port->p->set('value', $this->encrypt->encode($value));
        
        if ($this->m->user_role() == 'doctor')
        {
          $this->m->port->p->insert('doctors_payment_p1meta');
        }

        if ($this->m->user_role() == 'patient')
        {
          $this->m->port->p->insert('patients_payment_p1meta');
        }
      }
    }

    return $result;
  }

  /** 
   *
   */
  public function ts_insert()
  {
    if (!$this->input->post() || count($this->input->post()) <= 0)
    {
      return FALSE;
    }

    $key          = $this->input->post('key');
    $txaction     = $this->input->post('txaction');
    $mode         = $this->input->post('mode');
    $portalid     = $this->input->post('portalid');
    $aid          = $this->input->post('aid');
    $clearingtype = $this->input->post('clearingtype');
    $txtime       = $this->input->post('txtime');
    $currency     = $this->input->post('currency');
    $userid       = $this->input->post('userid');
    $customerid   = $this->input->post('customerid');
    $param        = $this->input->post('param');

    if ($key != md5(self::$key))
    {
      return FALSE;
    }

    $this->m->port->p->db_select();

    $this->m->port->p->set('txaction'     , $this->encrypt->encode($txaction));
    $this->m->port->p->set('mode'         , $this->encrypt->encode($mode));
    $this->m->port->p->set('portalid'     , $this->encrypt->encode($portalid));
    $this->m->port->p->set('aid'          , $this->encrypt->encode($aid));
    $this->m->port->p->set('clearingtype' , $this->encrypt->encode($clearingtype));
    $this->m->port->p->set('txtime'       , $this->encrypt->encode($txtime));
    $this->m->port->p->set('currency'     , $this->encrypt->encode($currency));
    $this->m->port->p->set('userid'       , $this->encrypt->encode($userid));
    $this->m->port->p->set('customerid'   , $this->encrypt->encode($customerid));
    $this->m->port->p->set('param'        , $this->encrypt->encode($param));

    $this->m->port->p->insert('p1_ts');

    $insert_id = $this->m->port->p->insert_id();

    if (!$insert_id)
    {
      return FALSE;
    }

    $query = $this->m->port->p->get_where('p1_ts', array('id' => $insert_id, ), 1);
    if ($query->num_rows() <= 0)
    {
      return FALSE;
    }

    $ts = $query->row();

    foreach ($this->input->post() as $key => $value)
    {
      if (!in_array($key, array(
        'key', 
        'txaction', 
        'mode', 
        'portalid', 
        'aid', 
        'clearingtype', 
        'txtime', 
        'currency', 
        'userid', 
        'customerid', 
        'param', 
      )))
      {
        $this->m->port->p->set('ts_id', $ts->id);
        $this->m->port->p->set('key', $this->encrypt->encode($key));
        $this->m->port->p->set('value', $this->encrypt->encode($value));

        $this->m->port->p->insert('p1_ts_meta');
      }
    }

    return TRUE;

  }

  /**
   *
   */
  public function ts_get()
  {
    $this->m->port->p->db_select();
    $query = $this->m->port->p->get('p1_ts');

    if ($query->num_rows())
    {
      $result = $query->result();

      foreach ($result as $index => $row)
      {
        $query = $this->m->port->p->get_where('p1_ts_meta', array('ts_id' => $row->id, ));

        if ($query->num_rows() > 0)
        {
          foreach ($query->result() as $meta)
          {
            if ($key = $this->encrypt->decode($meta->key))
            $result[$index]->$key = $meta->value;
          }
        }
      }

      return $result;
    }
    else
    {
      return array();
    }
  }

}

/* End of file mopayone.php */
/* Location: ./application/models/mopayone.php */