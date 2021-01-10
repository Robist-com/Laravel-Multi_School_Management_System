<head>
  <title> Student Report Card </title>
  {{-- <h2> Student Report Card </h2> --}}
  <!-- Latest compiled and minified CSS -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
<style>
  hr{
    border: 2px solid rgb(1, 40, 49);
  }
</style>
 <div class="container-fluid">
    <section>

  <table style="width:100%" class="header-title">
  <tr>
  <td   style="text-align: left">
 <span style="line-height:1.6; font-weight: bold; text-transform:uppercase">
    <img src="{{ asset('institute_logo/default_logo.jpg') }}" width="150" alt="">
  </span>
  </td>
  <td   style="text-align: right">
  
   <span style="line-height:1.3; font-weight: bold; text-transform:uppercase; font-family:'Times New Roman', Times, serif">
  Angle Rue Dumez et Multidor, Maïs Gâté <br>
  Port-au-Prince, Haïti <br>
  www.amusarts.net  <br>
  50937436044 <br>
  pmucommunucatiion@gmail.com
  </span>
  </td>

  </tr>
  </table>
  <hr>
  <div class="" style="text-align: center !important">
            <b >BULLETIN SCOLAIRE <br>
          Année Scolaire 2019 -2020</b>
  </div>

  <table style="width:100%" class="header-title">
  <tr>
  <td   style="text-align: left">
 <span style="line-height:1.6; font-weight: bold; text-transform:uppercase">
   <label for="">Nom: </label> &nbsp;
   <span> Ismaël</span> <br>

   <label for="">Prénom: </label> &nbsp;
   <span> JOSEPH </span>
  </span>
  </td>
  <td  style="text-align: right">
   <span style="line-height:1.6; font-weight: bold; text-transform:uppercase">
    <label for="">Class: </label> &nbsp;
   <span> </span> <br>

   <label for="">Période: </label> &nbsp;
   <span>  7 Jan - 14 Fév 2020 </span>
  </span>
  </td>

  </tr>
  </table>

  <style>
  .rotate_text {
    writing-mode: vertical-lr;
    -webkit-writing-mode: vertical-lr;
    -ms-writing-mode: vertical-lr;
    -webkit-transform: rotate(-180deg);
    -moz-transform: rotate(-180deg);
    -o-transform: rotate(-180deg);
    transform: rotate(-180deg);
}

.rotated_cell {
    width: 10%;
    text-align: center !important;
    vertical-align: bottom;
    padding: 1px;
    padding-bottom: 10px;
    padding-top: 20px;
    background:#FFE4E1;
}

.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
  </style>

 
      <div class="row">
  <div class="col-sm-5">
    <div class="card">
      <div class="card-body">
        <table>
    <thead>
      <tr>
        <td  class="td1" colspan="3" align="right"><b>Période</b> </td>
        <td  class="td-body rotated_cell" rowspan="3"> <div class="rotate_text"> coefficients</div> </td>
        <td  class="td" colspan="4"> <b>1er Contrôle</b> </td>
        <td  class="td-body rotated_cell" rowspan="3"> <div class="rotate_text">Mention</div> </td>
      </tr>
      <tr>
        <td  class="td-body" colspan="3">Matières </td>
        <td  class="td-body1" colspan="1"> 20% </td>
        <td  class="td-body1" colspan="1"> 20% </td>
        <td  class="td-body1"> 60% </td>
        <td  class="td-body1"> 100% </td>
      </tr>
      <tr>
        <td  class="td" colspan="3" style="font-size: 12px; background:#FFE4E1">Langues, Littératures Et Art  </td>
        <td  class="td-body" style="background:#FFE4E1;"> DT </td>
        <td  class="td-body" style="background:#FFE4E1;"> TT </td>
        <td  class="td-body" style="background:#FFE4E1;"> EF </td>
        <td  class="td-body" style="background:#FFE4E1;"> NT </td>
      </tr>
      
    </thead>
    <tbody>
      <tr>
        <td  class="td" rowspan="7"></td>
        <td  class="td" colspan="2">Data Structures </td>
        <td  class="td-body"> 100</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A </td>
        <td  class="td-body"> 12.0 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>

      </tr>
      <tr>
        {{-- <td  class="td"> </td> --}}
        <td  class="td" colspan="2">Ethics </td>
        <td  class="td-body"> 100</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>

      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Digital Signal Processing </td>
        <td  class="td-body"> 100</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A </td>
        <td  class="td-body"> 12 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>

      </tr>
      <tr>
        {{-- <td  class="td"> </td> --}}
        <td  class="td" colspan="2">Combinatorial Algorithms </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> B+ </td>
        <td  class="td-body"> 9.99</td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>

      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Multi-Variable Calculus </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
       <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Multi-Variable Calculus </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
       <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Multi-Variable Calculus </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>

       <tr>
        <td  class="td" rowspan="5"></td>
        <td  class="td" colspan="2">Mathématiques: Algèbre</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2"><b style="font-size: 14px">Mathématiques: Géométrie</b></td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Sciences Physiques</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Informatique</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        {{-- <td  class="td"></td> --}}
        <td  class="td" colspan="2">Électricité Bâtiment</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>

       <tr>
        <td  class="td" rowspan="7"></td>
        <td  class="td" colspan="2"><b style="font-size: 14px">Sciences Expérimentales </b></td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Éducation Sexuelle </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Sciences Expérimentales</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Sciences Expérimentales</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Sciences Expérimentales </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Sciences Expérimentales</td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="2">Sciences Expérimentales </td>
        <td  class="td-body">200</td>
        <td  class="td-body"> 3.0 </td>
        <td  class="td-body"> A- </td>
        <td  class="td-body"> 10.98 </td>
        <td  class="td-body"> 200</td>
        <td  class="td-body"> </td>
      </tr>

       
    </tbody>
    <tfoot>
      <tr>
        <td class="td-footer" rowspan="3"></td>
        <td  class="td1" colspan="4" class="footer" align="right">Sur</td>
        <td  class="td"> 2800</td>
        <td  class="td"> Total</td>
        <td  class="td" colspan="2" align="center" ><b>2800</b></td>
      </tr>
      <tr>
        <td  class="td-footer1" colspan="4" rowspan="2" class="footer" align="right">Nombre d’élèves</td>
        <td  class="td" >10</td>
        <td  class="td" >Moyenne</td>
        <td  class="td" colspan="2"></td>
        {{-- <td  class="td" colspan="2"></td> --}}
      </tr>
       <tr>
        {{-- <td  class="td" colspan="4" rowspan="2" class="footer" align="right">Nombre d’élèves</td> --}}
        <td  class="td" ></td>
        <td  class="td" >Place</td>
        <td  class="td" colspan="2"></td>
        {{-- <td  class="td" colspan="2"></td> --}}
      </tr>
  </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
<table>
    <thead>
      <tr>
        <td  colspan="3" align="right"></td>
        <td  class="td" colspan="4" style="background:#FFE4E1"> <b>Observations</b> </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">Retard </td>
        <td  class="td" colspan="4">  </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">Absence </td>
        <td  class="td" colspan="4">  </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">Respect + Discipline  </td>
        <td  class="td" colspan="4"> </td>
      </tr>
       <tr>
        <td  class="td" colspan="3"><b>Solidarité + Participation</b> </td>
        <td  class="td" colspan="4"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">Esprit de services  </td>
        <td  class="td" colspan="4"> </td>
      </tr>
    </thead>
</table>
<br>
<table>
    <thead >
      <tr>
        <td  class="td" colspan="3" align="center" style="background:#FFE4E1">Moyenne </td>
        <td  class="td" colspan="4" style="background:#FFE4E1"> <b>Observations</b> </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">Retard </td>
        <td  class="td" colspan="4">  </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">Absence </td>
        <td  class="td" colspan="4">  </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">Respect + Discipline  </td>
        <td  class="td" colspan="4"> </td>
      </tr>
       <tr>
        <td  class="td" colspan="3"><b>Solidarité + Participation</b> </td>
        <td  class="td" colspan="4"> </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">Esprit de services  </td>
        <td  class="td" colspan="4"> </td>
      </tr>
    </thead>
</table>
<br>
<table>
    <thead >
      <tr>
        <td  colspan="3" align="left" style="background:#FFE4E1"><b>Légende</b></td>
        <td  class="td1" colspan="4" > </td>
        <td  class="td1" colspan="4" > </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">Mention  </td>
        <td  class="td" colspan="4"> Équivalence </td>
        <td  class="td" colspan="4"> DT: Devoir total </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">EX : Excellent </td>
        <td  class="td" colspan="4"> A= (90-100) </td>
        <td  class="td" colspan="4"> TT=Test total </td>
      </tr>
       <tr>
        <td  class="td" colspan="3">TB= Très Bien </td>
        <td  class="td" colspan="4"> B= (80-89) </td>
        <td  class="td" colspan="4"> EF: évaluation finale </td>
      </tr>
       <tr>
        <td  class="td" colspan="3"><b>AB= Assez Bien</b> </td>
        <td  class="td" colspan="4"> C= (70-79)  </td>
        <td  class="td" colspan="4"> Nt=Notes Totales </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">AB= Assez Bien </td>
        <td  class="td" colspan="4"> D= (50-69)</td>
        <td  class="td" colspan="4"> ITAP: Initiation à la Technologie et aux </td>
      </tr>
      <tr>
        <td  class="td" colspan="3">TF: Très Faible  </td>
        <td  class="td" colspan="4"> E : (≤49) </td>
        <td  class="td" colspan="4"> Activités Productive</td>
      </tr>
    </thead>
</table>
      </div>
    </div>
  </div>
</div>

 </section>
  </div>
  {{-- <div class="row" style="margin-top: 3%">
  <div class="column">
 
  </div>     

  <div class="column">


</div>
</div> --}}
</body>
<style>

  html {
  font-family:arial;
  font-size: 18px;
}

.card{
  border: none !important;
}

.td{
  border: 1px solid #726E6D;
  padding: 10px;
  /* width: 1em !important; */
  font-size: 13px;
  line-height: 1.4px;
  height: 0.5em !important;
}

.td-body{
  border: 1px solid #726E6D;
  padding: 10px;
  width: 1em !important;
  font-size: 13px;
  line-height: 1px;
  text-align: center !important;
  height: 0em !important;
}

.td-body1{
  border: 1px solid #726E6D;
  padding: 10px;
  width: 1em !important;
  font-size: 10px;
  line-height: 1px;
  text-align: center !important;
  height: 0em !important;
}

.td-footer{

  border-left: 1px solid #726E6D;
  border-bottom: 1px solid #726E6D;
  padding: 15px;
}

.td-footer1{

  /* border-left: 1px solid #726E6D; */
  border-bottom: 1px solid #726E6D;
  padding: 15px;
}

thead{
  font-weight:bold;
  text-align:center;
  /* background: #625D5D; */
  color:rgb(3, 3, 3);
}

table {
  border-collapse: collapse;
}

.footer {
  text-align:right;
  font-weight:bold;
}

tbody >tr:nth-child(odd) {
  /* background: #D1D0CE; */
}

</style>