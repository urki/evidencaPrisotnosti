
			//get date//
			function get_date() {
				var now = new Date();
				var months = new Array(
     			 'Januar','Februar','Marec','April','Maj',
      			 'Junij','Julij','Avgust','September','Oktober',
      			 'November','December');
				 var elem = document.getElementById('datum');
				 elem.innerHTML = now.getDate() + '.' + months[now.getMonth()];
			}

            // This function gets the current time and injects it into the DOM
            function updateClock() {
                // Gets the current time
                var now = new Date();

              
// convert to msec
// add local time zone offset
// get UTC time in msec
utc = now.getTime() + (now.getTimezoneOffset() * 60000);

// create new Date object for different city
// using supplied offset
offset='+1';

nd = new Date(utc + (3600000*offset));
now=nd;


                // Get the hours, minutes and seconds from the current time
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();

                // Format hours, minutes and seconds
                if (hours < 10) {
                    hours = "0" + hours;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }

                // Gets the element we want to inject the clock into
                var elem = document.getElementById('clock');

                // Sets the elements inner HTML value to our clock data
                elem.innerHTML = hours + ':' + minutes;
            }
	

		function submitenter(myfield,e)
			{
				var keycode;
				if (window.event) keycode = window.event.keyCode;
				else if (e) keycode = e.which;
				else return true;

				if (keycode == 39)
			   {
				   myfield.form.submit();
				   return false;
			   }
				else
			   return true;
			}

function submitenter(myfield,e)
			{
				var keycode;
				if (window.event) keycode = window.event.keyCode;
				else if (e) keycode = e.which;
				else return true;

				if (keycode == 39)
			   {
				   myfield.form.submit();
				   return false;
			   }
				else
			   return true;
			}

