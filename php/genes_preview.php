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
        <script src="../js/genes_preview.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/genes_preview.css">
    </head>

    <body  ng-controller="omicsCtrl">
        <div class='container'>
            <div class='row'>
                <div class='col-md-10 col-md-offset-1'>
                    <h2>Gene preview</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-6 '>
                    <div class="row">
                        <div class="col-md-6">
                            <div class='view' id='view_coronal' class="col-md-12">
                                <canvas height='150' id='cor_canvas' width='150'></canvas>
                                <div class='slider nav-slider-vertical' id='nav-yaxis'  style="height:150px;"></div>
                            </div>
                            <div class='view' id='view_axial' class="col-md-12">
                                <canvas height='164' id='axial_canvas' width='150'></canvas>
                                <div class='slider nav-slider-vertical' id='nav-zaxis' style="height:164px"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="views_right">
                                <div class='view' id='view_sagittal'>
                                    <canvas height='150' id='sag_canvas' width='164'></canvas>
                                    <div class='slider nav-slider-horizontal' id='nav-xaxis' style="width:164px;"></div>
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

                <!--gene2-->
                <div class='col-md-6 '>
                    <div class="row">
                        <div class="col-md-6">
                            <div class='view' id='view_coronal2' style='margin-bottom:90px'>
                                <canvas height='150' id='cor_canvas' width='150'></canvas>
                                <div class='slider nav-slider-vertical' id='nav-yaxis2'  style="height:150px;"></div>
                            </div>
                            <div class='view' id='view_axial2' class="col-md-12">
                                <canvas height='164' id='axial_canvas' width='150'></canvas>
                                <div class='slider nav-slider-vertical' id='nav-zaxis2' style="height:164px"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="views_right">
                                <div class='view' id='view_sagittal2'>
                                    <canvas height='150' id='sag_canvas' width='164'></canvas>
                                    <div class='slider nav-slider-horizontal' id='nav-xaxis2' style="width:164px;"></div>
                                </div>
                                <div id="data_panel">
                                    <div class="data_display_row">
                                        <div class="data_label">Coordinates:</div>
                                        <div id="data_current_coords2"></div>
                                    </div>
                                    <div class="data_display_row">
                                        <div id="image_intent2" class="data_label">Initial value</div>
                                        <div id="data_current_value2"></div>
                                    </div>
                                </div>

                                <div id="layer_settings_panel">
                                    Color palette:<select id="select_color2" class="layer_settings"></select>
                                    Positive/Negative:<select id="select_sign2" class="layer_settings"></select>
                                    Pos. threshold:<div class='slider layer_settings' id='pos-threshold2'></div>
                                    Neg. threshold: <div class='slider layer_settings' id='neg-threshold2'></div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>	
            </div>
        </div>
        <!--Affichage tableau --> 
        <div class="row">
            <div class="col-md-6">
                <h3>Gene metadata</h3>  
                <form method="GET" action="overviewOmic.php"> 
                    <table ng-controller="omicsCtrl" border="1">
                        <ul ng-repeat="item in omics| filter:<?php echo $_GET["id1"]; ?>">
                            <li  ng-repeat="(key, val) in item">
                                {{key}} : {{val}}  
                            </li>        
                        </ul>
                    </table>
                </form>
            </div>
            <!--gene2 details-->
            <div class="col-md-6"> 
                <h3>Gene metadata </h3>  
                <form method="GET" action="overviewOmic.php"> 
                    <table ng-controller="omicsCtrl" border="1">
                        <ul ng-repeat="item in omics| filter:<?php echo $_GET["id2"]; ?>">
                            <li  ng-repeat="(key, val) in item">
                                {{key}} : {{val}}  
                            </li>        
                        </ul>
                    </table>
                </form>
            </div>
        </div>
        <script>document.write("<base href=\"" + document.location + "\" />");</script>

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

                    //gene2
                    viewer2 = new Viewer('#layer_list2', '.layer_settings');
                    viewer2.addView('#view_axial2', Viewer.AXIAL);
                    viewer2.addView('#view_coronal2', Viewer.CORONAL);
                    viewer2.addView('#view_sagittal2', Viewer.SAGITTAL);
                    viewer2.addSlider('opacity', '.slider#opacity2', 'horizontal', 0, 1, 1, 0.05);
                    viewer2.addSlider('pos-threshold', '.slider#pos-threshold2', 'horizontal', 0, 1, 0, 0.01);
                    viewer2.addSlider('neg-threshold', '.slider#neg-threshold2', 'horizontal', 0, 1, 0, 0.01);
                    viewer2.addSlider("nav-xaxis", ".slider#nav-xaxis2", "horizontal", 0, 1, 0.5, 0.01, Viewer.XAXIS);
                    viewer2.addSlider("nav-yaxis", ".slider#nav-yaxis2", "vertical", 0, 1, 0.5, 0.01, Viewer.YAXIS);
                    viewer2.addSlider("nav-zaxis", ".slider#nav-zaxis2", "vertical", 0, 1, 0.5, 0.01, Viewer.ZAXIS);

                    viewer2.addColorSelect('#select_color2');
                    viewer2.addSignSelect('#select_sign2');
                    viewer2.addDataField('voxelValue', '#data_current_value2');
                    viewer.addDataField('currentCoords', '#data_current_coords2');
                    viewer.addTextField('image-intent', '#image_intent2');
                    viewer.clear()

                    var img_id1 = "<?php echo $_GET["id1"]; ?>";
                    var img_id2 = "<?php echo $_GET["id2"]; ?>";

                    images = [
                        {
                            'url': '../data/' + img_id1 + '.nii',
                            'name': 'gene',
                            'colorPalette': 'yellow',
                            'intent': 'z-score:'
                        },
                        {
                            'url': '../data/' + img_id2 + '.nii',
                            'name': 'gene',
                            'colorPalette': 'intense red-blue',
                            'intent': 'z-score:'
                        },
                    ]
                    images2 = [
                        {
                            'url': '../data/MNI152.nii',
                            'name': 'MNI152 2mm',
                            'colorPalette': 'grayscale',
                            'cache': false,
                            'intent': 'Intensity:'
                        },
                        {
                            'url': '../data/' + img_id2 + '.nii',
                            'name': 'gene',
                            'colorPalette': 'intense red-blue',
                            'intent': 'z-score:'
                        },
                    ]
                    viewer.loadImages(images);
                    viewer2.loadImages(images2);

                });
        </script>
    </body>
</html>

