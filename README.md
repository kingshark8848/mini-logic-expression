# Mini Logic Expression Parser

## Background

On one of the web application at my company, we created a mini expression to let user write for data query.

The grammar is very simple: 

- Only three logic operators: AND / OR / NOT
- Only one type of data that is integer. e.g: 0, 1, 21 (actually, every integer represent a sub query condition)
- Can use one kind of brackets: ( / )

Here are some examples:

- valid ones:

            '1',
            '1 AND 2',
            '1 OR 2',
            '1 AND NOT 2 AND 1',
            '1 OR NOT 2 OR 1',
            '1 AND 2 OR 1',
            '1 OR 2 AND 1',
            '1 OR 2 OR 1',
            '1 AND NOT 2 OR 1',
            '1 OR 2 AND NOT 1',
            '1 AND 1 OR 2',
            '1 AND NOT 2 AND NOT 1',
            '1 AND ( NOT (3 OR 2) )',
            '1 AND NOT (3 OR 2)',
            '( NOT (3 AND 1) AND 1 )',
            '1 AND NOT NOT 2 AND 1',
            '1 AND NOT (NOT 2 AND 1)',
            '2 OR 1',
            '2 OR ( 1 AND 2)',
            '2 AND ( 2 AND (1))',
            '2 AND 2 AND (1)',
            '1 AND (1 AND ((2)))',
            '1 AND (2 AND ((1)))'

- invalid ones:

            '',
            '2',
            'AND 2',
            'AND 1',
            '(1 AND 1))',
            '(1 ( AND 1) )',
            '(1 ( AND 2) )',
            '(1 AND NOT ()))',
            '1 AND NOT AND NOT 2 AND 1',
            '1 AND NOT AND NOT 1 AND 1',
            '1 NOT 1',
            '1 NOT 2',
            '1 AND 2 2',
            '1 AND 2 1',
            '1 AND 2 NOT 1',
            '1 AND 2 OR NOT OR 1',
            '1 AND 2 OR ( NOT ) OR 1',
            '1 AND 2 OR (NOT) OR 1',
            '1 AND 2 OR (AND) 1',
            '1 AND 2 ( AND ) 1',
            '1 AND 2 ( AND ) 2',
            '1 AND 2 ( AND  2 )',
            '1 AND 1 ( AND  1 )',
            '1 OR 1 OR AND 1',
            '1 OR 1 OR NOT AND 1'

System need to verify and parse the script correctly. 

I write a parser by myself but its limited which only accept our case and hard to scale, so I decide to use an universal parser generator to solve the problem. I found `PEG.js`, which is a simple parser generator for JavaScript, and based on `parsing expression grammar` (PEG) formalism. Because the target language is PHP, a plugin `PHP PEG.js` is used.

## How it works

1. define the grammar via modifying `logic-exp-php.pegjs`. This is nearly the only !!important!! task for the project.
2. generate parser (php class file) by running `node parser-generator.js`
3. run php test.php to do test
