Click the button below to provide payment details for bill payment.

<a class="btn btn-primary" href="{{ url('/bill/'.$bill['id'])}}">Pay</button>
@component('mail::message')
<h3>Hello {{$bill['name']}} Here is your bill </h3> 
<table class="table table-bordered">        
        <tr>
        <td>
        Laboratory Test = N{{$bill['labs']}}
        </td>
        </tr>
       <tr>
        <td>
        Consultation = N{{$bill['consults']}}
        </td>
      </tr>
      <tr>
        <td>
        Drugs = N{{$bill['drugs']}}
        </td>
        </tr>
       <tr>
        <td>
        Anonymous = N{{$bill['anonymous']}}
        </td>
        </tr>
       <tr>
        <td>
        Total Bill = N{{$bill['totalBill']}}
        </td>
      </tr>
    </table>
    
    Click the button below to provide payment details for bill payment.

        <a class="btn btn-primary" href="{{ url('/bill/'.$bill['id'])}}">Pay</button>
        

        Thanks,<br>
        Hospital Administrator
        {{ config('app.name') }}
        @endcomponent
   
