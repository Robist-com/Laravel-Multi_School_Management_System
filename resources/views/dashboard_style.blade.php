<style>
    .alert{
        background:#F6E3E3;
        font-family: "Times New Roman", Times, serif;
        /* text-decoration: none; */
        font-size: 18px;
        font-weight: bold;
        cursor: progress;

    }
    .alert > a {
      text-decoration: none;
      color: black;
      cursor: progress;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .alert {
      width: 13vw;
      min-height: 50px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      z-index: 1;
    }

    .alert  {
      position: relative;
      min-height: 50px;
      background: #f2f2f2;
      overflow: hidden;
      transition: all 0.5s ease-in;
      z-index: 1;
      box-sizing: border-box;
      padding: 30px;
      padding-left: 30px;

      box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
    }

    .alert::after {
      content: '\225D';
      position: absolute;
      bottom: -10%;
      right: 5%;
      font-size: 120px;
      opacity: 0.2;
      background: transparent;
      filter: invert(1);
      pointer-events: none;
    }

    .alert{
      margin: 0;
      padding: 10px;
    }

    .alert:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }

    .alert > a:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }

    .alert:hover{
      opacity: 1;
      background: #e2a9e5;
    background: -moz-linear-gradient(-45deg, #e2a9e5 15%, #2b94e5 100%);
    background: -webkit-linear-gradient(-45deg, #e2a9e5 15%,#2b94e5 100%);
    background: linear-gradient(135deg, #e2a9e5 15%,#2b94e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2a9e5', endColorstr='#2b94e5',GradientType=1 );
    }

    .alert:hover {
      opacity: 1;
      background: #632c65;
    background: -moz-linear-gradient(-45deg, #632c65 15%, #56a5e2 100%);
    background: -webkit-linear-gradient(-45deg, #632c65 15%,#56a5e2 100%);
    background: linear-gradient(135deg, #632c65 15%,#56a5e2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#632c65', endColorstr='#56a5e2',GradientType=1 );
    }

    .alert:hover,
    .alert:hover{
      opacity: 1;
      background: #4b384c;
    background: -moz-linear-gradient(-45deg, #4b384c 15%, #da5de2 100%);
    background: -webkit-linear-gradient(-45deg, #4b384c 15%,#da5de2 100%);
    background: linear-gradient(135deg, #4b384c 15%,#da5de2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b384c', endColorstr='#da5de2',GradientType=1 );
    }

    #dashbaord i {
        margin-top: 25px;
        font-size: 21px;
        text-align: center;
        animation: fadein 2s;
        -moz-animation: fadein 2s; /* Firefox */
        -webkit-animation: fadein 2s; /* Safari and Chrome */
        -o-animation: fadein 2s; /* Opera */
    }
    @keyframes fadein {
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-moz-keyframes fadein { /* Firefox */
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-webkit-keyframes fadein { /* Safari and Chrome */
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-o-keyframes fadein { /* Opera */
        from {
            opacity:0;
        }
        to {
            opacity: 3;
        }
    }

    .panel-body:hover,
    .panel-body:hover{
      opacity: 1;
      background: #e2a9e5;
    background: -moz-linear-gradient(-45deg, #e2a9e5 15%, #2b94e5 100%);
    background: -webkit-linear-gradient(-45deg, #e2a9e5 15%,#2b94e5 100%);
    background: linear-gradient(135deg, #e2a9e5 15%,#2b94e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2a9e5', endColorstr='#2b94e5',GradientType=1 );
    }

    .panel:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }
    .panel{
        background:#ECE9E9;
        box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
    }


/* DAHBOARD 2 STAYLE SHET */

.alert-2{
        background:#F6E3E3;
        font-family: "Times New Roman", Times, serif;
        /* text-decoration: none; */
        font-size: 18px;
        font-weight: bold;
        cursor: progress;

    }
    .alert-2 > a {
      text-decoration: none;
      color: black;
      cursor: progress;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .alert-2 {
      width: 18vw;
      min-height: 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      z-index: 1;
    }

    .alert-2  {
      position: relative;
      min-height: 50px;
      background: #f2f2f2;
      overflow: hidden;
      transition: all 0.5s ease-in;
      z-index: 1;
      box-sizing: border-box;
      padding: 30px;
      padding-left: 30px;

      box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
    }

    .alert-2::after {
      content: '\225D';
      position: absolute;
      bottom: -10%;
      right: 5%;
      font-size: 120px;
      opacity: 0.2;
      background: transparent;
      filter: invert(1);
      pointer-events: none;
    }

    .alert-2{
      margin: 0;
      padding: 10px;
    }

    .alert-2:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }

    .alert-2 > a:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }

    .alert-2:hover{
      opacity: 1;
      background: #e2a9e5;
    background: -moz-linear-gradient(-45deg, #e2a9e5 15%, #2b94e5 100%);
    background: -webkit-linear-gradient(-45deg, #e2a9e5 15%,#2b94e5 100%);
    background: linear-gradient(135deg, #e2a9e5 15%,#2b94e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2a9e5', endColorstr='#2b94e5',GradientType=1 );
    }

    .alert-2:hover {
      opacity: 1;
      background: #632c65;
    background: -moz-linear-gradient(-45deg, #632c65 15%, #56a5e2 100%);
    background: -webkit-linear-gradient(-45deg, #632c65 15%,#56a5e2 100%);
    background: linear-gradient(135deg, #632c65 15%,#56a5e2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#632c65', endColorstr='#56a5e2',GradientType=1 );
    }

    .alert-2:hover,
    .alert-2:hover{
      opacity: 1;
      background: #4b384c;
    background: -moz-linear-gradient(-45deg, #4b384c 15%, #da5de2 100%);
    background: -webkit-linear-gradient(-45deg, #4b384c 15%,#da5de2 100%);
    background: linear-gradient(135deg, #4b384c 15%,#da5de2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b384c', endColorstr='#da5de2',GradientType=1 );
    }

    #dashbaord i {
        margin-top: 25px;
        font-size: 21px;
        text-align: center;
        animation: fadein 2s;
        -moz-animation: fadein 2s; /* Firefox */
        -webkit-animation: fadein 2s; /* Safari and Chrome */
        -o-animation: fadein 2s; /* Opera */
    }
    @keyframes fadein {
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-moz-keyframes fadein { /* Firefox */
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-webkit-keyframes fadein { /* Safari and Chrome */
        from {
            opacity:0;
        }
        to {
            opacity:3;
        }
    }
    @-o-keyframes fadein { /* Opera */
        from {
            opacity:0;
        }
        to {
            opacity: 3;
        }
    }

    .panel-body:hover,
    .panel-body:hover{
      opacity: 1;
      background: #e2a9e5;
    background: -moz-linear-gradient(-45deg, #e2a9e5 15%, #2b94e5 100%);
    background: -webkit-linear-gradient(-45deg, #e2a9e5 15%,#2b94e5 100%);
    background: linear-gradient(135deg, #e2a9e5 15%,#2b94e5 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2a9e5', endColorstr='#2b94e5',GradientType=1 );
    }

    .panel:hover {
      color: #CA0A0A;
      box-shadow: 20px 50px 100px rgba(0, 0, 0, 0.5);
    }
    .panel{
        background:#ECE9E9;
        box-shadow: -10px 25px 50px rgba(0, 0, 0, 0.3);
    }



    </style>
