<?php
defined('BASEPATH') or exit('No direct script access allowed');

class emailController extends CI_Controller
{
  public function sendmail($data = array())
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        if (isset($data['attachment']) && !empty($data['attachment'])) {
            $this->email->attach($data['attachment']);
        }
        $this->email->from('from@mail.com', 'From name');
        $this->email->to($data['email']);

        $this->email->subject($data['subject']);
        $this->email->message($data['body']);

        $this->email->send();
    }

    public function sendNow(){
            $this->load->library('Pdf');
            $html = $this->load->view('views/view', ["name"=>"Rizwan Patel"], true);
            $file_name = FCPATH.'assest/'.md5(rand()).'.pdf';
            $attach = $this->pdf->createPDF($html, $file_name, false);
            $msg = "<p>Hello Patel, </p>
            <p>Thank you for registering.</p>
            <p>We will keep you posted regarding our updates, winners and other news.</p>
            <p>You Can Login your acount by using Mobile/Email And  Password Following are your login detail:</p>
                        <p>Email: Test</p>
                        <p>Mobile: Test</p>
                        <p>Password: Test</p>
            <p>Regards</p>";
            $email_data['subject'] = "Test";
            $email_data['body'] = $msg;
            $email_data['email'] = 'sendto@mail.com';
            $email_data['name'] = 'Patel Baa';
            $email_data['attachment'] = $attach;
            $this->sendmail($email_data);
            $arr = array('status' => 1, 'msg' => "Mail sent!", 'redirect' => "");
            echo json_encode($arr);
    }
}
