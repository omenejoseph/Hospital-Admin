
@component('mail::message')
<h3>Dear {{$patient['name']}} Thanks for trusting us </h3> 

    <p>
    This email confirms that payment of your last bill has been recieved. We appreciate your patronage.
    </p>
  Thanks
  Hospital Administrator
  {{ config('app.name') }}
  @endcomponent
   
