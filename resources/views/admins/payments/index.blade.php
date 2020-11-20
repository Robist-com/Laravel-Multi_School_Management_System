
@extends('layouts.websiteLayout.app')

@section('content')

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Subscription Page</h2>
              <p>You can pay with any payment method that are available in the application.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{url('school/website')}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Contact</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
        @include('flash::message')
       
            <div class="row justify-content-center" >
                <div class="col-md-6 form-group ">
                    <label for="fname">Card Holder Name</label>
                    <!-- <input type="text" id="fname" name="fname" class="form-control form-control-lg"> -->
                    <input placeholder="Card Holder" class="form-control" id="card-holder-name" type="text" autocomplate="off">
                    @if(auth()->user())
                    <input type="hidden" id="school_id" name="school_id" value="{{auth()->user()->school_id}}" class="form-control form-control-lg">
                    @else
                    @foreach($contact_us as $contact)
                    <input type="hidden" id="school_id" name="school_id" value="{{$contact->school_id}}" class="form-control form-control-lg">
                    @endforeach
                    @endif
                </div>
                </div>
                
           
            <div class="row justify-content-center">
            <div class="col-md-6 form-group">
            <select name="plan" class="form-control" id="subscription-plan">
                @foreach($plans as $key=>$plan)
                    <option value="{{$key}}">{{$plan}}</option>
                @endforeach
            </select>
            </div>
            </div>
                   
            <div class="row justify-content-center">
            <div class="col-md-6 form-group">
            <div id="card-element"></div>
            </div>
            </div>
                  
          
            <div class="row justify-content-center">
                <div class="col-6  form-group">
                    <input type="button" value="Subscribe" class="btn btn-primary btn-lg btn-block" id="card-button" data-secret="{{ $intent->client_secret }}">
                </div>
            </div>
        </div>
    </div>

    @endsection


    @section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            const stripe = Stripe('{{env('STRIPE_KEY')}}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const plan = document.getElementById('subscription-plan').value;
            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.handleCardSetup(
                    clientSecret, cardElement, {
                        payment_method_data: {
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );
                if (error) {
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                    // console.log('handling success', setupIntent.payment_method);
                    axios.post('/subscribe',{
                        payment_method: setupIntent.payment_method,
                        plan : plan
                    }).then((data)=>{
                        location.replace(data.data.success_url)
                    });
                }
            });
        })
    </script>

@endsection