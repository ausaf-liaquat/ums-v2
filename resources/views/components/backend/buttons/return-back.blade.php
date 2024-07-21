@props(["small"=>""])
<button onclick="window.history.back();" class="btn btn-warning m-1 {{($small=='true')? 'btn-sm' : ''}}" data-toggle="tooltip" title="{{__('Return Back')}}"><i class="tf-icons bx bx-arrow-back fa-fw"></i>&nbsp;{!! ($slot != "") ? '&nbsp;' . $slot : '' !!}</button>
