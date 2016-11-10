<!doctype html>
<html ng-app="App">
    <head>
        <link href="../css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../css/jquery-ui.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../css/style.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="../js/panzoom.js" type="text/javascript"></script>
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/xtk.js" type="text/javascript"></script>
        <script src="../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/rainbow.js" type="text/javascript"></script>
        <script src="../js/sylvester.js" type="text/javascript"></script>
        <script src="../js/amplify.min.js" type="text/javascript"></script>
        <script src="../js/viewer.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="../js/gene_preview.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {

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

                var img_id1 = "<?php echo $_GET["ID"]; ?>";
                images = [
                    {
                        'url': '../data/MNI152.nii',
                        'name': 'MNI152 2mm',
                        'colorPalette': 'grayscale',
                        'cache': false,
                        'intent': 'Intensity:'
                    },
        
                    {
                        'url': 'blob:http%3A//brainspell.org/e1c28966-1134-4494-a0bc-12631804c347.nii',
                        'name': 'emotion meta-analysis',
                        'colorPalette': 'green',
                        'intent': 'z-score:'
                    },
        
                ]

                viewer.loadImages(images);

            });
        </script>
        <link rel="stylesheet" type="text/css" href="../css/gene_preview.css">

    </head>

    <body ng-controller="omicsCtrl">
        <div class='container'>
            <div class='row'>
                <div class='col-md-10 col-md-offset-1'>
                    <h2>Gene preview</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-10 col-md-offset-1'>
                    <div id="views_left">
                        <div class='view' id='view_coronal'>
                            <canvas height='220' id='cor_canvas' width='220'></canvas>
                            <div class='slider nav-slider-vertical' id='nav-yaxis'></div>
                        </div>
                        <div class='view' id='view_axial'>
                            <canvas height='264' id='axial_canvas' width='220'></canvas>
                            <div class='slider nav-slider-vertical' id='nav-zaxis'></div>
                        </div>
                    </div>
                    <div id="views_right">
                        <div class='view' id='view_sagittal'>
                            <canvas height='220' id='sag_canvas' width='264'></canvas>
                            <div class='slider nav-slider-horizontal' id='nav-xaxis'></div>
                        </div>
                        <div id="data_panel">
                            <div class="data_display_row">
                                <div class="data_label">Coordinates:</div>
                                <div id="data_current_coords"></div>
                            </div>
                            <div class="data_display_row">
                                <div id="image_intent" class="data_label">Initial value</div>
                                <div id="data_current_value"></div>
                            </div>
                        </div>
                    </div>

                    <div id="layer_panel">
                        <div id="layer_settings_panel">
                            Color palette:<select id="select_color" class="layer_settings"></select>
                            Positive/Negative:<select id="select_sign" class="layer_settings"></select>
                           
                            Pos. threshold:<div class='slider layer_settings' id='pos-threshold'></div>
                            Neg. threshold: <div class='slider layer_settings' id='neg-threshold'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gene Table Details -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Gene details </h2>  
                <table >
                    <ul ng-repeat="item in omics| filter:<?php echo $_GET["ID"]; ?>">
                        <li  ng-repeat="(key, val) in item">
                            {{key}} : {{val}}  
                        </li>        
                    </ul>
                </table>
            </div>
        </div>  


    </form>
    <script>document.write("<base href=\"" + document.location + "\" />");</script>
</body>
</html>
