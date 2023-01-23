@extends('layouts.ablackadabra')

@section('content')
<style>
    body{
        background-image: url("http://ablackadabra.com/wp-content/uploads/2022/09/portrait-medium-shot-of-a-young-black-couple-looking-at-each-other-smiling.jpg");
    }
</style>
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <span>vous etes?:</span>
                        <div class="form-check">
                            <input class="form-check-input" value="Monsieur" type="radio" name="user_gender" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Monsieur
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" value="Madame" type="radio" name="user_gender" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                             Madame
                            </label>
                          </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary submit-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

<style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f1f1f1;
    }

    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }

    h1 {
      text-align: center;
    }

    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: #5a3a22;
      color: #ffd7b8;
      border: 2px solid #ffd7b8;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    /* #prevBtn {
      background-color: #bbbbbb;
    } */

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 50px;
      width: 50px;
      margin: 0 2px;
      background-color: #ffd7b8;
      border: 2px solid #5a3a22;
      border-radius: 50%;
      display: inline-block;
      opacity: 1;
      display: flex;
      text-align: center;
      align-items: center;
      color:#5a3a22;
      z-index: 2;
    }
    .step span{
        width: 100%;
    }
    .progress-bar{
        width: 50%;
        height: 6px;
        position: absolute;
        top: 24px;
        content: '';
        background-color: #ffd7b8;
        z-index: 1;
    }

    .step.active {
      opacity: 1;
      background-color: #5a3a22;
      color: #ffd7b8;
      border: 2px solid #ffd7b8;
    }
    /* .step.active::after{
        width: 50%;
        height: 15px;
        position: absolute;
        top: 15px;
        content: '';
        background-color: #aaaaaa;
    } */
    .step.finish{
        opacity: 1;
        background-color: #5a3a22;
        color: #ffd7b8;
        border: 2px solid #ffd7b8;
    }
    /* Mark the steps that are finished and valid: */
    .progress-bar.active {
        width: 50%;
        height: 6px;
        position: absolute;
        top: 24px;
        content: '';
        background-color: #5a3a22;
    }
    </style>
    <body>

    <form id="regForm" method="POST" action="{{ route('register') }}">
        @csrf
      <h1>Register:</h1>
       <!-- Circles which indicates the steps of the form: -->

       <div class="py-3">
       <div class=""  style="text-align:center;margin-bottom:20px;position:relative;width:100%;">
        <div style="display: flex;justify-content:space-around;">
            <div class="step first-step"><span>1</span></div>
            <div class="progress-bar"></div>
            <div class="step last-step"><span>2</span></div>
        </div>

      </div></div>
      <!-- One "tab" for each step in the form: -->
      <div class="tab">
        <div class="row mb-3">
            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
      </div>
      <div class="tab">Contact Info:
        <div class="row">
            <div class="col">
                {{-- user gender --}}
                <span>vous etes?:</span>
                <div class="form-check">
                    <input class="form-check-input" value="Monsieur" type="radio" name="user_gender" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                    Monsieur
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Madame" type="radio" name="user_gender" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                    Madame
                    </label>
                </div>
                {{-- end user gender --}}
                {{-- user status --}}
                <span>Status:</span>
                <div class="form-check">
                    <input id="par_radio" onclick="showStatusTab(this)" data-status="0" class="form-check-input" value="particulier" type="radio" name="user_category" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                    Particulier
                    </label>
                </div>
                <div class="form-check">
                    <input id="pro_radio" onclick="showStatusTab(this)" data-status="1" class="form-check-input" value="professionnel" type="radio" name="user_category" id="flexRadioDefault2" >
                    <label class="form-check-label" for="flexRadioDefault2">
                    Professionnel
                    </label>
                </div>
                {{-- end user status --}}
            </div>
            <div class="col">
                <label for="gallery">Photo de profil</label>
                    <div class="needsclick dropzone" id="gallery-dropzone">

                    </div>
                    <label for="pays">Pays</label>
                    <select name="address1" id="pays">
                        @foreach ($countries as $country)
                            <option>{{$country}}</option>
                        @endforeach
                    </select>

                    <label for="relation" class="col-md-4 col-form-label text-md-end">{{ __('Parain') }}</label>
                         <div class="col-xl-10 col-md-10">
                    <input id="relation" type="text" class="form-control typeahead" name="user_relation" value="{{ old('user_relation') }}"  autocomplete="user_relation">
                </div>
            </div>
        </div>

        <div id="pro_section" class="">
            <div class="row mb-3">
            {{-- first row --}}
            <div class="col-12 mb-3 col-xl-6">
                {{-- company input --}}
                <label for="enterprize" class="col-md-4 col-form-label text-md-end">{{ __('Entreprise') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="enterprize" type="text" class="form-control" name="user_company" value="{{ old('user_company') }}"  autocomplete="user_company">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- job input --}}
                <label for="job" class="col-md-4 col-form-label text-md-end">{{ __('Votre Metier ?') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="job" type="text" class="form-control" name="user_job" value="{{ old('user_job') }}"  autocomplete="user_job">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- youtube input --}}
                <label for="youtube" class="col-md-4 col-form-label text-md-end">{{ __('Youtube') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="youtube" type="text" class="form-control" name="user_youtube" value="{{ old('user_youtube') }}"  autocomplete="user_youtube">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- instagram input --}}
                <label for="instagram" class="col-md-4 col-form-label text-md-end">{{ __('Instagram') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="instagram" type="text" class="form-control" name="user_instagram" value="{{ old('user_instagram') }}"  autocomplete="user_instagram">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- linkedin input --}}
                <label for="linkedin" class="col-md-4 col-form-label text-md-end">{{ __('Linkedin') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="linkedin" type="text" class="form-control" name="user_linkedin" value="{{ old('user_linkedin') }}"  autocomplete="user_linkedin">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- tiktok input --}}
                <label for="tiktok" class="col-md-4 col-form-label text-md-end">{{ __('Tiktok') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="tiktok" type="text" class="form-control" name="user_tiktok" value="{{ old('user_tiktok') }}"  autocomplete="user_tiktok">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- facebook input --}}
                <label for="facebook" class="col-md-4 col-form-label text-md-end">{{ __('Facebook') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="facebook" type="text" class="form-control" name="user_facebook" value="{{ old('user_facebook') }}"  autocomplete="user_facebook">
                </div>
            </div>
            <div class="col-12 mb-3 col-xl-6">
                {{-- twitter input --}}
                <label for="twitter" class="col-md-4 col-form-label text-md-end">{{ __('Twitter') }}</label>
                <div class="col-xl-10 col-md-10">
                    <input id="twitter" type="text" class="form-control" name="user_twitter" value="{{ old('user_twitter') }}"  autocomplete="user_twitter">
                </div>
            </div>
        </div>
        </div>
            {{-- first row end --}}
        </div>


      <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button id="submit-btn" type="submit">
            {{ __('Register') }}
          </button>
          <button type="button" class="section1-btn" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var path = "{{route('register.autocomplete')}}";
        $('input.typeahead').typeahead({
            source: function(terms,process){
                return $.get(path,{terms:terms},function(data){
                    console.log(data);
                    return process(data);
                });
            },
            displayText: function(item){ return item.username;},
            minLength:3
        })
    </script>
    <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    var r = document.getElementById("pro_radio");
    var pr = document.getElementById("par_radio");
    showStatusTab(pr);
    function showStatusTab(radio){
        var i = false;
        let data = radio.getAttribute("data-status");
        //console.log('first',data);
        var c = document.getElementById("pro_section");
        //console.log(c);
        //c.style.display = "none";
        //console.log('displayed');
        //console.log(data);

        if (data == 0) {
        //console.log('problem before');
        c.style.display = "none";
        //console.log('none works');
        } else if(data){
        c.style.display = "block";
        //console.log('block works');
        }
    }
    var status = false;
    showTab(currentTab,status); // Display the current tab

    function showTab(n,s) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      var submitBtn = document.getElementById("submit-btn");

     // var b = document.getElementsByClassName("progress-bar")[0];
      submitBtn.style.display = "none";
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("nextBtn").style.display = "inline";
       // b.className.replace("active","");
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        submitBtn.style.display = "inline"
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      var b = document.getElementsByClassName("progress-bar")[0];
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      b.className += " active";
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>
    <script src="{{asset('js/dropZone.js')}}"></script>
    </body>
    </div>
@endsection
