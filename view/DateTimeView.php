<?php

namespace view;

class DateTimeView {

    //Return time
	public function show() {
		$timeString = date('l\, \t\h\e jS \of F Y\, \T\h\e \t\i\m\e \i\s h:i:s ');
		return '<p>' . $timeString . '</p>';
	}
}