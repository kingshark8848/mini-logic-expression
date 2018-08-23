start
  = logical_or

logical_or
  = left:logical_and ws+ "OR" ws+ right:logical_or { return array('type'=>"OR", 'left'=>$left, 'right'=>$right); }
  / logical_and

logical_and
  = left:factor ws+ "AND" ws+ right:logical_and { return array('type'=>"AND", 'left'=>$left, 'right'=>$right); }
  / factor

factor
  = "NOT" ws* operand: (factor / primary)  { return array('type'=>"NOT", 'operand'=>$operand ); }
  / primary

primary
  = token
  / "(" ws* logical_or:(logical_or) ws* ")" { return $logical_or; }

token 
  = token:[0-9]+ { return (int)implode('', $token); }

ws 
  = [ \t]