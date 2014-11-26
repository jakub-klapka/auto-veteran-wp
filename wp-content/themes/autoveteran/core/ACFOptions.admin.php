<?php


namespace Lumi\Admin;


class ACFOptions {

	private $forms;

	public function __construct() {

		$this->forms = array(
			'cs' => 109,
			'en' => 853
		);

		add_action( 'acf/save_post', array( $this, 'save_contact_form_atts' ) );
	
	}

	public function save_contact_form_atts( $post_id ) {
		if( $post_id === 'options' || $post_id === 'options_' . ICL_LANGUAGE_CODE ) {

			$form_id = $this->forms[ ICL_LANGUAGE_CODE ];

			$email = get_field( 'cf_admin_email', 'option' );
			if( !is_email( $email ) ) return;

			$options = get_post_meta( $form_id, '_mail', true );
			$options['sender'] = '[name] <' . $email . '>';
			$options['recipient'] = $email;
			update_post_meta( $form_id, '_mail', $options );

			$sent_notif = get_field( 'cf_notif_message', 'option' );
			if( empty( $sent_notif ) ) return;

			$notif_options = get_post_meta( $form_id, '_mail_2', true );
			$notif_options['sender'] = 'Auto Veteran <' . $email . '>';
			$notif_options['body'] = $sent_notif;
			$notif_options['subject'] = get_field( 'cf_notif_subject', 'option' );
			update_post_meta( $form_id, '_mail_2', $notif_options );

		}
	}

}