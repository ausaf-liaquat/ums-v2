@props(["small"=>""])
{{ html()->submit($text = icon('tf-icons bx bx-save fa-fw')." ".__('Save'))->class('btn btn-success m-1'.(($small=='true')? ' btn-sm' : '')) }}
