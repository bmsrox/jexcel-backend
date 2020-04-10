<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://bossanova.uk/jexcel/v3/jexcel.js"></script>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css" />
    <script>
        function gerarRelatorio() {
            const { data, columns, style, colAlignments } = document
                .getElementById('spreadsheet')
                .jexcel
                .getConfig()

            const post = {
                data,
                columns,
                style,
                colAlignments
            }

            fetch('test.php', {
                method: 'post',
                body: JSON.stringify(post)
            }).then(async (response) => {
                console.log("RESPONSE: ", await response.json())
            }).catch( error => {
                console.log(error.message)
            })
        }
    </script>
</head>
<body>
    <div id="spreadsheet"></div>
    <button onClick="gerarRelatorio()"> Gerar Relátorio </button>
    <script type="text/javascript">
        var data = [
            ['Jazz', 'Honda', '2019-02-12', '', true, '$ 2.000,00', '#777700'],
            ['Civic', 'Honda', '2018-07-11', '', true, '$ 4.000,01', '#007777'],
        ];

        jexcel(document.getElementById('spreadsheet'), {
            data:data,
            columns: [
                { type: 'text', title:'Car', width:120 },
                { type: 'dropdown', title:'Make', width:200, source:[ "Alfa Romeo", "Audi", "Bmw" ] },
                { type: 'calendar', title:'Available', width:200 },
                { type: 'image', title:'Photo', width:120 },
                { type: 'checkbox', title:'Stock', width:80 },
                { type: 'numeric', title:'Price', width:100, mask:'$ #.##,00', decimal:',' },
                { type: 'color', width:100, render:'square', }
            ]
        });
    </script>
</body>
</html>