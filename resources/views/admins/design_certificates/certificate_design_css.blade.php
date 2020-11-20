
<style>
.column-title{
    text-align:center;
}

span.checkboxdesign-target {
  font-family: FontAwesome; 
  /* Use an icon font for the checkbox */
}

input[type='checkbox'].checkboxdesign {
  position: relative;
  left: -999em; /* Hide the real checkbox */
  cursor:pointer;
}

input[type='checkbox'].checkboxdesign + span.checkboxdesign-target:after {
  content: "\f055"; /* In fontawesome, is an open square (fa-square-o) */
  cursor:pointer;
  color:green;
}

input[type='checkbox'].checkboxdesign:checked + span.checkboxdesign-target:after {
  content: "\f05c"; /* fontawesome checked box (fa-check-square-o) */
  color:red;
  cursor:pointer;
  
}

span.checkboxdesign {
  /* display: block; */
  /* padding: 0.5em; */
  font-size: 1.5em; 
  cursor:pointer;
}

/* .checkboxdesign{
    width:15px;
    height:15px;
} */

span.bigcheck-target {
  font-family: FontAwesome; /* Use an icon font for the checkbox */
}

input[type='checkbox'].bigcheck {
  position: relative;
  left: -999em; /* Hide the real checkbox */
  cursor:pointer;
}

input[type='checkbox'].bigcheck + span.bigcheck-target:after {
  content: "\f096"; /* In fontawesome, is an open square (fa-square-o) */
  cursor:pointer;
}

input[type='checkbox'].bigcheck:checked + span.bigcheck-target:after {
  content: "\f046"; /* fontawesome checked box (fa-check-square-o) */
  color:green;
  cursor:pointer;
  
}

span.bigcheck {
  display: block;
  padding: 0.5em;
  font-size: 2em; 
  cursor:pointer;
}


.checked {
    color: green;
  }
  .unchecked {
    color: red;
  }

  .collapse-link:after {
    /* symbol for "opening" panels */
    font-family:'FontAwesome';
    content:"\f146";
    /* float: right; */
    color: inherit;
}
 .collapse-link:before {
    /* symbol for "collapsed" panels */
    content:"\f0fe";
}


</style>