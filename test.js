var fs = require('fs');
var pegjs = require("pegjs");
var phppegjs = require("php-pegjs");

function generateParser(input_file, output_file, classname)
{
    var data = fs.readFileSync(input_file);
    
    var parser = pegjs.buildParser(data.toString(),
        {
            cache: true,
            plugins: [phppegjs],
            phppegjs: {parserNamespace: 'Parser', parserClassName: classname}
        });
    fs.writeFileSync(output_file, parser);

}

var classname = 'LogicExp';
generateParser('logic-exp-php.pegjs', classname+'.php', classname);