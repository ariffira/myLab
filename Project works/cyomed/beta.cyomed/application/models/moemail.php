<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moemail extends CI_Model {


  /**
   *
   */
  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }

  /**
   *
   */
  protected function init_email()
  {
    $this->load->library('email');

    $this->load->model('site_config');

    $config['protocol'] = $this->site_config->item('email_protocol');
    $config['smtp_host'] = $this->site_config->item('email_smtp_host');
    $config['smtp_user'] = $this->site_config->item('email_smtp_user');
    $config['smtp_pass'] = $this->site_config->item('email_smtp_pass');
    $config['smtp_port'] = $this->site_config->item('email_smtp_port');
    $config['mailtype'] = $this->site_config->item('email_mailtype');

    $this->email->initialize($config);

    $this->email->from($this->m->site_config->item('email_sender_address'), $this->m->site_config->item('email_sender_name'));
  }

  /**
   *
   */
  public function send_email($to, $subject = 'Untitled', $content = '')
  {
    $this->init_email();

    if (is_array($to) && count($to) > 0)
    {
      $this->email->to($to[0]);
      $this->email->cc('service@cyomed.com');
      // $this->email->bcc('them@their-example.com');
    }
    elseif (is_string($to))
    {
      $this->email->to($to);
      $this->email->cc('service@cyomed.com');
      // $this->email->bcc('them@their-example.com');
    }
    else
    {
      return FALSE;
    }

    $this->email->subject($subject);
    $this->email->message($content);

    $this->email->send();

    // echo $this->email->print_debugger();
    // exit();
    return TRUE;
  }

  public function send_pdf_email($to, $subject = 'Untitled', $content = '',$status)
  {
    $this->init_email();

    if (is_array($to) && count($to) > 0)
    {
      $this->email->to($to[0]);
      // $this->email->cc('another@another-example.com');
      // $this->email->bcc('them@their-example.com');
    }
    elseif (is_string($to))
    {
      $this->email->to($to);
      // $this->email->cc('another@another-example.com');
      // $this->email->bcc('them@their-example.com');
    }
    else
    {
      return FALSE;
    }

    $this->email->subject($subject);
    $this->email->message($content);

    if ($status=="patient") {
      $this->email->attach('assets/files/Servicevertrag_E-Mail v1.pdf');
      $this->email->attach('assets/files/Widerrufsbelehrung v1.pdf');
    }

    if ($status=="doctor") {
      $this->email->attach('assets/files/Widerrufsbelehrung v1.pdf');
    }

    $this->email->send();

    //echo $this->email->print_debugger();
  }

  /**
   *
   */
  public function email_content()
  {
    return 
      '<html><body>'.
      'Sehr {gendermsg} {patientname},<br /><br />'.
      'Sie haben Ihr Passwort, Ihre PIN oder Ihre persönliche Patienten ID vergessen:<br /><br />'.
      'Diese lauten:<br /><br />'.
      '<table cellpadding="0" cellspacing="0">'.
      '  <tr>'.
      '    <td>'.
      '      <b>Patient-ID:</b>&nbsp;'.
      '      <b>{patientprofileid}</b>'.
      '    </td>'.
      '    </tr>'.
      '  <tr>'.
      '    <td>'.
      '      <b>PIN:</b>&nbsp;'.
      '      <b>{patientpin}</b>'.
      '    </td>'.
      '    </tr>'.
      '    <tr>'.
      '    <td>'.
      '      <b>Neues Passwort:</b>&nbsp;'.
      '      <b>{patientpassword}</b>'.
      '    </td>'.
      '    </tr>'.
      ' </table>'.
      '<br /><br />'.
      'Bitte speichern Sie diese Mail ab oder drucken Sie diese aus und verwahren Sie sie an einem sicheren Ort, um sie vor Zugriff durch nicht autorisierte Personen zu schützen.<br /><br />'.
      'Sollten Sie noch Fragen haben oder Ihre Zugangsdaten verlieren, kontaktieren Sie uns bitte sofort unter 0211 / 97264094 oder per E-Mail unter kundenservice@ihrarzt24.de<br /><br />'.
      '<strong>Mit freundlichen Grüßen aus Düsseldorf</strong>'.
      '</body></html>';
  }

}

/* End of file moemail.php */
/* Location: ./application/models/moemail.php */