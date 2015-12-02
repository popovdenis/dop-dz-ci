<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 28.11.2015
 * Time: 0:12
 */
class Items extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model( 'items_model', 'Item' );
        $data['site_name'] = $this->config->item( 'site_name' );
        $this->load->vars( $data );
    }

    function index()
    {
        $data['page_title'] = 'All Items';
        $data['items'] = $this->Item->get_all();
        $this->load->view('header', $data);
        $this->load->view('items/index', $data);
        $this->load->view('footer', $data);
    }

    function details()
    {
        $this->load->model('items_model', 'Item');
        // ROUTE: item/{name}/{id}
        $id = $this->uri->segment(3);
        $item = $this->Item->get($id);

        if (!$item) {
            $this->session->set_flashdata('error', 'Item not found.');
            redirect('items');
        }

        $data['page_title'] = $item->name;
        $data['item'] = $item;

        $this->load->view('header', $data);
        $this->load->view('items/details', $data);
        $this->load->view('footer', $data);
    }

    function purchase()
    { // ROUTE: purchase/{name}/{id}
        $item_id = $this->uri->segment(3);
        $item = $this->Item->get($item_id);

        if (!$item) {
            $this->session->set_flashdata('error', 'Item not found.');
            redirect('items');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[127]');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');

            $key = md5($item_id . time() . $email . rand());
            $this->Item->setup_payment($item->id, $email, $key);

            $this->load->library('Paypal_Lib');
            $this->paypal_lib->add_field('business', $this->config->item('paypal_email'));
            $this->paypal_lib->add_field('return', site_url('paypal/success'));
            $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
            $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url

            $this->paypal_lib->add_field('item_name', $item->name);
            $this->paypal_lib->add_field('item_number', '1');
            $this->paypal_lib->add_field('amount', $item->price);

            $this->paypal_lib->add_field('custom', $key);

            redirect($this->paypal_lib->paypal_get_request_link());
        }

        $data['page_title'] = 'Purchase &ldquo;' . $item->name . '&rdquo;';
        $data['item'] = $item;

        $this->load->view('header', $data);
        $this->load->view('items/purchase', $data);
        $this->load->view('footer', $data);
    }

    function download()
    { // ROUTE: download/{purchase_key}
        $key = $this->uri->segment(3);
        $purchase = $this->Item->get_purchase_by_key($key);

        // Check purchase was fulfilled
        if (!$purchase) {
            $this->session->set_flashdata('error', 'Download key not valid.');
            redirect('items');
        }
        if ($purchase->active == 0) {
            $this->session->set_flashdata('error', 'Download not active.');
            redirect('items');
        }

        // Check download limit
        $download_limit = $this->config->item('download_limit');
        if ($download_limit['enable']) {
            $downloads = $this->Item->get_purchase_downloads($purchase->id, $download_limit['downloads']);
            $count = 0;
            $time_limit = time() - (86400 * $download_limit['days']);
            foreach ($downloads as $download) {
                if ($download->download_at >= $time_limit) {
                    $count++;
                } // download within past x days
                else {
                    break;
                } // later than x days, so can stop foreach
            }

            // If over download limit, error
            if ($count >= $download_limit['downloads']) { // can only download x times within y days
                $this->session->set_flashdata(
                    'error',
                    'You can only download a file ' . $download_limit['downloads'] . ' times in a ' . $download_limit['days'] . ' day period. Please try again later.'
                );
                redirect('items');
            }
        }

        // Get item and initiate download if exists
        $item = $this->Item->get($purchase->item_id);

        $file_name = $item->file_name;
        $file_data = read_file('files/' . $file_name);

        if (!$file_data) { // file not found on server
            $this->session->set_flashdata(
                'error', 'The requested file was not found. Please contact us to resolve this.'
            );
            redirect('items');
        }

        $this->Item->log_download($item->id, $purchase->id, $this->input->ip_address(), $this->input->user_agent());
        force_download($file_name, $file_data);
    }

}