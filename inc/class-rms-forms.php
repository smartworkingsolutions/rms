<?php
/**
 * All custom actions here.
 *
 * @package RMS
 */

defined( 'WPINC' ) || exit;

/**
 * Apply form class
 */
Class contactforms_apply_form { // phpcs:ignore

	/**
	 * WHO GETS THIS EMAIL? CAN BE COMMA SEPARATED LIST.
	 */
	public function emails() {
		// return "david@netbizgroup.co.uk,arran@netbizgroup.co.uk,sajid@netbizgroup.co.uk";.
		return get_contact_form_emails( 'apply_form' );
	}

	/**
	 * DO WE SEND AN AUTO RESPONDER TO THE "FOUND EMAIL"? (LEAVE BLANK TO DISABLE).
	 */
	public function autoresponder() {
		$html = '
			<p>Hi {title} {name},</p>
			<p>Thank you.</p>
			<p>A member of our team will be in touch soon.</p>
		';
		return $html;
	}

	/**
	 * Main form.
	 */
	public function form() {

		// SET UP THE FORM.
		$pb = new contactforms_postback();

		$inner_html = '';

		// KEEP THIS IN - IF THERE IS AN ISSUE WITH MAILCHIMP, IT WILL SHOW A MESSAGE.
		foreach ( $pb->ga( 'errors' ) as $form_error ) {
			$inner_html .= '<p style="color: red;">' . $form_error . '</p>';
		}

		// [SIMPLE TEXT FIELDS - START].
		$inner_html .= '
			<div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-8">
			
				<div class="form-group flex flex-col">
					<label for="name">Full Name <span class="required text-primary">*</span></label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="name" type="text" name="name" placeholder="John doe" required />
				</div>

				<div class="form-group flex flex-col">
					<label for="email">Email <span class="required text-primary">*</span></label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="email" type="text" name="email" placeholder="example@company.com" required />
				</div>

				<div class="form-group flex flex-col">
					<label for="mobile">Mobile Number <span class="required text-primary">*</span></label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="mobile" type="number" name="mobile" placeholder="1800 222 333" required />
				</div>

				<div class="form-group flex flex-col">
					<label for="position">Current Position</label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="position" type="text" name="position" placeholder="UI Developer" />
				</div>

				<div class="form-group flex flex-col">
					<label for="expectaion">Salary Expectation <small>(annually)</small></label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="expectaion" type="text" name="expectaion" placeholder="35000" />
				</div>

				<div class="form-group flex flex-col">
					<label for="location">Preferred Location for National Role</label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="location" type="text" name="location" placeholder="Global" />
				</div>

			</div>

			<div class="w-full">
				<h3 class="text-theme-color font-bold text-2xl mt-12 mb-4">' . get_field( 'af_heading_2' ) . '</h3>
				<p>' . get_field( 'af_description' ) . '</p>
			</div>

			<div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-8 mt-8">

				<div class="form-group flex flex-col">
					<label for="dob">Date of Birth</label>
					<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="dob" type="text" name="dob" placeholder="dd/mm/yyyy" />
				</div>
		';

		// Select.
		$inner_html .= '<div class="form-group flex flex-col">
			<label for="marital">Marital Status</label>
			<select name="marital" id="marital" class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color">
				<option value="">Select Status</option>';

		$vals = [ 'Single', 'Married', 'Divorced' ];
		foreach ( $vals as $val ) {
			$val_sel = '';
			if ( $pb->g( 'marital' ) === $val ) {
				$val_sel = ' selected="selected" ';
			}
			$inner_html .= sprintf(
				'<option value="%1$s" %2$s>%1$s</option>',
				$val,
				$val_sel
			);
		}
		$inner_html .= '</select>
		</div>';

		// Select.
		$inner_html .= '<div class="form-group flex flex-col">
		<label for="gender">Gender</label>
		<select name="gender" id="gender" class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color">
			<option value="">Select Gender</option>';

		$vals = [ 'Male', 'Female', 'Other' ];
		foreach ( $vals as $val ) {
			$val_sel = '';
			if ( $pb->g( 'gender' ) === $val ) {
				$val_sel = ' selected="selected" ';
			}
			$inner_html .= sprintf(
				'<option value="%1$s" %2$s>%1$s</option>',
				$val,
				$val_sel
			);
		}
		$inner_html .= '</select>
		</div>';

		// Simple fields again.
		$inner_html .= '<div class="form-group flex flex-col">
				<label for="sexual_orientation">Sexual Orientation</label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="sexual_orientation" type="text" name="sexual_orientation" placeholder="Sexual Orientation" />
			</div>

			<div class="form-group flex flex-col">
				<label for="religion">Religion or Belief</label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="religion" type="text" name="religion" placeholder="Christian" />
			</div>

			<div class="form-group flex flex-col">
				<label for="ethnic_origin">Ethnic Origin</label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="ethnic_origin" type="text" name="ethnic_origin" placeholder="Ethnic Origin" />
			</div>

		</div>

		<div class="w-full">
			<h3 class="text-theme-color font-bold text-2xl mt-12 mb-4">' . get_field( 'af_heading_3' ) . '</h3>
			<p>' . get_field( 'af_description_2' ) . '</p>
		</div>';

		// Radio buttons.
		$services    = [ 'Yes', 'No', 'Prefer Not to Say' ];
		$inner_html .= '<div class="mt-4 space-y-2">';
		foreach ( $services as $s ) {
			$inner_html .= '<div class="form-group flex items-center">
				<input name="disability" type="radio" class="border-neutral-300 text-primary focus:ring-primary focus:outline-none" value="' . $s . '"';
			if ( in_array( $s, $pb->ga( 'disability' ) ) ) { //phpcs:ignore
				$inner_html .= " checked='checked' ";
			}
			$inner_html .= ' />
			<label for="' . $s . '" class="ml-3 block"> ' . $s . ' </label></div>';
		}
		$inner_html .= '</div>';

		$inner_html .= '<div class="w-full mt-8">
			<label class="block"> Upload your CV <span class="required text-primary">*</span> </label>
			<input class="block w-full px-3 py-1.5 text-base font-normal bg-neutral-300 bg-clip-padding border border-neutral-300 rounded transition ease-in-out mt-1 focus:bg-white focus:ring-theme-color focus:outline-none" type="file" id="CVFile" name="attachment[]">
		</div>';

		$inner_html .= '<div class="flex items-center mt-8">
			<div class="flex items-center h-5">
			<input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 bg-gray-50 rounded border border-neutral-300 text-primary focus:ring-primary focus:outline-none" required>
			</div>
			<div class="ml-3">
			<label for="terms">I agree with the <a href="#" class="text-primary hover:underline">RMS Privacy Notice</a></label>
			</div>
		</div>

		<p class="mt-8 mb-4">' . get_field( 'af_bottom_text' ) . '</p>';

		// [RECAPTCHA - START]
		$inner_html .= '<p>';
		// SIZE CAN BE COMPACT OR NORMAL (SNAPS TO COMPACT - SEE JS - WHEN WINDOW < 800PX WIDE).
		$inner_html .= do_shortcode( "[contactforms_recaptcha size='normal']" );
		$inner_html .= '</p>';
		// [RECAPTCHA - END]

		// THIS CLASS HIDES THE SUBMIT BUTTON UNTIL RECAPTCHA IS COMPLETED (SAVES MISSING IT).
		$inner_html .= "<div class='js-wait-for-recaptcha'>";
		$inner_html .= '
			<button type="submit" class="button mt-12">Submit</button>
		';
		$inner_html .= '</div>';

		return $inner_html;
	}
}

/**
 * Ask for help form class
 */
Class contactforms_ask_form { // phpcs:ignore

	/**
	 * WHO GETS THIS EMAIL? CAN BE COMMA SEPARATED LIST.
	 */
	public function emails() {
		// return "david@netbizgroup.co.uk,arran@netbizgroup.co.uk,sajid@netbizgroup.co.uk";.
		return get_contact_form_emails( 'ask_form' );
	}

	/**
	 * DO WE SEND AN AUTO RESPONDER TO THE "FOUND EMAIL"? (LEAVE BLANK TO DISABLE).
	 */
	public function autoresponder() {
		$html = '
			<p>Hi {title} {name},</p>
			<p>Thank you for your enquiry.</p>
			<p>A member of our team will be in touch soon.</p>
		';
		return $html;
	}

	/**
	 * Main form.
	 */
	public function form() {

		// SET UP THE FORM.
		$pb = new contactforms_postback();

		$inner_html = '';

		// KEEP THIS IN - IF THERE IS AN ISSUE WITH MAILCHIMP, IT WILL SHOW A MESSAGE.
		foreach ( $pb->ga( 'errors' ) as $form_error ) {
			$inner_html .= '<p style="color: red;">' . $form_error . '</p>';
		}

		// [SIMPLE TEXT FIELDS - START].
		$inner_html .= '
		<div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
        
			<div class="form-group flex flex-col">
				<label for="f_name">First Name <span class="required text-primary">*</span></label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="f_name" type="text" name="f_name" placeholder="John" required />
			</div>

			<div class="form-group flex flex-col">
				<label for="l_name">Last Name <span class="required text-primary">*</span></label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="l_name" type="text" name="l_name" placeholder="Doe" required />
			</div>

			<div class="form-group flex flex-col">
				<label for="email">Email <span class="required text-primary">*</span></label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="email" type="text" name="email" placeholder="example@company.com" required />
			</div>

			<div class="form-group flex flex-col">
				<label for="contact_number">Contact Number <span class="required text-primary">*</span></label>
				<input class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" id="contact_number" type="number" name="contact_number" placeholder="1800 222 333" required />
			</div>

		</div>

		<div class="form-group flex flex-col mt-8">
			<label for="employer">How can we help? <span class="required text-primary">*</span></label>
			<textarea name="help_message" cols="30" rows="5" class="mt-1 border-neutral-300 rounded focus:border-0 focus:outline-none focus:ring-theme-color" placeholder="Message"></textarea>
		</div>
		';

		// [RECAPTCHA - START]
		$inner_html .= '<p class="mt-8">';
		// SIZE CAN BE COMPACT OR NORMAL (SNAPS TO COMPACT - SEE JS - WHEN WINDOW < 800PX WIDE).
		$inner_html .= do_shortcode( "[contactforms_recaptcha size='normal']" );
		$inner_html .= '</p>';
		// [RECAPTCHA - END]

		// THIS CLASS HIDES THE SUBMIT BUTTON UNTIL RECAPTCHA IS COMPLETED (SAVES MISSING IT).
		$inner_html .= "<div class='js-wait-for-recaptcha'>";
		$inner_html .= '
			<div>
				<button type="submit" class="button mt-8">Submit</button>
			</div>
		';
		$inner_html .= '</div>';

		return $inner_html;
	}
}

/**
 * Ask for help form class
 */
Class contactforms_enquiry_form { // phpcs:ignore

	/**
	 * WHO GETS THIS EMAIL? CAN BE COMMA SEPARATED LIST.
	 */
	public function emails() {
		// return "david@netbizgroup.co.uk,arran@netbizgroup.co.uk,sajid@netbizgroup.co.uk";.
		return get_contact_form_emails( 'ask_form' );
	}

	/**
	 * DO WE SEND AN AUTO RESPONDER TO THE "FOUND EMAIL"? (LEAVE BLANK TO DISABLE).
	 */
	public function autoresponder() {
		$html = '
			<p>Hi {title} {name},</p>
			<p>Thank you for your enquiry.</p>
			<p>A member of our team will be in touch soon.</p>
		';
		return $html;
	}

	/**
	 * Main form.
	 */
	public function form() {

		// SET UP THE FORM.
		$pb = new contactforms_postback();

		$inner_html = '';

		// KEEP THIS IN - IF THERE IS AN ISSUE WITH MAILCHIMP, IT WILL SHOW A MESSAGE.
		foreach ( $pb->ga( 'errors' ) as $form_error ) {
			$inner_html .= '<p style="color: red;">' . $form_error . '</p>';
		}

		// [SIMPLE TEXT FIELDS - START].
		$inner_html .= '
		<div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-12">
			<div class="form-group flex flex-col">
				<label class="text-2xl" for="name">Full Name</label>
				<input class="mt-2 py-4 border-neutral-300 focus:border-0 focus:outline-none focus:ring-theme-color" id="name" type="text" name="name" placeholder="John Doe" required />
			</div>
			<div class="form-group flex flex-col">
				<label class="text-2xl" for="email">Email Address</label>
				<input class="mt-2 py-4 border-neutral-300 focus:border-0 focus:outline-none focus:ring-theme-color" id="email" type="text" name="email" placeholder="example@company.com" required />
			</div>
		</div>

		<div class="form-group flex flex-col mt-12 lg:mt-16">
			<label class="text-2xl" for="employer">Message</label>
			<textarea name="help_message" cols="30" rows="8" class="mt-2 border-neutral-300 focus:border-0 focus:outline-none focus:ring-theme-color" placeholder="Write your message here..."></textarea>
		</div>
		';

		// [RECAPTCHA - START]
		$inner_html .= '<p class="mt-8">';
		// SIZE CAN BE COMPACT OR NORMAL (SNAPS TO COMPACT - SEE JS - WHEN WINDOW < 800PX WIDE).
		$inner_html .= do_shortcode( "[contactforms_recaptcha size='normal']" );
		$inner_html .= '</p>';
		// [RECAPTCHA - END]

		// THIS CLASS HIDES THE SUBMIT BUTTON UNTIL RECAPTCHA IS COMPLETED (SAVES MISSING IT).
		$inner_html .= "<div class='js-wait-for-recaptcha'>";
		$inner_html .= '
			<button type="submit" class="w-full button py-7 mt-12 lg:mt-16">Send Enquiry</button>
		';
		$inner_html .= '</div>';

		return $inner_html;
	}
}
