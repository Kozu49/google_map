<!DOCTYPE html>
<html>
  <head>
    <base target="_top">
     <title>Form Example</title>
     <style>
      .card-header {
          background-color: #007bff;
          color: white;
          padding: 10px;
          text-align: center;
          width:100%;
      }

      .card-title {
          margin-bottom: 0;
          color: black;
      }

      .card-body {
            width: 100%;
          padding: 20px;
          text-align:left;
      }

      .form-group {
          margin-bottom: 20px;
      }

      .btn-primary {
          width: 100%;
      }

      .card {
          width: 90%;
          max-width: 100px;
          margin: 0 auto;
      }

      @media (min-width: 576px) {
          .card {
              max-width: 1000px;
            display: flex; /* Add this line to enable flexbox layout */
            flex-direction: column; /* Add this line to set flex direction to column */
            align-items: center; /* Add this line to center align content horizontally */
              }
      }

      /* New styles for mobile responsiveness */

      .container {
          padding-left: 15px;
          padding-right: 15px;
          margin-right: auto;
          margin-left: auto;
          text-align:center;
      }

      @media (max-width: 576px) {
          .card {
              max-width: 100%; /* Set maximum width to 100% on small screens */
          }
      }

        html{
          height:100% !important;
        }
        body {
            background-image: url('https://wallpaperaccess.com/full/1128998.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            
        }
    </style>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Add Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  </head>

  <body>
  <div class="container mt-5">
    <div id="header-left">
        <h3 id="emb-name">
            <a href="/itprtop_en/index.html">
                <strong class="embname-main" style="color:#000066; text-bold">Embassy of Japan in Nepal</span> <br>
                <span class="embname-sub">
                    <span class="embname-logo"><img src="https://www.np.emb-japan.go.jp/files/100002131.png" alt="Japan national flag"></span>
                    <span class="embname-text" lang="ne" style="color:#000066;">जापानी राजदुतावास</span>
                </span>
            </a>
        </h1>
    </div>
    <br>
      <div class="card">
  <div class="card-header">
    <h3 class="card-title">General Query Form</h3>
  </div>
  <div class="card-body">
    <form id="myForm" action="" action="https://script.google.com/macros/s/1-ZXCBhz9FCwp2DvDlGn2mBt4gQnfqz2gJTi1BWwwmJP4eq-dgtwTSPMz/exec" method="post">
      <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
      </div>
      
      <div class="form-group">
        <label for="dob">DOB:</label>
        <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter your DOB" required>
      </div>
      
      <div class="form-group">
        <label for="passportNumber">Passport Number:</label>
        <input type="number" class="form-control" id="passportNumber" name="passportNumber" placeholder="Enter your Passport Number" required>
      </div>
      
      <div class="form-group">
       <label for="location">Prefecture:</label>
                <select id="location" name="location" class="form-control" placeholder="Select Prefecture" required>
                <option value="">Select location</option>
                <option value="Akita">Akita, Akita Prefecture</option>
                <option value="Funabashi">Funabashi, Chiba Prefecture</option>
                <option value="Fukuoka">Fukuoka, Fukuoka</option>
                <option value="Ginowan">Ginowan, Okinawa Prefecture</option>
                <option value="Higashimatsuyama">Higashimatsuyama, Saitama Prefecture</option>
                <option value="Hirosima">Hiroshima, Hirosima Prefecture</option>
                <option value="Ise">Ise, Mie Prefecture</option>
                <option value="Kitakyushu">Kitakyushu, Fukuoka Prefecture</option>
                <option value="Kobe">Kobe, Hyogo</option>
                <option value="Kawasaki">Kawasaki, Kanagawa Prefecture</option>
                <option value="Kyoto">Kyoto Prefecture</option>
                <option value="Matsumoto">Matsumoto, Nagano Prefecture</option>
                <option value="Mishima">Mishima, Shizuoka Prefecture</option>
                <option value="Nagasaki">Nagasaki, Nagasaki Prefecture</option>
                <option value="Nagawa">Nagawa, Nagano Prefecture</option>
                <option value="Nagoya">Nagoya, Chubu</option>
                <option value="Naha">Naha, Okinawa</option>
                <option value="Obihiro">Obihiro, Hokkaido</option>
                <option value="Odawara">Odawara, Kanagawa Prefecture</option>
                <option value="Osaka">Osaka</option>
                <option value="Sapporo">Sapporo</option>
                <option value="Sendai">Sendai, Miyagi Prefecture</option>
                <option value="Takarazuka">Takarazuka, Hyōgo Prefecture</option>
                <option value="Tagajo">Tagajo, Miyagi Prefecture</option>
                <option value="Toda">Toda, Saitama Prefecture</option>
                <option value="Tokyo">Tokyo, Okinawa</option>
                <option value="Yatsushiro">Yatsushiro, Kumamoto Prefecture</option>
                <option value="Yokohama">Yokohama</option>
              </select>
      </div>
      <button type="submit" id="submitButton" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>
</div>
  </div>
      <!-- Add Bootstrap JS (jQuery and Popper.js are required) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- <script>
          document.getElementById("myForm").addEventListener("submit", function(event) {
          event.preventDefault();
          var button = document.getElementById('submitButton');
          button.innerText = 'Saving...';
          button.disabled = true;
          var form = document.getElementById("myForm");
          var selectedOption = document.getElementById("location").value;
          var selectedOptionElement = document.querySelector("#location option[value='" + selectedOption + "']");
          var formData = {
            fullName: form.fullName.value,
            dob: form.dob.value,
            // email: form.email.value,
            passportNumber: form.passportNumber.value,
            location: selectedOption,
          };       
           google.script.run.withSuccessHandler(function(response) {

          if (response == 1) {
            alert("Passport Number has already been submitted..");
            var button = document.getElementById('submitButton');
            button.innerText = 'Submit';
            button.disabled = false;
          }else{
            google.script.run.doPost(formData);
              window.open('https://script.google.com/macros/s/1-ZXCBhz9FCwp2DvDlGn2mBt4gQnfqz2gJTi1BWwwmJP4eq-dgtwTSPMz/exec";', '_self');

            // form.reset();
            // alert("Form submitted successfully!..");
            // var button = document.getElementById('submitButton');
            // button.innerText = 'Submit';
            // button.disabled = false;
          }
        }).checkDuplicatePassportNumber(form.passportNumber.value);
        });
            
      </script> -->
  </body>
</html>
