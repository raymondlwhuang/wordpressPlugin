jQuery(function($) {
	$(document).on('click','#insert-my-media',function() {
		var self = (self === undefined) ? wp.media({title: 'My media Insert call',library: {type: 'image'},multiple: false,button: {text: 'Insert'}}) : this.window; 	 
		self.open()
		    .on('select', function() {
				var first = self.state().get('selection').first().toJSON();
				wp.media.editor.insert(' this is the image I inserted(id of image is : '+ first.id + '):   <img src="'+first.url+'" />');
		});
		return false;
	
	});
	
});

