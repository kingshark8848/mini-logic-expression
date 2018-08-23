<?php

include 'LogicExp.php';

print("hello\r\n");

function treeToString($tree){
    if (is_int($tree)){
        return [$tree];
    }

    if (is_array($tree) && array_key_exists('type', $tree)){

        $type = $tree['type'];

        if ($type==='NOT'){
            return array_merge([$type],treeToString($tree['operand']));
        }
        else{
            return array_merge(['('],treeToString($tree['left']),[$type],treeToString($tree['right']), [')']);
        }

    }
    else{
        throw new Exception('the tree structure is broken');
    }

}

$parser = new Parser\LogicExp;

$tree = $parser->parse('(11 OR NOT 1) AND NOT ( 22 AND 3 OR 4 AND 74 )');
print(json_encode($tree));
print("\r\n");

$tokens = treeToString($tree);
print(implode(' ', $tokens));

