@props(["small"=>""])
<button onclick="window.history.back();" class="btn btn-warning m-1 {{($small=='true')? 'btn-sm' : ''}}" data-toggle="tooltip" title="{{__('Cancel')}}"><i class="tf-icons bx bx-no-entry fa-fw"></i>&nbsp;{!! ($slot != "") ? '&nbsp;' . $slot : '' !!}</button>
