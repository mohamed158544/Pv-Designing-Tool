<?php include 'include/header.inc'; ?>

<?php
/****** cities ( lostMonth , lat , long) ****/
$cities = array('Mersa Matruh' => array('3', '31.354', '27.23'),
'Alex' => array('3', '31.20', '29.92'), 'Ismaila' => array('3.3', '30.5', '32.2'),
 'Suez' => array('3.5', '29.9', '32.5'), 'Giza' => array('3.4', '29.98', '31.2'),
  'Cairo' => array('3.4', '30.0', '31.2'), 'Asyut' => array('4', '27.18', '31.17'),
  'Luxor' => array('4.3', '25.69', '32.64'), 'Aswan' => array('4.5', '24', '32.89'),
  'Farafirah' => array('4', '27.06', '27.97'));
/****** cities ( lostMonth , lat , long) ****/

$panels = array('Polycrystaline', 'Monocrystaline');
$batteries = array('Lithium-ION', 'AGM');
$volts = array('12','24','48');

//const
$day_autonimy = 1;
$battery_loss = 0.85;
$inflation =  0.035;
$discount = 0.08 ;
$inverter_efficiency = 0.85 ;
$battery_efficiency = 0.85 ;
$peak_sun_hours =  5.06 ;
$DF = 0.8 ;

//$DOD = 50 / 100; //can change
$total_correction = 0.78; //losses
?>

<div class="image-container set-full-height"
     style="background-image: url('assets/img/background of the website.jpg');">

    <div class="logo-container">
        <div class="logo" style="width:30%;">

            <img src="assets/img/sce.png" width="100%">
        </div>

        <div class="brand">
            SolarCo Energy
        </div>
    </div>


    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1  ">

                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="green" id="wizard">

                        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>

                            <div class="wizard-header ">
                                <h3>
                                    <b> SolarCo </b><br>
                                    <small>There are various steps should be done to achieve a fully designed PV
                                        system.
                                    </small>
                                </h3>
                            </div>
                            <div class="wizard-navigation no-print">
                                <ul>
                                    <li><a href="#result" data-toggle="tab">Result</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="result">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php

                                            $country = $_POST['country'];

                                            $lastmonth_city = $cities[$country][0];
                                            $lat_city = $cities[$country][1];
                                            $long_city = $cities[$country][2];

                                            $area_width = $_POST['area_width'];
                                            $area_height = $_POST['area_height'];

                                            $total_area = $area_width * $area_height;

                                            ?>
                                            <fieldset style="padding: 1.35em .625em .75em; margin: 0 2px; border: 1px solid silver">
                                              <legend style="padding: 0;border: 0;margin-bottom:0px; width: auto;text-align: center; "> Location General parameters </legend>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td><?php echo $country; ?></td>
                                                    <th>Tilt Angle :</th>
                                                    <td> <?php echo round($long_city + 15); ?> &ordm;</td>

                                                </tr>
                                                <tr>
                                                    <th>Latitude :</th>
                                                    <td><?php echo $lat_city; ?></td>
                                                    <th>Longitude :</th>
                                                    <td><?php echo $long_city; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"> Location Layout</th>
                                                </tr>
                                                <tr>
                                                    <th> Width :</th>
                                                    <td><?php echo $area_width; ?>m</td>
                                                    <th> Height :</th>
                                                    <td> <?php echo $area_height; ?>m</td>
                                                </tr>
                                                <tr style="background-color: black;color: white">
                                                    <th> Total Area :</th>
                                                    <td colspan="4"> <?php echo $total_area; ?>m<sup>2</sup></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                        <!---       start area-------------->
                                        <!--
                                        <div class="col-sm-12 ">

                                            <?php
                                            $area_width = $_POST['area_width'];
                                            $area_height = $_POST['area_height'];

                                            $total_area = $area_width * $area_height;
                                            ?>

                                            <table class="table">
                                                <tbody class="load">
                                                <tr>
                                                    <th colspan="4"> Location Layout</th>
                                                </tr>
                                                <tr>
                                                    <th> Width :</th>
                                                    <td><?php echo $area_width; ?>m</td>
                                                    <th> Height :</th>
                                                    <td> <?php echo $area_height; ?>m</td>
                                                </tr>
                                                <tr style="background-color: black;color: white">
                                                    <th> Total Area :</th>
                                                    <td colspan="4"> <?php echo $total_area; ?>m<sup>2</sup></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                      -->
                                        <!-------------end area-------------->


                                        <!-------------start loads-------------->
                                        <div class="col-sm-12 ">

                                          <fieldset style="padding: 1.35em .625em .75em; margin: 0 2px; border: 1px solid silver">
                                            <legend style="padding: 0;border: 0;margin-bottom:0px; width: auto;text-align: center; "> Electric Load </legend>
                                            <table class="table">
                                                <thead>
                                                <!-- <tr>
                                                    <th colspan="12">Electric Load Estimation</th>
                                                </tr> -->
                                                <tr>
                                                    <th scope="col">Loads</th>
                                                    <th scope="col">WATTS</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col" colspan="2">use HRS/DAY</th>
                                                    <!-- <th scope="col">AVG HR/DAYs</th>  -->
                                                </tr>


                                                </thead>
                                                <tbody>
                                                <?php

                                                foreach ($_POST['load'] as $index => $value) {

                                                    $loads = $_POST['load'][$index];
                                                    $watt = $_POST['watt'][$index];
                                                    $qty = $_POST['qty'][$index];
                                                    $hour = $_POST['hour'][$index];
                                                  //  $day = $_POST['day'][$index];


                                                    $total_watt[$index] = round($watt);
                                                    $watt_load = $load_watt[$index] = round($watt * $qty);

                                                    // $Totalday = $use[$index] = round($watt_load * $hour);

                                                    $wat_avg=$avg_watt[$index] = round( ($watt_load / $inverter_efficiency) *  $hour );



                                                    // $wat_avg = $avg_watt[$index] = round($Totalday / $inverter_efficiency);

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $loads; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $watt; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $qty; ?>

                                                        </td>
                                                        <td colspan="2">
                                                            <?php echo $hour; ?>

                                                        </td>

                                                    </tr>

                                                <?php } ?>


                                                <tr style="background-color: black;color: white">
                                                    <td>Total WATT:</td>
                                                    <td> <?php echo array_sum($total_watt); ?> W</td>
                                                    <td> <?php echo array_sum($load_watt); ?> W</td>
                                                    <td> AVG Daily Load:</td>
                                                    <td> <?php echo array_sum($avg_watt); ?> Wh</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                          </fieldset>

                                        </div>
                                        <!-------------end loads-------------->


                                        <!-------------start panels-------------->
                                        <div class="col-sm-12 ">

                                            <?php
                                            $panel_type = $_POST['panel_type'];
                                            $panel_volt = $_POST['panel_volt'];
                                            $panel_power = $_POST['panel_power'];
                                            $panel_isc = $_POST['panel_isc'];

                                            $panel_width = $_POST['panel_width'];
                                            $panel_height = $_POST['panel_height'];

                                            $Generation_factor = $lastmonth_city * $total_correction;
                                            $Totaloutput = (array_sum($avg_watt) * 1.3) / ($Generation_factor * $battery_efficiency);
                                            $Max_panel_power = ($peak_sun_hours * $panel_power) ;
                                            $Number_panels = $Totaloutput / ($Max_panel_power * $DF);

                                            $panels_area = ($panel_height * $panel_width) * $Number_panels;


                                            ?>
                                            <fieldset style="padding: 1.35em .625em .75em; margin: 30px 2px; border: 1px solid silver">
                                              <legend style="padding: 0;border: 0;margin-bottom:0px; width: auto;    text-align: center; "> Panels </legend>
                                            <table class="table">
                                                <tbody class="load">
                                                <tr>
                                                    <th colspan="2">Panels Type :</th>
                                                    <td colspan="4"><?php echo $panel_type; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th> Vmp :</th>
                                                    <td><?php echo $panel_volt; ?> V</td>
                                                    <th colspan="2"> Pmax :</th>
                                                    <td colspan="2"><?php echo $panel_power; ?> W</td>

                                                </tr>

                                                <tr>
                                                  <th colspan="2"> Isc :</th>
                                                  <td colspan="4"> <?php echo $panel_isc; ?> A</td>
                                                </tr>
                                                <tr>
                                                    <th> Width :</th>
                                                    <td colspan="2"> <?php echo $panel_width; ?> m</td>
                                                    <th> Height :</th>
                                                    <td colspan="2"> <?php echo $panel_height; ?> m</td>
                                                </tr>
                                                <tr style="background-color: black;color: white">
                                                    <th> Generation factor :</th>

                                                    <td> <?php echo round($Generation_factor); ?></td>

                                                    <th> Total output required :</th>
                                                    <td> <?php echo round($Totaloutput); ?> W</td>

                                                    <th> Number of panels:</th>
                                                    <td> <?php echo ceil($Number_panels); ?> panels </td>
                                                </tr>

                                                <tr style="background-color: black;color: white">
                                                    <th> Total Area of the panels :</th>
                                                    <td colspan="6"> <?php echo ceil($panels_area); ?> m<sup>2</sup> </td>
                                                </tr>
                                                <?php
                                                if ($panels_area < $total_area){

                                                        $desc ="The area of the panels array is suitable for the assigned location";
                                                        $color = "green";
                                                }else {
                                                        $desc = "The area of the panels array is NOT suitable for the assigned location";
                                                        $color = "red";

                                              }?>

                                                <tr class="desc" style="background-color: black; color: <?php echo $color ;?>">
                                                    <td colspan="6">  <?php echo $desc; ?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                           </fieldset>
                                        </div>
                                        <!-------------end panels-------------->


                                        <!-------------start battery-------------->
                                        <div class="col-sm-12 ">


                                            <?php
                                            $battery_type = $_POST['battery_type'];
                                            $battery_volt = $_POST['battery_volt'];
                                            $battery_cap = $_POST['battery_cap'];
                                            $dod = $_POST['dod'] / 100;

                                            $Total_capacity = (array_sum($avg_watt) * $day_autonimy) / ($dod * $battery_volt);
                                            $number_panels_per_string = $panel_volt/$battery_volt ;
                                            $Solar_charge = 1.3 * $panel_isc * $number_panels_per_string ;
                                            $Number_battery = $Total_capacity / $battery_cap ;

                                            ?>
                                            <fieldset style="padding: 1.35em .625em .75em; margin: 0 2px; border: 1px solid silver">
                                              <legend style="padding: 0;border: 0;margin-bottom:0px; width: auto;text-align: center; "> Battery specifications </legend>
                                            <table class="table">
                                                <tbody class="load">
                                                <tr>
                                                    <th>Battery Type :</th>
                                                    <td colspan="6"><?php echo $battery_type; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th> volt :</th>
                                                    <td><?php echo $battery_volt; ?> V</td>
                                                    <th> CAP :</th>
                                                    <td><?php echo $battery_cap; ?> Ah</td>
                                                    <th> DOD :</th>
                                                    <td><?php echo $dod * 100; ?> %</td>

                                                </tr>
                                                <tr style="background-color: black;color: white">
                                                    <th> Total required capacity (Ah):</th>
                                                    <td colspan="2"> <?php echo round($Total_capacity); ?> Ah</td>

                                                    <th> Number of Battery:</th>
                                                    <td colspan="2"> <?php echo ceil($Number_battery); ?> batteries</td>
                                                </tr>


                                                <tr style="background-color: black;color: white">
                                                    <th> Number of panel per string :</th>
                                                    <td colspan="6"> <?php echo round($number_panels_per_string); ?></td>
                                                </tr>


                                                <tr style="background-color: black;color: white">
                                                    <th> Charge Controller Sizing</th>
                                                    <td colspan="6"> <?php echo round($Solar_charge); ?> A
                                                        at <?php echo $battery_volt; ?> V
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                          </fieldset>
                                        </div>
                                        <!-------------end battery-------------->


                                        <!-------------start inverting-------------->
                                        <div class="col-sm-12 ">

                                            <?php

                                            $inverter = array_sum($total_watt) * 0.3;
                                            $after = array_sum($total_watt) + $inverter;
                                            ?>


                                            <table class="table">
                                                <tbody class="load">
                                                <tr style="background-color: green;color: white">
                                                    <th colspan="6"> Inverter Selection</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        For safety, the inverter should be considered 25-30% bigger
                                                        size.<br>
                                                        The inverter size should be about <strong> <?php echo round ($after/1000); ?>
                                                            KW </strong> or greater.
                                                    </td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                        <!-------------end inverting-------------->

                                        <!-- start cost analysis -->

                                        <div class="col-sm-12 ">

                                              <?php
                                             $battery_cost = $_POST['battery_cost'];
                                             $panel_cost = $_POST['panel_price'];

                                            $Intial_batterycost = $battery_cost * $Number_battery ;

                                             $battery_costfirstperiod = $battery_cost * pow(((1+$inflation)/(1+$discount)),7) ;
                                             $battery_costsecondperiod = $battery_cost * pow(((1+$inflation)/(1+$discount)),14) ;

                                              $Total_batterycostfirstperiod = $battery_costfirstperiod * $Number_battery ;
                                              $Total_batterycostsecondperiod = $battery_costsecondperiod * $Number_battery ;

                                               $Total_panelcost = $panel_cost * $Number_panels ;

                                             $OM_cost = 0.02 * $Total_panelcost * (((1+$inflation)/(1+$discount)) * ((1-(pow((1+$inflation)/(1+$discount), 20)))/(1-(1+$inflation)/(1+$discount)))) ;

                                              $inverter_cost = $after / 2.3 ;
                                              $charge_controllercost = $Solar_charge * 11.748 ;

                                            $installation_cost = 0.1 * $Total_panelcost ;
                                            $LCC = ($Total_panelcost + $Intial_batterycost + $Total_batterycostfirstperiod + $Total_batterycostsecondperiod + $inverter_cost + $charge_controllercost + $OM_cost + $installation_cost) ;
                                          $ALCC = $LCC * ((1-(1+$inflation)/(1+$discount))/(1-(pow((1+$inflation)/(1+$discount), 20))));
                                              ?>
                                              <fieldset style="padding: 1.35em .625em .75em; margin: 0 2px; border: 1px solid silver">
                                                <legend style="padding: 0;border: 0;margin-bottom:0px; width: auto;text-align: center; "> Economic analysis </legend>
                                                  <table class="table">
                                                      <tbody class="load">
                                                        <tr style="background-color: black;color: white">
                                                            <th> Panels cost ($):</th>
                                                            <td colspan="4"> <?php echo ceil($Total_panelcost); ?> $</td>
                                                        </tr>
                                                        <tr style="background-color: black;color: white">
                                                            <th> Installation cost  ($):</th>
                                                            <td colspan="4"> <?php echo ceil($installation_cost); ?> $</td>
                                                        </tr>
                                                        <tr style="background-color: black;color: white">
                                                          <th> Betteries cost at the intial ($) :</th>
                                                          <td colspan="4"> <?php echo ceil($Intial_batterycost); ?> $</td>
                                                        </tr>
                                                        <tr style="background-color: black;color: white">
                                                          <th> Betteries cost in the first period ($) :</th>
                                                          <td colspan="4"> <?php echo ceil($Total_batterycostfirstperiod); ?> $</td>
                                                        </tr>

                                                        <tr style= "background-color: black;color: white">
                                                            <th> Batteries cost in the second period ($) :</th>
                                                            <td colspan="4"> <?php echo ceil($Total_batterycostsecondperiod); ?>  $</td>
                                                        </tr>
                                                        <tr style= "background-color: black;color: white">
                                                            <th> Estimated inverter cost ($) :</th>
                                                            <td colspan="2"> <?php echo ceil($inverter_cost); ?>  $ </td>

                                                            <th> Estimated charge controller cost ($) :</th>
                                                            <td colspan="2"> <?php echo ceil($charge_controllercost); ?> $</td>
                                                        </tr>
                                                        <tr style= "background-color: black;color: white">
                                                            <th> Operation and maintenance cost ($) :</th>
                                                            <td colspan="4"> <?php echo ceil($OM_cost); ?>  $ </td>
                                                        </tr>

                                                        <tr style= "background-color: black;color: white">
                                                            <th> Life cycle cost for 20 years ($) :</th>
                                                            <td colspan="4"> <?php echo ceil($LCC); ?>  $ </td>
                                                        </tr>

                                                        <tr style= "background-color: black;color: white">
                                                            <th> Annual Life cycle cost for 20 years ($) :</th>
                                                            <td colspan="4"> <?php echo ceil($ALCC); ?>  $ </td>
                                                        </tr>

                                                        </tbody>
                                                      </table>
                                                    </fieldset>
                                                  </div>
                                        <!-- end cost analysis -->
                                    </div>
                                </div>
                            </div>

                            <div class="wizard-footer no-print">
                                <div class="pull-right">
                                    <a href="index.php" class='btn btn-finish btn-fill btn-success btn-wd btn'>
                                        Finish
                                    </a>
                                </div>
                                <div class="pull-left">
                                    <a onclick="window.print();" class='btn btn-fill btn-warning btn-wd btn-sm'>
                                        Print </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>


                        <?php } else { ?>


                            <form action="index.php" method="POST">
                                <!--        You can switch ' data-color="green" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                                <div class="wizard-header">
                                    <h3>
                                        <b>PV</b> Calculator <br>
                                        <small>There are various steps should be done to achieve a fully designed PV
                                            system.
                                        </small>
                                    </h3>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#load" data-toggle="tab">load demand</a></li>
                                        <li><a href="#area" data-toggle="tab">Location Layout</a></li>
                                        <li><a href="#panels" data-toggle="tab">Panels types </a></li>
                                        <li><a href="#battery" data-toggle="tab">Battery sizing</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">

                                    <!--------start load demand------------------->

                                    <div class="tab-pane" id="load">
                                        <h4 class="info-text"> Let's start </h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">


                                                    <label><b>Select the Country</b></label><br>

                                                    <select name="country" class="form-control">
                                                        <option></option>
                                                        <?php


                                                        foreach ($cities as $city => $value) { ?>

                                                            <option value="<?php echo $city; ?>"> <?php echo $city; ?></option>

                                                        <?php } ?>
                                                    </select>


                                                </div>
                                            </div>

                                            <div class="col-sm-12 ">

                                                <table class="table">

                                                    <thead>
                                                    <tr>
                                                        <th colspan="6"> Electric Appliance</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Loads</th>
                                                        <th scope="col">WATTS</th>
                                                        <th scope="col">QTY</th>
                                                        <th scope="col">Use HRS/DAY</th>
                                                        <!-- <th scope="col">Use DAYS/WK</th> //-->
                                                        <th scope="col" class="center">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-primary m-auto"
                                                                    onclick="addInputFile('load',5)">
                                                                <i class="fa fa-plus "></i>    <!-- the is the bar for add more appliances tabs //-->
                                                            </button>
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody class="load">

                                                    <tr>
                                                        <td>
                                                            <input name="load[]" type="text" class="form-control"
                                                                   placeholder="Name">
                                                        </td>
                                                        <td>
                                                            <input name="watt[]" type="number" class="form-control"
                                                                   placeholder="Watts" min="0" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <input name="qty[]" type="number" class="form-control"
                                                                   placeholder="QTY" min="1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <input name="hour[]" type="number" class="form-control"
                                                                   placeholder="HRs/Day" min="0" autocomplete="off">
                                                        </td>
                                                        <!--
                                                        <td>
                                                            <input name="day[]" type="number" class="form-control"
                                                                   placeholder="Days/wk" min="0" autocomplete="off">
                                                        </td>
                                                        //-->
                                                        <th scope="col" class="center">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-danger m-auto"
                                                                    onclick= "removeInputFile(this)">
                                                                <i class="fa fa-minus"></i>    <!-- the is the bar for add more appliances tabs //-->
                                                            </button>
                                                        </th>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div hidden class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Rent price</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                               placeholder="Rent price per day">
                                                        <span class="input-group-addon">$</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-------------end load demand--------------------->


                                    <!-------------start location area----------------->

                                    <div class="tab-pane " id="area">
                                        <h4 class="info-text">Layout Design </h4>

                                        <div class="row">


                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <label>Width (m):</label>
                                                    <input name="area_width" class="form-control" type="number" min="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <label> Length (m):</label>
                                                    <input name="area_height" class="form-control" type="number"
                                                           min="0">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-------------end location area------------------->


                                    <!-------------start panels----------------->

                                    <div class="tab-pane" id="panels">
                                        <h4 class="info-text">Select the panel type</h4>

                                        <div class="row">

                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Panel Type</label>
                                                    <select class="form-control" name="panel_type">
                                                        <option disabled="" selected="">-Select type -</option>

                                                        <?php foreach ($panels as $panel) { ?>

                                                            <option value="<?php echo $panel ?>"> <?php echo $panel ?></option>

                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label>Voltage (Vmp):</label>
                                                    <input name="panel_volt" class="form-control" id="volt_panel"
                                                           type="number" min="0">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Maximum Power (Pmax):</label>
                                                    <input name="panel_power" class="form-control"
                                                           type="number" min="0">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Short Circuit Current (Isc):</label>
                                                    <input name="panel_isc" class="form-control" type="number" min="0">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-sm-offset-0">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Width (m):</label>
                                                        <input name="panel_width" class="form-control" type="number"
                                                               min="0">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label> Length (m):</label>
                                                        <input name="panel_height" class="form-control" type="number"
                                                               min="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- my eddites -->
                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label> Panel Price ($):</label>
                                                    <input name="panel_price" class="form-control" id="price_panel"
                                                           type="number" min="0">
                                                </div>
                                            </div>


                                            <div class="col-sm-10 " style="color: red">
                                                <span> *Hint: <br>
                                                  If you need to know more about panels types:
                                                </span>
                                                <ul>
                                                    <li><a target="_blank"
                                                           href="https://www.solaris-shop.com/polycrystalline/">polycrystaline</a>
                                                    </li>
                                                    <li><a target="_blank"
                                                           href="https://www.solaris-shop.com/monocrystalline/">Monocrystaline</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="row" style="display: none">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <?php foreach ($panels as $panel => $value) { ?>
                                                    <div class="col-sm-3">
                                                        <div class="choice" data-toggle="wizard-radio" rel="tooltip">
                                                            <input type="radio" name="panel"
                                                                   value="<?php echo $value; ?>">
                                                            <div class="icon">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <h6><?php echo $panel; ?></h6>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-------------end panels------------------->


                                    <!-------------start battery---------------->

                                    <div class="tab-pane" id="battery">
                                        <h4 class="info-text">Select the battery type</h4>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Battery type</label>
                                                    <select class="form-control" name="battery_type">
                                                        <option disabled="" selected="">- type -</option>

                                                        <?php foreach ($batteries as $battery) { ?>

                                                            <option value="<?php echo $battery ?>"> <?php echo $battery ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label>Nominal Voltage (volt) </label>

                                                    <select class="form-control" name="battery_volt" type = "number" min = "12">
                                                        <option disabled="" selected="">- volt -</option>

                                                        <?php foreach ($volts as $volt) { ?>

                                                            <option value="<?php echo $volt ?>"> <?php echo $volt ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label>Nominal Capacity (Ah):</label>
                                                    <input name="battery_cap" class="form-control" type="number"
                                                           min="0">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label>DOD:</label>
                                                    <small style="color: red">(If Known)</small>
                                                    :
                                                    <input name="dod" class="form-control" type="number" value="60"
                                                           min="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group">
                                                    <label>Battery price ($):</label>
                                                    <input name="battery_cost" class="form-control" type="number"
                                                           min="0">
                                                </div>
                                            </div>


                                            <div class="col-sm-10 " style="color: red">
                                                <span> *Hint: <br>
                                                    If you need to know more about battery types:
                                                </span>
                                                <ul>
                                                    <li><a target="_blank"
                                                           href="https://www.solar-electric.com/learning-center/agm-battery-technology.html/">AGM</a></li>
                                                    <li><a target="_blank"
                                                           href="https://www.solar-electric.com/learning-center/lithium-battery-technology.html/">Lithium</a></li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>

                                    <!-------------end battery------------------>


                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <!--                                    name='next'-->
                                        <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm'
                                               value='Next'/>
                                        <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd btn-sm'
                                               name='finish' value='Send'/>

                                    </div>
                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm'
                                               name='previous' value='Previous'/>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </form>

                        <?php } ?>
                    </div>
                </div > <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->
</div>


<?php include 'include/footer.inc'; ?>


<!-------------------javascript-------------------->
<script>

    function addInputFile(table_name, equ = 5) {
        var length = $("." + table_name + " tr").length + 1
        // clone first tr
        var cloned = $("." + table_name + " tr:first").clone();
        $(cloned).find("input").val(""); //empty values of all cloned inputss
        $(cloned).find("input").not('input[type="hidden"]').val(""); //empty values of all cloned inputss
        $(cloned).find("td:eq(" + equ + ")").html('<button type="button" class="btn btn-sm btn-danger " onclick="removeInputFile(this)" > <i class="fa fa-times"></i></button>'); //add `i` value
        $(cloned).appendTo($("." + table_name + "")) //append to tbody
    }

    function removeInputFile(ele) {
        $(ele).parents("tr").remove();

    }


    $('#volt_panel').change(function () {
        $('#volt_battery').val($(this).val());
    });


    //    if (window.history.replaceState) {
    //        window.history.replaceState(null, null, window.location.href);
    //    }

</script>
<!-------------------javascript-------------------->
