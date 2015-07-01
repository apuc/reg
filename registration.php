<?php
    /**
     * Plugin Name: Registration IPiOOO by Art Craft
     * Plugin URI: http://web-artcraft.com
     * Description: Онлайн чат
     * Version: 1.0.0
     * Author: ArtCraft
     * Author URI: http://web-artcraft.com
     */


    /*
       Kirill
    */
    define('REG_DIR', plugin_dir_path(__FILE__));
    define('REG_URL', plugin_dir_url(__FILE__));

    require_once(REG_DIR . "/class/parser.php");
    require_once(REG_DIR . "/functions.php");
    require_once(REG_DIR . "/class/Docs.php");
    require_once(REG_DIR . "/PHPWord/PHPWord.php");

//require_once(REG_DIR."/tree.php");

    function add_reg_style()
    {
        wp_enqueue_style('bootstrap-style', REG_URL . 'css/bootstrap.min.css', [], '1');
        wp_enqueue_style('ui-style', REG_URL . 'css/jquery-ui.min.css', [], '1');
        wp_enqueue_style('fuelux-style', REG_URL . 'css/fuelux.css', [], '1');
        wp_enqueue_style('main-style', REG_URL . 'css/style.css', [], '1');
        wp_enqueue_style('tabs-style', REG_URL . 'css/tabs.css', [], '1');
    }

    function add_reg_script()
    {
        wp_enqueue_script('jq_reg', REG_URL . 'js/jquery-2.1.3.min.js', [], '1');
        wp_enqueue_script('boot_reg', REG_URL . 'js/bootstrap.min.js', [], '1');
        wp_enqueue_script('boot_reg', REG_URL . 'js/valid.js', [], '1');
        wp_enqueue_script('fuelux_reg', REG_URL . 'js/fuelux.min.js', [], '1');
        wp_enqueue_script('jq_ui', REG_URL . 'js/jquery-ui.min.js', [], '1');
        wp_enqueue_script('reg_region', REG_URL . 'js/regions.js', [], '1');
        wp_enqueue_script('reg_script', REG_URL . 'js/script.js', [], '1');
        wp_localize_script('reg_script', 'myajax', ['url' => admin_url('admin-ajax.php')]);
    }

    function true_reg_backend()
    {
        wp_enqueue_script('admin_js', REG_URL . '/js/admin.js');
        wp_localize_script('admin_js', 'myajax', ['url' => admin_url('admin-ajax.php')]);
        wp_enqueue_style('true_style', REG_URL . '/css/style.css');
        /* wp_enqueue_script( 'true_script', SV_URL.'js/script.js' );*/
    }

    add_action('admin_enqueue_scripts', 'true_reg_backend');
    add_action('wp_enqueue_scripts', 'add_reg_style');
    add_action('wp_enqueue_scripts', 'add_reg_script');

    add_shortcode('reg-form', 'reg_form');
    add_shortcode('cab', 'cab');

    add_action('wp_ajax_get_country_field', 'get_country_field');
    add_action('wp_ajax_nopriv_get_country_field', 'get_country_field');

    add_action('wp_ajax_add_user_aj', 'add_user_aj_function');
    add_action('wp_ajax_nopriv_add_user_aj', 'add_user_aj_function');
    add_action('wp_ajax_add_address_aj', 'add_address_aj_function');

    $doc = new Docs(__DIR__, Docs::russia, Docs::IP);

    function add_user_aj_function()
    {
        global $doc;

        $user_id = reg_user($_POST);
        reg_user_meta($user_id, $_POST);

        $doc->setUserMail($_POST['email']);
        $doc->setUserINN($_POST['inn']);

        $fio = $_POST['lastName'] . ' ' . $_POST['firstName'] . ' ' . $_POST['middleName'];

        $doc->setTag('FIO', $fio);

        header('Content-Type: application/json');
        echo json_encode(['mark' => $user_id]);
        die;
    }

    function add_address_aj_function()
    {
        global $doc;

        $user_id = $_POST['temp_user_id'];
        add_meta_at_step_3($user_id, $_POST);
        //reg_user_meta();

        $address = 'г. ' . $_POST['city'] . ' ул. ' . $_POST['street'] . ' д. ' . $_POST['home'] . ' кв. ' . $_POST['kv'];
        $doc->setTag('ADDRESS', $address);

        //header('Content-Type: application/json');
        header('Content-Type: text/plain');
        echo json_encode(['mark' => is_numeric($user_id)]);
        die;
    }

    function reg_form()
    {
        $parser = new ParserReg();

        if (isset($_POST['user_email_doc'])) {
            $parser->parse(REG_DIR . "/views/reg_success.php", [], true);
        } elseif (isset($_POST['lastName'])) {
            //prn_reg($_POST);
            $user_id = reg_user($_POST);
            reg_user_meta($user_id, $_POST);
            $parser->parse(REG_DIR . "/views/reg_success.php", ['id' => $user_id], true);
        } else {
            $data['step1'] = $parser->parse(REG_DIR . "views/step1.php", [], false);
            $data['step2'] = $parser->parse(REG_DIR . "views/reg_form.php", [], false);
            $data['step3'] = $parser->parse(REG_DIR . "views/step3.php", [], false);
            $parser->parse(REG_DIR . "views/reg-wizard.php", $data, true);
            echo '

        ';
        }
    }

    function cab()
    {
        if (isset($_GET['user'])) {
            $user = get_user_by('id', $_GET['user']);
            //prn_reg($user->data->user_email);
            //$userdata = get_userdata( $_GET['user'] );

            $info = get_all_user_meta($_GET['user']);
            $info['email'] = $user->data->user_email;
            $parser = new ParserReg();
            $info['country_cab'] = $parser->parse(REG_DIR . "/views/country_cab/" . $info['country'] . ".php", $info, false);
            $parser->parse(REG_DIR . "/views/cab.php", $info, true);
        }
    }

    function reg_user($arr)
    {
        $data['user_pass'] = gen_pass(12);
        $data['user_login'] = $arr['email'];
        $data['user_email'] = $arr['email'];
        $data['last_name'] = $arr['lastName'];
        $data['first_name'] = $arr['firstName'];
        $data['role'] = $arr['firstName'];

        return wp_insert_user($data);
    }

    function reg_user_meta($user_id, $arr)
    {
        $user = [
            'pasporNumb'    => $arr['pasporNumb'],
            'pasportDate'   => $arr['pasportDate'],
            'pasportGive'   => $arr['pasportGive'],
            'kodPod'        => $arr['kodPod'],
            'middleName'    => $arr['middleName'],
            'birthday'      => $arr['birthday'],
            'birthdayPlace' => $arr['birthdayPlace'],
            'Sex'           => $arr['Sex'],
            'country'       => $arr['country'],
            'inn'           => $arr['inn'],
            'mobileNumb'    => $arr['mobileNumb'],
            'phoneCity'     => $arr['phoneCity'],
            'phoneNumb'     => $arr['phoneNumb'],
        ];

        foreach ($user as $k => $v) {
            update_user_meta($user_id, $k, $v, true);
        }
    }

    function add_meta_at_step_3($user_id, $arr)
    {
        $user_meta = [
            'region'     => $arr['region'],
            'city'       => $arr['city'],
            'street'     => $arr['street'],
            'index'      => $arr['index'],
            'house_type' => $arr['house_type'],
            'house'      => $arr['house'],
            'kv_type'    => $arr['kv_type'],
            'kv'         => $arr['kv'],
        ];

        foreach ($user_meta as $k => $v) {
            update_user_meta($user_id, $k, $v, true);
        }
    }

    function get_country_field()
    {
        if ($_POST['country'] == '0') {
            echo "";
        } else {
            $country = $_POST['country'];
            $parser = new ParserReg();
            $parser->parse(REG_DIR . "views/country_fields/" . $country . ".php", [], true);
        }
        die();
    }

    function get_all_user_meta($user_id)
    {
        global $wpdb;

        $info = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = $user_id", ARRAY_A);
        foreach ($info as $v) {
            $arr[$v['meta_key']] = $v['meta_value'];
        }
        return $arr;
    }

