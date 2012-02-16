CodeIgniter Message Library
===========================

You can use this library to store and retrieve your error or information messages whenever you want. The messages are cleared when you retrieve them, so they remain available even after a redirect!

Usage
-----

To install the library, place it inside your libraries folder and load it using
    $this->load->library("messages");

### Adding messages

To add messages for later display you can add them to a specific message group using:

    $this->messages->add("An error has occurred", "error");
	$this->messages->add("Thank you for registering", "success");
	$this->messages->add("Please not this message", "message");

### Displaying messages

The added messages stays available until you retrieve them. So if you would add them in a specific controller and then redirect, the messages would still be available. This is especially handy for displaying error messages when an action has failed.

    $messages = $this->messages->get();
	
This will return an array to be used like this:

    $all = $this->messages->get();
        foreach($all as $type=>$messages)
            foreach($messages as $message)
                echo $type.': '.$message.'<br>';
				
If you only want one specific type of message you can use:

    $messages = $this->messages->get("error");
	
So that you can display them using:

    $errors = $this->messages->get("error");
        foreach($errors as $error)
            echo 'error: '.$error.'<br>';
			
If at any point you want to know how many messages are stored you can use:

    $errors = $this->messages->count("error");
	$all = $this->messages->count();
	
The stored messages are cleared when you retrieve them using get(), but if you want to manually clear them you can use:

	$this->messages->clear();
	$this->messages->clear("error");