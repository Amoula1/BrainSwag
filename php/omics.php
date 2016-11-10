<!DOCTYPE html>
<html >
    <head>
        <title>BrainSwag</title>
        <meta charset="utf-8"/>
        <!-- Import javascript --> 
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="../js/omics_control.js"></script>
        <!-- Import plugins for the stylsheet --> 
        <link rel="stylesheet" type="text/css" href="../css/omics.css">
    </head>
    <body>
        <!-- Omics Metadata form -->
        <div class="container">
            <FORM  name="myForm" method="POST" ng-submit="onSubmit()" novalidate class="css-form"  >
                <div ng-app="app_omics" ng-controller="ctrl_omics" ng-init=""> 
                    <h3>Omics data</h3>

                    <label for="data.omics">Omics type:</label></tr> 
                    <select ng-model="data.omics">
                        <option value="">---Please select---</option>
                        <option value="Proteomics">Proteomics</option>
                        <option value="Geomics">Geomics</option>
                        <option value="Metabolomics">Metabolomics</option>
                    </select> 

                    <div ng-if="showMeForm()" class="animate-if">
                        <h2 ng-if="showMeProteomics()" class="animate-if">Proteomics</h2>
                        <h2 ng-if="showMeGeomics()" class="animate-if">Geomics</h2>
                        <h2 ng-if="showMeMetabolomics()" class="animate-if">Metabolomics</h2>

                        <label for="data.name" ng-if="showMeProteomics()" class="animate-if">Proteomics Name:</label>
                        <label for="data.name" ng-if="showMeGeomics()" class="animate-if" >Geomics Name:</label>
                        <label for="data.name" ng-if="showMeMetabolomics()" class="animate-if" >Metabolite Name:</label>
                        <input type="text" ng-model="data.name" name="Name" class="form-control">

                        <br><br>
                        <label for="data.id" ng-if="showMeProteomics()" class="animate-if">Proteomics ID:</label> 
                        <label for="data.id" ng-if="showMeGeomics()" class="animate-if">Geomics ID:</label> 
                        <label for="data.name" ng-if="showMeMetabolomics()" class="animate-if" >Metabolite ID:</label>   
                        <input type="text" ng-model="data.id" name="ID">

                        <br><br>
                        <label for="data.symbol" ng-if="showMeProteomics()" class="animate-if">Proteomics Symbol:</label> 
                        <label for="data.id" ng-if="showMeGeomics()" class="animate-if">Geomics Symbol:</label> 
                        <label for="data.name" ng-if="showMeMetabolomics()" class="animate-if" >Metabolite Symbol:</label>   
                        <input type="text" ng-model="data.symbol" name="Symbol">

                        <br><br>

                        <label for="data_species"> Species: </label>
                        <select name="Data_species" ng-model="data.species"> 
                            <option value="">---Please select---</option>
                            <option value="Human" onclick="hideFunction()">Human</option>
                            <option value="Rodent" onclick="hideFunction()">Rodent</option>
                            <option value="Non-Human" onclick="hideFunction()">Non-Human</option>
                            <option value="Non-Human primate"  onclick="hideFunction()" >Non-Human primate</option>
                            <option value="Other" onclick="showFunction()">Other</option>
                        </select>
                        <br>
                        <div id="viewOther" class="hide"> 
                            <label for="data.otherProteinSpecies">Other Species:</label>
                            <input type="text" ng-model="data.otherProteinSpecies"  name="Other_species">
                        </div> 
                        <br>
                        <label for="data.sample">Sample:</label>
                        <select ng-model="data.sample" name="Sample">
                            <option value="">---Please select---</option>
                            <option value="Blood" onclick="hideTissue()"  >Blood</option>
                            <option value="Tissue" onclick="showTissue()" >Tissue</option>
                            <option value="CSF" onclick="hideTissue()" >CSF</option>
                            <option value="Urine" onclick="hideTissue()" >Urine</option>
                            <option value="saliva" onclick="hideTissue()" >Saliva</option>
                            <option value="Other" onclick="otherSample()" >Other</option>
                        </select>
                        <br>
                        <div class="hide" id="sample"> 
                            <label for="data.otherSample">Other Sample:</label>
                            <input type="text" ng-model="data.otherSample" name="Other_sample"> 
                        </div>    
                        <br>
                        <div class="hide" id="tissue">   
                            <label for="data.tissueType">Tissue Type:</label> 
                            <select ng-model="data.tissueType"  name="Tissue_type">  
                                <option value="">---Please select---</option>
                                <option value="Muscle" onclick="hideTissueType()">Muscle</option>
                                <option value="Skin(epithelial)" onclick="hideTissueType()">Skin(epithelial)</option> 
                                <option value="Vascular" onclick="hideTissueType()">Vascular</option>
                                <option value="Brain"  onclick="showBrain()">Brain</option>
                                <option value="Other" onclick="otherTissueType()">Other</option>                 
                            </select> 
                        </div>     
                        <br>
                        <div class="hide" id="tissueType"> 
                            <label for="data.otherTissueType" >Other tissue type:</label>
                            <input type="text"  name="Other_tissue_type">
                        </div>   
                        <br> 
                        <div class="hide" id="brain">
                            <label for="data.BrainTissueType" >Brain Tissue Type:</label> 
                            <select ng-model="data.BrainTissueType" name="Brain_tissue_type">
                                <option value="">---Please select---</option>
                                <option value="Cerebral Vascular" onclick="hideOtherBrain()">Cerebral vascular</option>
                                <option value="Neuronal tissue" onclick="hideOtherBrain()">Neuronal tissue</option>
                                <option value="Whole brain" onclick="hideOtherBrain()">Whole brain</option>
                                <option value="Other" onclick="otherBrain()">Other</option>
                            </select>
                        </div>   
                        <br>
                        <div class="hide" id="otherBrain"> 
                            <label for="data.otherBrainTissueType"> Other_brain_tissue_type:</label>
                            <input type="text"  name="OtherBTT">    
                            <br> 
                            <label for="data.brainStructure">Brain Structure: </label>
                            <input type="text" ng-model="data.brainStructure" name="Brain_structure"> 
                        </div>   
                        <br>
                        <label for="data.humanState">Human State:</label> 
                        <select ng-model="data.humanState" name="Human_state">
                            <option value="">---Please select---</option>
                            <option value="Post-mortem" onclick="hideOtherHuman()">Post-mortem</option>
                            <option value="In-vivo" onclick="hideOtherHuman()">In-vivo</option>
                            <option value="Ex-vivo" onclick="hideOtherHuman()">Ex-vivo</option>
                            <option value="Other" onclick="otherHuman()">Other</option>
                        </select>
                        <br>
                        <div class="hide" id="otherHuman"> 
                            <label for="data.otherhumanState">Other Human state: </label>
                            <input type="text" ng-model="data.otherhumanState" name="Other_human_state">
                        </div>   
                        <br>    
                        <label for="data.experimentType" >Experiment type: </label> 
                        <input type="text" ng-model="data.experimentType" name="Experiment_type">   
                        <br><br>
                        <label for="data.experimentTitle" >Experiment title: </label> 
                        <input type="text" ng-model="data.experimentTitle" name="Experiment_title">  
                        <br><br>
                        <label for="experimentName">Experiment Name:</label> 
                        <select ng-model="data.experimentName" name="Experiment_name">
                            <option value="">---Please select---</option>
                            <option value="Immenosity" onclick="hideOtherExpName()">Immenosity</option>
                            <option value="Muno fluorence" onclick="hideOtherExpName()">Muno fluorence</option>
                            <option value="Sequencing" onclick="hideOtherExpName()">Sequencing</option>
                            <option value="Mass spectometry" onclick="hideOtherExpName()">Mass spectometry</option>
                            <option value="Other" onclick="otherExpName()">Other</option>
                        </select>  
                        <br>
                        <div class="hide" id="otherExpName"> 
                            <label for="data.otherExperimentName" >Other experiment name: </label>
                            <input type="text" ng-model="data.otherExperimentName"  name="Other_experiment_name"> 
                        </div>    
                        <br>
                        <label for="data.experimentMeasurement">Exp. Measurement:</label>  
                        <select ng-model="data.experimentMeasurement" name="Exp_Measurement">
                            <option value="">---Please select---</option>
                            <option value="Unchanged" onclick="hideC()">Unchanged</option>
                            <option value="Increase" onclick="hideC()">Increase</option>
                            <option value="Decrease" onclick="hideC()">Decrease</option>
                            <option value="Concentration" onclick="concentration()">Concentration</option>
                            <option value="Other" onclick="otherExpM()">Other</option>
                        </select> 
                        <br>
                        <div class="hide" id="otherExpM">
                            <label for="data.otherExperimentMeasurement" >Other experiment measurement: </label>
                            <input type="text" ng-model="data.otherExperimentMeasurement" name="Other_experiment_measurement">
                        </div> 
                        <br>
                        <div class="hide" id="concentration">
                            <label for="data.concentrationMin" >Concentration Min: </label>
                            <input type="number" ng-model="data.concentrationMin"  name="Concentration_min">
                            <br>
                            <label for="data.concentrationMax" >Concentration Max: </label>
                            <input type="number" ng-model="data.concentrationMax" name="Concentration_max">
                        </div>  
                        <br>
                        <label for="data.age" >Age: </label>
                        <input type="number" ng-model="data.age" name="Age">
                        <br>
                        <label >Gender:</label><br>
                        <input type="radio" name="gender"<?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female <br>
                        <input type="radio" name="gender"<?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
                        <br>
                        <br>     
                        <p>{{msg}}</p>

                        <input class="btn btn-info "type="submit" name="submit" value="submit"  onclick="add()" />
                        <input class="btn btn-info" type="reset" name='reset' value='reset'/>
                    </div>            
                </div>
            </form> 
        </div>

    </form>  

    <?php
    $Other_species = "";
    $OtherBTT = "";

    if (isset($_POST['Other_species']) && isset($_POST['Name']) && isset($_POST['ID']) && isset($_POST['Data_species']) && isset($_POST['OtherBTT'])) {

        $Name = $_POST['Name'];
        $ID = $_POST['ID'];
        $Symbol = $_POST['Symbol'];
        $Data_species = $_POST['Data_species'];
        $Other_species = $_POST['Other_species'];
        $Tissue_type = $_POST['Tissue_type'];
        $Other_tissue_type = $_POST['Other_tissue_type'];
        $Brain_tissue_type = $_POST['Brain_tissue_type'];
        $OtherBTT = $_POST['OtherBTT'];
        $Brain_structure = $_POST['Brain_structure'];
        $Human_state = $_POST['Human_state'];
        $Other_human_state = $_POST['Other_human_state'];
        $Experiment_type = $_POST['Experiment_type'];
        $Experiment_title = $_POST['Experiment_title'];
        $Experiment_name = $_POST['Experiment_name'];
        $Other_experiment_name = $_POST['Other_experiment_name'];
        $Exp_Measurement = $_POST['Exp_Measurement'];
        $Concentration_min = $_POST['Concentration_min'];
        $Concentration_max = $_POST['Concentration_max'];
        $Age = $_POST['Age'];
        $gender = $_POST['gender'];

        $user = new stdClass();

        $user->Name = $Name;
        $user->ID = $ID;
        $user->Symbol = $Symbol;
        $user->Species = $Data_species;
        $user->Other_species = $Other_species;
        $user->Tissue_type = $Tissue_type;
        $user->Other_tissue_type = $Other_tissue_type;
        $user->Brain_tissue_type = $Brain_tissue_type;
        $user->OtherBTT = $OtherBTT;
        $user->Brain_structure = $Brain_structure;
        $user->Human_state = $Human_state;
        $user->Other_human_state = $Other_human_state;
        $user->Experiment_type = $Experiment_type;
        $user->Experiment_title = $Experiment_title;
        $user->Experiment_name = $Experiment_name;
        $user->Other_experiment_name = $Other_experiment_name;
        $user->Exp_Measurement = $Exp_Measurement;
        $user->Concentration_min = $Concentration_min;
        $user->Concentration_max = $Concentration_max;
        $user->Age = $Age;
        $user->Gender = $gender;

        $data = json_encode(($user), JSON_PRETTY_PRINT);
        $filename = "../json/all_genes.json";
        $fh = fopen($filename, "a+");

        fwrite($fh, $data);
        fwrite($fh, "\n]");
        fclose($fh);

        $filename = "../txt/counter_genes.txt";
        $counter = file_exists($filename) ? file_get_contents($filename) + 1 : 1;
        file_put_contents($filename, $counter, LOCK_EX);
    }
    ?>

</body>
</html>

<!-- Count the total number of omics (gene, metabolite or protein) in its related file: counter_genes.txt, counter_metabolites.txt, counter_proteins.txt; -->
<!-- BE CAREFUL LATER YOU HAVE TO CHANGE THE FILENAME BY CONCATENATING THE OMICS TYPE IN THE "counter_+$omic_type$+.txt"-->
<!--JSON generation code for adding the omic to its json file -->
<!--BE CQREFUL WHERE TO ADD THE OMIC: all_$omic$.json !!!!! -->
