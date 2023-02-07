@extends('layouts.app')
@section('title','All Bol Sheet| Unikoop')
@section('content')

<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Responsive Table</li>
                                        </ol>
                                    </div> -->
                                    <h2 class="page-title" style="color: blue";>All Bol Sheets</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="responsive-table-plugin">

                                            <div class="table-rep-plugin">
                                                <!-- <div class="row">
                                                    <div class="col-md-7"></div>
                                                    <div class="col-md-4">
                                                        <select class="form-select">
                                                            <option selected>Open this select menu</option>
                                                            <option value="1">DHL</option>
                                                            <option value="2">DPD</option>
                                                            <option value="3">DHL Today</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button" class="btn btn-primary width-xs waves-effect waves-light">Next</button>

                                                    </div>
                                                   </div> -->
                                                <div class="table-responsive">
                                                    <table id="tech-companies-1 " class="table table-striped mb-5" >
                                                        <thead>
                                                        <tr>

                                                            <th>Id</th>
                                                            <th >Product</th>
                                                            <th >BestelNummer</th>
                                                            <th >Postcode</th>
                                                            <th >Voomaam</th>
                                                            <th >Archternaam</th>
                                                            <th >BestelDatum</th>
                                                            <th >Orders</th>
                                                            <th >Choose</th>
                                                            <th>
                                                                <div class="">
                                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                                            <!-- select all boxes -->
                                                            <input type="checkbox" name="select-all" id="select-all" />
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="">
                                                        <tr>
                                                            <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                                <!-- <input type="submit" value="Submit"> -->
                                                              </form></td>
                                                              <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form>
                                                            </td>
                                                              <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck3">
                                                                    <label class="form-check-label" for="customCheck3">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form>
                                                            </td>
                                                              <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck4">
                                                                    <label class="form-check-label" for="customCheck4">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form></td>
                                                              <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck5">
                                                                    <label class="form-check-label" for="customCheck5">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                                <br><br>
                                                              </form>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck6">
                                                                    <label class="form-check-label" for="customCheck6">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form></td>
                                                              <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck7">
                                                                    <label class="form-check-label" for="customCheck7">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck8">
                                                                    <label class="form-check-label" for="customCheck8">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                              </form>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck9">
                                                                    <label class="form-check-label" for="customCheck9">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>62499</td>
                                                            <td class='has-details'>
                                                                EAN
                                                                <span class="details ">
                                                                <p>    <b>EAN</b>:2345698765<br>
                                                                   <b>Prijs</b>:24.95</p>
                                                                   <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                </span>
                                                              </td>
                                                            <td>6526484</td>
                                                            <td>9620</td>
                                                            <td>maaikee</td>
                                                            <td>schepens</td>
                                                            <td>November 4,22022, 9:43 am </td>
                                                            <td>1</td>
                                                            <td><form action="/action_page.php">
                                                                <label for="cars"></label>
                                                                <select name="cars" id="cars">
                                                                  <option value="opel">--Select--</option>
                                                                  <option value="DHL">DHL</option>
                                                                  <option value="DPD">DPD</option>
                                                                  <option value="DHL Today">DHL Today</option>
                                                                </select>
                                                               </form>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck10">
                                                                    <label class="form-check-label" for="customCheck10">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table >
                                                </div> <!-- end table-responsive -->
                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>

@endsection
