jQuery(document).ready(function() {
	viewer = new Viewer('#layer_list', '.layer_settings');
	viewer.addView('#view_axial', Viewer.AXIAL);
	viewer.addView('#view_coronal', Viewer.CORONAL);
	viewer.addView('#view_sagittal', Viewer.SAGITTAL);
	viewer.addSlider('opacity', '.slider#opacity', 'horizontal', 0, 1, 1, 0.05);
	viewer.addSlider('pos-threshold', '.slider#pos-threshold', 'horizontal', 0, 1, 0, 0.01);
	viewer.addSlider('neg-threshold', '.slider#neg-threshold', 'horizontal', 0, 1, 0, 0.01);
	viewer.addSlider("nav-xaxis", ".slider#nav-xaxis", "horizontal", 0, 1, 0.5, 0.01, Viewer.XAXIS);
	viewer.addSlider("nav-yaxis", ".slider#nav-yaxis", "vertical", 0, 1, 0.5, 0.01, Viewer.YAXIS);
	viewer.addSlider("nav-zaxis", ".slider#nav-zaxis", "vertical", 0, 1, 0.5, 0.01, Viewer.ZAXIS);


	viewer.addColorSelect('#select_color');
	viewer.addSignSelect('#select_sign')
	viewer.addDataField('voxelValue', '#data_current_value')
	viewer.addDataField('currentCoords', '#data_current_coords')
	viewer.addTextField('image-intent', '#image_intent')
	viewer.clear()   // Paint canvas background while images load
	images = [
            {
			'url': '../static/data/MNI152.nii.gz',
			'name': 'MNI template ',
			'colorPalette': 'grayscale',
			'cache': true,
			'intent': 'Intensity:'
		},
            {
			'url': '../static/data/brain_activations.nii',
			'name': 'Imaging Data',
			'colorPalette': 'red',
			'cache': true,
			'intent': 'Intensity:'
		},
            {
			'url': '../static/data/gene_expressions.nii.gz',
			'name': 'Gene Expressions ',
			'colorPalette': 'intense red-blue',
			'cache': true,
			'intent': 'Intensity:'
		},

	]
	viewer.loadImages(images);

});